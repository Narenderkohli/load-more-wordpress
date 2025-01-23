jQuery(document).ready(function ($) {
    let page = 2; // Start from page 2
     $('#load-more').click(function () {
        // console.log('hii');
         $.ajax({
             url: ajax_obj.ajaxurl,
             type: 'POST',
             data: {
                action: 'load_more',
                page: page,
            },
              beforeSend: function() {
                $('#load-more').text('Loading...'); // Show loading text
            },
            dataType: 'json',
            success: function (response) {
              if (response && response.html) {
                    // Append the HTML to the container
                    $('#post-container').append(response.html);
                }
                if (!response.has_more) {
                    $('#load-more').text('No More Posts'); // If no more posts
                    $('#load-more').prop('disabled', true); // Disable button
                } else {
                    $('#post-container').append(response);
                     $('#load-more').text('Load More');
                    page++; // Increment the page count
                }
            },
        });
    });
})