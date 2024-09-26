$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var base_url = $('#url').val();

    var preLoader = `<div class="loader-container">
    <div class="loader">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>`;


//print json with foreach loop

    // Swal.fire({
    //     title: 'Success',
    //     text: 'Logged In Successfully',
    //     icon: 'success',
    //     // toast:true
    // })


    //function for show ajax error message
    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }
    

    
    //validate admin login
    $('#kitchenLogin').validate({
        rules: { username: { required: true }, 
                password: { required: true }
            },
        messages: { 
            username: { required: "Username Required." }, 
            password: { required: "Password Required" } 
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('body').append(preLoader);
            $.ajax({
                url: base_url+'/kitchen',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    
                    if(dataResult.success){
                        Swal.fire({
                            title: 'Success',
                            text: 'Logged In Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            window.location.href = base_url+'/kitchen/dashboard';
                        }, 2000);
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: dataResult.error,
                            icon: 'error',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function (dataResult) {
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $('.accept-order').click(function(){
        var id = $(this).attr('data-id');
        $('.card').append(preLoader);
        $.ajax({
            url: base_url + '/admin/order_status_accept',
            type: 'POST',
            data: {order:id},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1' || dataResult == '0') {
                    Swal.fire({
                        title: 'Success',
                        text: 'Accepted Successfully',
                        icon: 'success',
                        showConfirmButton: false,
                    })
                    setTimeout(function () {
                        $('.response-alert').remove();
                        window.location.reload();
                    }, 1500);
                }else {
                    setTimeout(function () {
                        $('.loader-container').remove();
                        Swal.fire({
                            title: 'Error',
                            text: dataResult,
                            icon: 'error',
                            showConfirmButton: false,
                        })
                    }, 1500);
                    $('.loader-container').remove();
                }
            }, error: function (dataResult) {
                show_formAjax_error(dataResult);
                $('.loader-container').remove();
            }
        });
    })
})

