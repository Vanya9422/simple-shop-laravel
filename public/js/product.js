$('#gridCheck').on('change', function () {
    this.value = this.checked ? 1 : 0;
}).change();

$('.delete-product').click(function () {
    if (confirm('Are you sure you want to delete this product ?')) {
        let id = $(this).data('id');
        $.ajax({
            url: `delete/${id}`,
            type: 'delete',
            data: id,
            error: function (reject) {
                alert(reject.responseJSON.message);
            },
            success: function (resolve) {
                $(`.parent_${id}`).fadeOut(750);
            },
        });
    }
});

$('.delete-image').click(function () {
    if (confirm('Are you sure you want to delete this image ?')) {
        let id = $(this).data('id');
        $.ajax({
            url: `/delete-image/${id}`,
            type: 'delete',
            data: id,
            error: function (reject) {
                alert(reject.responseJSON.message);
            },
            success: function (resolve) {
                $(`#image_${id}`).fadeOut(750);
            },
        });
    }
});
