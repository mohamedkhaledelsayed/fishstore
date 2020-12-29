let searchBtn = $('#search-in-table'),
    searchSortingBy = $('.search-sorting'),
    columnName = 'id',
    sortType = 'ASC',
    currentUrl = location.origin + location.pathname,
    pageNumber = $('.pagination li.active').children().html(),
    searchDataAppendTbody = $('#search-data-append-tbody'),
    pageNumbersCount = $('.pagination').children('li').length,
    moreParamsData = {};

searchBtn.on('keyup', function (e) {
    pageNumber = 1;
    submitSearch();
});
// on click in table head to sort with column ASC || DESC
searchSortingBy.on('click', function (e) {
    columnName = $(this).data('sort-name');
    sortType = toggleSortType($(this));
    pageNumber = 1;
    submitSearch();
});

// prevent pagination click to handel it with ajax
$('body').on('click', '.pagination .page-link', function (e) {
    e.preventDefault();

    if ($(this).attr('rel')) {
        pageNumber = $(this).attr('rel') === 'next'
            ? (parseInt(pageNumber) + 1 <= (pageNumbersCount - 2) ? parseInt(pageNumber) + 1 : pageNumber)
            : parseInt(pageNumber) - 1;
        $(this).parent('li').addClass('active');
        $('.pagination li').removeClass('active');
        return submitSearch();
    }
    pageNumber = $(this).html();
    $(this).parent('li').addClass('active');
    $('.pagination li').removeClass('active');
    return submitSearch();
});

function submitSearch() {
    let dataToSend = {
        'search_value': searchBtn.val(),
        'column_name': columnName,
        'sort_type': sortType,
        'page': pageNumber
    };
    if(Object.keys(moreParamsData).length) {
        Object.assign(dataToSend,moreParamsData);

    }
    console.log(dataToSend,moreParamsData);
    return $.get({
        url: currentUrl + '/search_in_table',
        data: dataToSend,
        success: function (data) {
            searchDataAppendTbody.html('');
            searchDataAppendTbody.html(data);
            getColspan();
            pageNumbersCount = $('.pagination').children('li').length;
        }
    })
}

function getColspan() {
    $('.get-colspan-numbers').each(function (e) {
        let parentTable = $(this).parents('table'),
            tableThLength = parentTable.find('thead tr').children('th').length;
        $(this).attr('colspan', tableThLength);
    });
}

function toggleSortType(elm) {
    $('span.sort-type-icon').addClass('d-none');
    $('.sort-type-image').removeClass('d-none');
    elm.children('span').removeClass('d-none');
    elm.children('img.sort-type-image').addClass('d-none');

    if (elm.data('sort-type') === 'ASC') {
        elm.data('sort-type', 'DESC');
        elm.children('span').removeClass('fa-sort-up').addClass('fa-sort-down');
        return elm.data('sort-type');
    }
    elm.data('sort-type', 'ASC');
    elm.children('span').removeClass('fa-sort-down').addClass('fa-sort-up');
    return elm.data('sort-type');
}
