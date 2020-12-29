$(document).ready(function () {
    // to get the table th length dynamic
    getColspan();
    $('.my-select-2').select2();

});


function getColspan() {
    $('.get-colspan-numbers').each(function (e) {
        let parentTable = $(this).parents('table'),
            tableThLength = parentTable.find('thead tr').children('th').length;
        $(this).attr('colspan', tableThLength);
    });
}

// stop delete request to confirm it first
$('body').on('click', '.delete-btn', function (e) {
    e.preventDefault();
    swal.fire({
        title: trans('admin.warning') + ' !',
        html: trans('admin.confirm_delete'),
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'الغاء',
        confirmButtonText: 'نعم',
    }).then((result) => {
        if (result.value) {
            $(this).closest('form').submit();
        }
    });
});

function trans(key, replace = {}) {
    let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }

    return translation;
}
