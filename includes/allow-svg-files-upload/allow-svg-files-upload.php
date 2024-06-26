<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use enshrined\svgSanitize\Sanitizer;

function flexipress_performance_allowsvgfilesupload() {
    add_filter('upload_mimes', function($upload_mimes) {
        if (!current_user_can('administrator')) {
            return $upload_mimes;
        }

        $upload_mimes['svg']  = 'image/svg+xml';
        $upload_mimes['svgz'] = 'image/svg+xml';

        return $upload_mimes;
    });

    add_filter('wp_check_filetype_and_ext', function($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {
        if (!$wp_check_filetype_and_ext['type']) {
            $check_filetype  = wp_check_filetype($filename, $mimes);
            $ext             = $check_filetype['ext'];
            $type            = $check_filetype['type'];
            $proper_filename = $filename;

            if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
                $ext  = false;
                $type = false;
            }

            $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
        }

        return $wp_check_filetype_and_ext;
    }, 10, 5);

    add_filter('wp_handle_upload_prefilter', 'flexipress_sanitize_svg');
}

function flexipress_sanitize_svg($file) {
    if ($file['type'] === 'image/svg+xml') {
		// Initialize the WP_Filesystem object
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
        }
		
		// Read the contents of the SVG file
        $file_contents = $wp_filesystem->get_contents($file['tmp_name']);
        if ($file_contents === false) {
            $file['error'] = 'Failed to read SVG file';
            return $file;
        }
		
		// Sanitize the SVG
        $sanitizer = new Sanitizer();
        $cleanSVG = $sanitizer->sanitize($file_contents);

        if ($cleanSVG === false) {
            $file['error'] = 'Failed to sanitize SVG file';
        } else {
			// Write the sanitized contents back to the file
            if (!$wp_filesystem->put_contents($file['tmp_name'], $cleanSVG, FS_CHMOD_FILE)) {
                $file['error'] = 'Failed to write sanitized SVG file';
            }
        }
    }

    return $file;
}

function flexipress_performance_allowsvgfilesupload_deactivate() {
    remove_filter('upload_mimes', 'flexipress_performance_allowsvgfilesupload');
    remove_filter('wp_check_filetype_and_ext', 'flexipress_performance_allowsvgfilesupload', 10, 5);
    remove_filter('wp_handle_upload_prefilter', 'flexipress_sanitize_svg');
}