jQuery(document).ready(function ($) {
    $('#thepost-category').on('change', function () {
        var category = $(this).val();

        $.ajax({
            url: thepost_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'thepost_filter',
                category: category,
            },
            beforeSend: function () {
                $('#thepost-results').html('<p>Loading...</p>');
            },
            success: function (response) {
                $('#thepost-results').html(response);
            },
            error: function () {
                $('#thepost-results').html('<p>Something went wrong. Please try again.</p>');
            }
        });
    });
});
