$(document).ready(function(){

    var origin = window.location.origin;
    //alert(origin);
    var path = window.location.pathname.split( '/' );
    //alert(path);
    // var uRL = origin;
    // alert(uRL); 
    var uRL = $('#url').val();

    var loader = '<div class="loader"></div>';

    

    function show_formAjax_error(data){
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    // ========================================
    // script for User Login module
    // ========================================

    $('#user-login').validate({
        rules: {
            user_name: { required: true },
            user_password: { required: true }
        },
        messages: {
            user_name: { required: "Email Address is required" },
            user_password: { required: "Password is required" }
        },
        submitHandler: function (form) {
            $('#user-login').append(loader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/login',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Logged In Succesfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){ window.location.href = uRL; }, 3000);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: dataResult,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('.loader').remove();
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                    $('.loader').remove();
                }
            });
        }
    });

    $('.logout').click(function(){
        $.ajax({
            url: uRL + '/logout',
            type: 'GET',
            success: function (dataResult) {
                if (dataResult == '1') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Logged Out Successfully.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function () { window.location.href = uRL + '/'; }, 1500);
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: dataResult,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            error: function (data) {
                show_formAjax_error(data)
            }
        });
    });

    $('#change-password').validate({
        rules: {
            old: { required: true },
            new: { required: true },
            confirm: { required: true,equalTo:"#password" }
        },
        submitHandler: function (form) {
            $('#change-password').append(loader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/user/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "Password Changed Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){ window.location.href = uRL; }, 3000);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: dataResult,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('.loader').remove();
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                    $('.loader').remove();
                }
            });
        }
    });


    $('.show-edit-profile').click(function(){
        $('#profileModal').modal('show');
    });

    // ========================================
    // script for User SignUp module
    // ========================================

    $('#user-signup').validate({
        rules: {
            name: { required: true },
            phone: { required: true },
            email: { required: true },
            password: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#user-signup').append(loader);
            $.ajax({
                url: uRL+'/signup',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Account Created Successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){ window.location.href = uRL+'/'; }, 3000);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: dataResult,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('.loader').remove();
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                    $('.loader').remove();
                }
            });
        }
    });

    // ========================================
    // script for Update Profile module
    // ========================================


    $('#forgot-password').validate({
        rules: {
            email: { required: true },
        },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $('#forgot-password').append(loader);
            $.ajax({
                url: uRL+'/forgot-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.message').html('<div class="alert alert-danger">'+dataResult+'</div>');
                    $('.loader').remove();
                },
                error: function(data){
                    show_formAjax_error(data)
                    $('.loader').remove();
                }
            });
        }
    });

    $('#reset-password').validate({
        rules: {
            password: { required: true },
            confirm_password: { required: true,equalTo:"#password" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#reset-password').append(loader);
            $.ajax({
                url: uRL+'/reset-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if(dataResult == '1'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Password Updated Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function () {
                            $('#profileModal').modal('hide');
                            window.location.href = uRL+'/login';  
                        }, 2000);
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: dataResult,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('.loader').remove();
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                    $('.loader').remove();
                }
            });
        }
    });

        

        $('#updateProfile').validate({
            rules: {
                name: { required: true },
                phone: { required: true },
                address: { required: true }
            },
            submitHandler: function (form) {
                $('#updateProfile').append(loader);
                var formdata = new FormData(form);
                $.ajax({
                    url: uRL + '/user/profile',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (dataResult){
                        console.log(dataResult);
                        if (dataResult == '1') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Profile Updated Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function () {
                                $('#profileModal').modal('hide');
                                window.location.reload();  
                            }, 2000);
                        } else if (dataResult == '0') {
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: 'No change found',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function () {
                                $('#profileModal').modal('hide');
                                window.location.reload(); 
                            }, 2000);
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: dataResult,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('.loader').remove();
                        }
                    },
                    error: function (dataResult){
                        show_formAjax_error(dataResult);
                        $('.loader').remove();
                    }
                });
            }
        });

    // ========================================
    // script for Reservation module
    // ========================================

    $('#check-tables').validate({
        rules: {
            persons: { required: true },
            date: { required: true },
            time: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#check-tables').append(loader);
            $.ajax({
                url: uRL+'/reservation',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    $('.available-tables').html(dataResult);
                    $('.loader').remove();
                }
            });
        }
    });

    $('#create-reservation').validate({
        rules: {
            table_no: { required: true },
            no_person: { required: true },
            date: { required: true },
            start_time: { required: true },
            end_time: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#confirm-reservation').append(loader);
            $.ajax({
                url: uRL+'/create-reservation',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if(dataResult == '1'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Table Booked Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function () {
                            window.location.href = uRL+'/user/profile'; 
                        }, 1500);
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: dataResult,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function () {
                            $('.loader').remove();
                        }, 1500);
                    }
                }
            });
        }
    });
    

    
    // $('#exampleModal').modal('show');
    $(document).on('click', '.table_id', function () {
        var id = $(this).attr('data-id');
        $('#exampleModal input[name=table_no]').val(id);
        $('#exampleModal').modal('show');

    });

    $('#addReservation').validate({
        submitHandler: function (form) {
            // alert(1);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+ '/reservation',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Reservation Table is Booked.</div>');
                        setTimeout(function () { window.location.href = uRL + '/reservation'; }, 3000);
                    } else {
                        $('.message').append('<div class="alert alert-danger">' + dataResult + '</div>');
                    }
                }, 
                error: function (dataResult) {
                    show_formAjax_error(dataResult);
                }
            });
        }
    });


    

    // ========================================
    // script for Proceed To Complate Order Code module
    // ========================================
    $('.addOrder').click(function (e) {
        e.preventDefault();
        var customer_name = $('.customer_name').val();
        var food_qty = [];
        $('input[name="food_qty[]"]').each(function() {
            food_qty.push(this.value);
        });
        var food_price = [];
        $('input[name="food_price[]"]').each(function () {
            food_price.push(this.value);
        });
        var food_id = [];
        $('input[name="food_id[]"]').each(function () {
            food_id.push(this.value);
        });
        var payment_method = $("input[type=radio][name=defaultExampleRadios]:checked").val();
        var shipping_method = JSON.parse(localStorage.getItem("shipping_method"));
        var grand_total = parseInt($('.grand-total').html());
       // alert(grand_total);
        if (grand_total != "" && customer_name != "" && food_qty.length != 0 && food_price.length != 0 && food_id.length != 0 && payment_method != '' && shipping_method != '') {
            $.ajax({
                url: uRL + '/check_out',
                type: 'POST',
                data: { g_total:grand_total,customer_name: customer_name, food_qty: food_qty, food_price: food_price, food_id: food_id, payment_method: payment_method, shipping_method: shipping_method},
                success: function (dataResult) {
                   // console.log(dataResult);
                    localStorage.setItem("discount", "");
                    localStorage.setItem("shipping_method", "");
                    if (payment_method == "Cash Payments") {
                        setTimeout(function () { window.location.href = uRL + '/payment_success' }, 3000);
                    } else if (payment_method == "Instamojo Payment"){
                        setTimeout(function () { window.location.href = uRL + '/submit/' + dataResult }, 3000);
                    } else{
                        setTimeout(function () { window.location.href = uRL + '/' }, 3000);
                    }
                },
                error: function (dataResult) {
                    show_formAjax_error(dataResult);
                }
            });
        } else {
            alert('Please fill all the field !');
        }
    });

    // ========================================
    // script for User ContactUs module
    // ========================================
    
    $('#addContactUs').validate({
        rules: {
            name: { required: true },
            email: { required: true },
            phone: { required: true },
            message: { required: true }
        },
        submitHandler: function (form) {
            $('#addContactUs').append(loader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/contact',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your Message Submitted Successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function () { window.location.href = uRL + '/contact'; }, 1500);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: dataResult,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('.loader').remove();
                    }
                },
                error: function (data) {
                    show_formAjax_error(data)
                    $('.loader').remove();
                }
            });
        }
    });
});