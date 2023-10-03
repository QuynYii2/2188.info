let page = 1;

function loadMoreItems() {
    $('#loader').show();

    $.ajax({
        url: '/load-more',
        type: 'GET',
        data: { page: page },
        success: function(data) {
            if (data.length > 0) {
                data.forEach(function(item) {
                    $('#content').append('<div class="item">' + item + '</div>');
                });
                $('#loader').hide();
                page++;
            } else {
                $('#loader').html('No more items');
            }
        },
        error: function() {
            $('#loader').hide();
            $('#loader').html('Error loading more items');
        }
    });
}

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $('#content').height()) {
            loadMoreItems();
        }
    });

    // Load more items initially
    loadMoreItems();
});
let page = 1;

function loadMoreItems() {
    $('#loader').show();

    $.ajax({
        url: '/load-more',
        type: 'GET',
        data: { page: page },
        success: function(data) {
            if (data.length > 0) {
                data.forEach(function(item) {
                    $('#content').append('<div class="item">' + item + '</div>');
                });
                $('#loader').hide();
                page++;
            } else {
                $('#loader').html('No more items');
            }
        },
        error: function() {
            $('#loader').hide();
            $('#loader').html('Error loading more items');
        }
    });
}

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $('#content').height()) {
            loadMoreItems();
        }
    });

    // Load more items initially
    loadMoreItems();
});
