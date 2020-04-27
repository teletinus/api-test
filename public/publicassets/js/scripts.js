$(document).ready(function () {
    // you may need to change this code if you are not using Bootstrap Datepicker
    $('.js-datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: "dateToday",
        autoclose: true
    });

    $('#add-new-product').submit(function (e) {
        e.preventDefault();
        $('.input-error').remove();
        $('.alert-success').remove();
        $('.form-control').removeClass('border');
        $('.form-control').removeClass('border-danger');
        var data_form = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/api/product?web=1",
            data: data_form,
            beforeSend: function () {
            },
            success: function (data) {
                if (typeof data.status !== 'undefined' && data.status == 'ok') {
                    $('#add-new-product').prepend('<div class="alert alert-success tex-center">Product successfully added!</div>');
                    $('#add-new-product').trigger('reset');
                } else {
                    $.each(data.form.children, function (key, value) {
                        if (typeof value.errors !== 'undefined') {
                            console.log('#product_' + key);
                            $('#product_' + key).parents().eq(0).append('<span class="text-danger input-error">' + value.errors[0] + '</span>');
                            $('#product_' + key).addClass('border border-danger');
                        }
                    });

                }

            }
        });

    });

    if ($('.container').find('.sales-container').length > 0) {

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/api/sales",
            data: '',
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data.tbody);
                console.log(data.thead);

                var sales_thead = '<tr>';

                $.each(data.thead, function (key_head, val_head) {
                    var thead_border = '';
                    if (key_head == 2) {
                        thead_border = 'style="border-left:1px solid #000"';
                    } else if (key_head == 5) {
                        thead_border = 'style="border-right:1px solid #000"'
                    }
                    sales_thead += '<th ' + thead_border + '>' + val_head + '</th>';
                });
                sales_thead += '</tr>';

                $('.sales-header').append(sales_thead);

                var sales_tbody = '<tr>';
                $.each(data.tbody, function (key_body, val_body) {
                    var i=0;
                    $.each(val_body, function (k_body, v_body) {
                         var tbody_border = '';
                        if(i==2){
                            tbody_border = 'style="border-left:1px solid #000"';
                        }
                        if(i==5){
                            tbody_border = 'style="border-right:1px solid #000"';
                        }
                        sales_tbody += '<th ' + tbody_border + '>' + v_body + '</th>';
                        i++;
                    });
                    sales_tbody += '</tr>';
                });
                

                $('.sales-body').append(sales_tbody);

                $('#sales-table').DataTable();
            }
        });
    }
});
