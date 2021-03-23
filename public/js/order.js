const form = $('#order-form');
const modal = $('.order-modal');

modal.on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let id = button.data('product'); // Extract info from data-* attributes
    let productName = button.data('name'); // Extract info from data-* attributes
    $(this).find('.modal-title').text('New Order to Product ' + productName);
    $(this).find('#product').val(id);
});

modal.on('hidden.bs.modal', () => form[0].reset());

$('#with_registration').on('change', function () {

    this.value = this.checked ? 1 : 0;

    if (this.checked) {
        $('#optional-block').clone().prop('id', 'clone_register').insertAfter("#before-register").show();
    } else {
        $('#clone_register').remove()
    }

}).change();

form.submit(event => {
    event.preventDefault();
    let withRegistration = Number(event.target.with_registration.value);

    let objectForm = {
        objectOrder: {
            name: event.target.name.value,
            last_name: event.target.last_name.value,
            email: event.target.email.value,
            phone: event.target.phone.value,
            region: event.target.region.value,
            message: event.target.message.value,
            city: event.target.city.value,
            address: event.target.address.value,
            zip: event.target.zip.value,
            quantity: event.target.quantity.value,
            product_id: event.target.product.value,
        },
        withRegistration
    };

    if (withRegistration) {
        objectForm = {
            ...objectForm, objectUser: {
                name: event.target.name.value,
                last_name: event.target.last_name.value,
                username: event.target.username.value,
                email: event.target.email.value,
                password: event.target.password.value,
                password_confirmation: event.target.password_confirmation.value,
            }
        }
    }

    $.ajax({
        url: '/create-order',
        type: 'POST',
        data: objectForm,
        beforeSend: function () {
            $('#submit-order-form').html('Creating...');
        },
        error: function (resolve) {
            let messages = resolve.responseJSON.errors;
            if (resolve.responseJSON.message === 'This action is unauthorized.') {
                alert('Please Register or Login');
            }
            for (let obj in messages) {
                let id = obj.split('.');
                let invalidBlock = id[0] === 'objectUser' ? $(`.invalid-${id[1]}`) : $(`#invalid-${id[1]}`);
                messages[obj].forEach(item => {
                    invalidBlock.append(`<strong>${item}</strong><br>`);
                    invalidBlock.show();
                });
                setTimeout(() => {
                    invalidBlock.html('');
                    invalidBlock.hide(500);
                }, 5000);
            }
            $('#submit-order-form').html('Add order');
        },
        success: function (resolve) {
            $('.modal-body').append(
                '<div class="alert alert-success alert-dismissible fade show">' +
                '<button type="button" class="close" data-dismiss="alert" style="top: 15px;right: 6px;" aria-label="Close">' +
                '<span aria-hidden="true">×</span>' +
                '</button>' +
                resolve.message +
                '</div>'
            );
            $('#submit-order-form').html('Add order');
            if (withRegistration){
                setTimeout(() => {
                    window.location.href = '/customer/dashboard'
                }, 2000);
            }
            form[0].reset();
            $('.alert.alert-success').fadeOut(1500);
        },
    });
});

$('.confirm-order').click(function () {

    if (!$(this).data('approve')){
        alert('you can not confirm until the admin confirms');
        return false;
    }

    if (confirm('Are you sure you want to confirm this order ?')) {
        let id = $(this).data('id');
        let badge = $(`.confirm-badge-${id}`).children('.badge');
        $.ajax({
            url: `confirm/${id}`,
            type: 'put',
            data: id,
            beforeSend: () => $(this).html('Confirm...'),
            error: reject => {
                alert(reject.responseJSON.message);
                $(this).html('Confirm');
            },
            success: resolve => {
                badge.removeClass('badge-warning');
                badge.addClass('badge-success');
                $(this).html('Confirm');
            },
        });
    }
});
