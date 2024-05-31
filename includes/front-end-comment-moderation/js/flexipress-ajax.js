jQuery(document).ready(function($) {
    $('.flexipress-delete-comment').on('click', function() {
        var commentId = $(this).data('comment-id');
        var $commentElement = $(this).closest('.comment');
        
        $.ajax({
            url: flexipress_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'flexipress_delete_comment',
                comment_id: commentId,
                _ajax_nonce: flexipress_ajax_object.nonce
            },
            success: function(response) {
                if (response.success) {
                    $commentElement.find('.flexipress-delete-comment').hide();
                    $commentElement.find('.flexipress-undo-delete').show();
                    $commentElement.addClass('comment-deleted');
                }
            }
        });
    });

    $('.flexipress-undo-delete').on('click', function() {
        var commentId = $(this).data('comment-id');
        var $commentElement = $(this).closest('.comment');

        $.ajax({
            url: flexipress_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'flexipress_undo_delete_comment',
                comment_id: commentId,
                _ajax_nonce: flexipress_ajax_object.nonce
            },
            success: function(response) {
                if (response.success) {
                    $commentElement.find('.flexipress-delete-comment').show();
                    $commentElement.find('.flexipress-undo-delete').hide();
                    $commentElement.removeClass('comment-deleted');
                }
            }
        });
    });
});
