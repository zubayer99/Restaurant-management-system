$(function () {

    var base_url = $('#url').val();

    var preLoader = `<div class="loader-container">
    <div class="loader">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>`;

    $('.modal').on('hidden.bs.modal', function () {
        console.log($('.modal').find('form').trigger('reset'));
    })
    
    // send csrf token with ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // show ajax error common function
    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $('.preloader').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    /* $('.change-logo').click(function () {
        $('.change-com-img').click();
    }); */

    // delete data common function
    function destroy_data(name, url) {
        $('.card .body').append(preLoader);
        var el = name;
        var id = el.attr('data-id');
        var dltUrl = url + id;
        if (confirm('Are you Sure Want to Delete This')) {
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.loader-container').remove();
                        el.parent().parent('tr').remove();
                        Swal.fire({
                            title: 'Success',
                            text: 'Deleted Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            });
        }else{
            $('.loader-container').remove();
        }
    }

    // admin logout
    $('.logout').click(function(){
        $.ajax({
            url: base_url+'/admin/logout',
            type: "POST",
            cache: false,
            dataType: 'json',
            success: function (dataResult) {
                if (dataResult.success == '1') {
                    window.location.href = base_url+'/admin/login';
                }
            }
        });
    })

    // delete contact message
    $(document).on("click", ".delete-contact-query", function () {
        destroy_data($(this), 'contact-query/')
    });
    

    // ========================================
    // script for Waiters module
    // ========================================

    $('#addWaiter').validate({
        rules: {
            name: { required: true },
            phone: { required: true },
            address: { required: true },
        },
        submitHandler: function (form) {
            $('#addWaiter').append(preLoader);
            var url = base_url + '/admin/waiters';
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1' || dataResult == '0'){
                        showNotification('bg-green', 'Saved Successfully');
                        window.location.href = url;
                    }else {
                        showNotification('bg-red', dataResult);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $(".btn").attr("disabled", false);
                }
            });
        }
    });

    $('#editWaiter').validate({
        rules: {
            name: { required: true },
            phone: { required: true },
            address: { required: true },
        },
        submitHandler: function (form) {
            $('#editWaiter').append(preLoader);
            var id = $('.url').val();
            var url = base_url + '/admin/waiters';
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1' || dataResult == '0') {
                        showNotification('bg-green', 'Updated Successfully');
                        window.location.href = url;
                    }else {
                        showNotification('bg-red', dataResult);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $(".btn").attr("disabled", false);
                }
            });
        }
    });

    $(document).on("click", ".delete-waiter", function () {
        destroy_data($(this), ' waiters/')
    });

    // ========================================
    // script for Category module
    // ========================================

    $('#addCategory').validate({
        rules: {
            category_name: { required: true },
            status: { required: true }
        },
        messages: {
            category_name: { required: "Please Enter Category Name" },
            status: { required: "Please Select status" }
        },
        submitHandler: function (form) {
            $('#addCategory').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url+'/admin/manage_category',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == "1" || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Saved Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/manage_category';
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    console.log(dataResult);
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $('#editCategory').validate({
        rules: {
            category_name: { required: true },
            status: { required: true }
        },
        messages: {
            category_name: { required: "Please Enter Category Name" },
            status: { required: "Please Select status" }
        },
        submitHandler: function (form) {
            $('#editCategory').append(preLoader);
            var id = $('.url').val();
            var formdata = new FormData(form);
            $(".btn").attr("disabled", true);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/manage_category';
                        },1500);
                    }else{
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on("click", ".delete-category", function () {
        destroy_data($(this), 'manage_category/')
    });

    // ========================================
    // script for Pages module
    // ========================================

    $('#addPage').validate({
        rules: {
            title: { required: true },
            content: { required: true },
            show_header: { required: true },
            show_footer: { required: true },
            status: { required: true }
        },
        submitHandler: function (form) {
            $('#addPage').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url+'/admin/pages',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == "1" || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Saved Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/pages';
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    console.log(dataResult);
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $('#updatePage').validate({
        rules: {
            title: { required: true },
            content: { required: true },
            show_header: { required: true },
            show_footer: { required: true },
            status: { required: true }
        },
        submitHandler: function (form) {
            $('#updatePage').append(preLoader);
            var formdata = new FormData(form);
            var id = $('.id').val();
            $.ajax({
                url: base_url+'/admin/pages/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/pages';
                        },1500);
                    }else{
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on("click", ".delete-page", function () {
        destroy_data($(this), 'pages/')
    });

    // ========================================
    // script for Menu Type module
    // ========================================

    $('#addMenu').validate({
        rules: { menu_name: { required: true }, 
                status: { required: true }
            },
        messages: { 
            menu_name: { required: "Please Enter Menu Type Name" }, 
            status: { required: "Please Enter Status" } 
        },
        submitHandler: function (form) {
            $('#addMenu').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url+'/admin/menu_type',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult){
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Saved Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    }else{
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on('click', '.editMenu', function () {
        var id = $(this).attr('data-id');
        var URL = base_url+'/admin/menu_type/' + id + '/edit';
        $.ajax({
            url: URL,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#defaultInfo .modal-content #editMenu').html(dataResult);
                $('#defaultInfo').modal('show');
            }, error: function (dataResult) {
                show_formAjax_error(dataResult);
            }
        });
    });

    $("#editMenu").validate({
        rules: {
            menu_name: { required: true },
            status: { required: true }
        },
        messages: {
            menu_name: { required: "Please Enter Menu Type Name" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form) {
            $('#editMenu').append(preLoader);
            var id = $('.id').val();
            var url = base_url + '/admin/menu_type/' + id;
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            $('#defaultInfo').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on("click", ".delete-menu", function () {
        destroy_data($(this), ' menu_type/')
    });

    // ========================================
    // script for Banner module
    // ========================================

    $('#addBanner').validate({
        rules: {
            title: { required: true },
            image: { required: true }
        },
        submitHandler: function (form) {
            $('#addBanner').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url+'/admin/banners',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == "1") {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Saved Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/banners';
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('loader-container').remove();
                }
            });
        }
    });

    $('#updateBanner').validate({
        rules: {
            title: { required: true },
            status: { required: true }
        },
        submitHandler: function (form) {
            $('#updateBanner').append(preLoader);
            var formdata = new FormData(form);
            var id = $('.id').val();
            $.ajax({
                url: base_url+'/admin/banners/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == "1" || dataResult == "0") {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/banners';
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on("click", ".delete-banner", function () {
        destroy_data($(this), 'banners/')
    });

    // ========================================
    // script for Manage Food module
    // ========================================

    $('#addFood').validate({
        rules: {
            food_name: { required: true },
            category: { required: true },
            menu_type: { required: true },
            time: { required: true },
            price: { required: true },
            status: { required: true }
        },
        messages: {
            food_name: { required: "Please Enter Food Name" },
            category: { required: "Please Select Category" },
            menu_type: { required: "Please Select Menu Type" },
            time: { required: "Please Enter Time" },
            price: { required: "Please Enter Price" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form){
            $('#addFood').append(preLoader);
            var url = base_url+'/admin/manage_food';
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult){
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Saved Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = url;
                        },1500);
                    } else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error : function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $('#editFood').validate({
        rules: {
            food_name: { required: true },
            category: { required: true },
            menu_type: { required: true },
            time: { required: true },
            price: { required: true },
            status: { required: true }
        },
        messages: {
            food_name: { required: "Please Enter Food Name" },
            category: { required: "Please Select Category" },
            menu_type: { required: "Please Select Menu Type" },
            time: { required: "Please Enter Time" },
            price: { required: "Please Enter Price" },
            status: { required: "Please Select Status" }
        },
        submitHandler: function (form) {
            $('#editFood').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            window.location.href = base_url+'/admin/manage_food';
                        },1500);
                    } else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on("click", ".delete-food", function (){
        destroy_data($(this), 'manage_food/')
    });

    // ========================================
    // script for Table List  module
    // ========================================

    $('#addTable').validate({
        rules: {
            table_name: { required: true },
            capacity: { required: true }
        },
        messages: {
            table_name: { required: "Please Enter Table Name" },
            capacity: { required: "Please Enter Capacity" },
        },

        submitHandler: function (form) {
            $('#addTable').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Saved Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on('click', '.edittable', function () {
        var id = $(this).attr('data-id');
        var url = 'table_list/' + id + '/edit';
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].table_id);
                $('#modal-info input[name=table_name]').val(dataResult[0].table_name);
                $('#modal-info input[name=capacity]').val(dataResult[0].capacity);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#editTable").validate({
        rules: {
            table_name: { required: true },
            capacity: { required: true }
        },
        messages: {
            table_name: { required: "Please Enter Table Name" },
            capacity: { required: "Please Enter Capacity" },
        },

        submitHandler: function (form) {
            $('#editTable').append(preLoader);
            var id = $('.table_id').val();
            var url = $('.url').val()+'/'+id;
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Success',
                                text: 'Updated Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on("click", ".delete-table", function () {
        destroy_data($(this), 'table_list/')
    });

    // ========================================
    // script for Customer List  module
    // ========================================

    $('#addCustomer').validate({
        rules: {
            customer_name: { required: true },
            email: {required: true },
            phone: { required: true },
        },
        messages: {
            customer_name: { required: "Please Enter Customer Name"},
            email: { required: "Please Enter Email" },
            phone: { required: "Please Enter Phone Number" },
        },
        submitHandler: function (form) {
            $('#addCustomer').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        Swal.fire({
                            title: 'Error',
                            text: dataResult,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){
                            $('.loader-container').remove();
                        },1500);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    $(document).on('click', '.editCustomer', function (){
        var id = $(this).attr('data-id');
        var url = base_url+'/admin/customer_list/' + id + '/edit';
        // alert(url);
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].customer_id);
                $('#modal-info input[name=customer_name]').val(dataResult[0].customer_name);
                $('#modal-info input[name=email]').val(dataResult[0].email);
                $('#modal-info input[name=old_password]').val(dataResult[0].password);
                $('#modal-info input[name=phone]').val(dataResult[0].phone);
                $('#modal-info input[name=address]').val(dataResult[0].address);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#editCustomer").validate({
        rules: {
            customer_name: { required: true },
            email: { required: true },
            phone: { required: true },
        },
        messages: {
            customer_name: { required: "Please Enter Customer Name" },
            email: { required: "Please Enter Email" },
            phone: { required: "Please Enter Phone Number" },
        },
        submitHandler: function (form) {
            $('#editCustomer').append(preLoader);
            var id = $('.customer_id').val();
            var url = $('.u-url').val() + '/' + id;
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if(dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: dataResult,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){
                            $('.loader-container').remove();
                        },1500);
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $(".btn").attr("disabled", false);
                }
            });
        }
    });

    // ========================================
    // script for Customer Types module
    // ========================================

    $('#addCustomerType').validate({
        rules: { title: { required: true }, },
        submitHandler: function (form) {
            $('#addCustomerType').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                },error: function (dataResult) {
                    setTimeout(function(){
                        $('.loader-container').remove();
                        show_formAjax_error(dataResult);
                    },1500);
                }
            });
        }
    });

    $(document).on('click', '.editCustomerType', function (){
        var id = $(this).attr('data-id');
        var url = 'customer_types/' + id + '/edit';
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].id);
                $('#modal-info input[name=title]').val(dataResult[0].title);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#updateCustomerType").validate({
        rules: { title: { required: true } },
        submitHandler: function (form) {
            $('#updateCustomerType').append(preLoader);
            var id = $('.id').val();
            var url = $('.u-url').val() + '/' + id;
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on("click", ".delete-customerType", function () {
        destroy_data($(this), 'customer_types/')
    });

    // ========================================
    // script for Country  module
    // ========================================

    $('#addCountry').validate({
        rules: { country_name: { required: true }, },
        messages: { country_name: { required: "Please Enter Country Name" } },
        submitHandler: function (form) {
            $('#addCountry').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                },error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on('click', '.editCountry', function (){
        var id = $(this).attr('data-id');
        var url = 'country/' + id + '/edit';
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].country_id);
                $('#modal-info input[name=country_name]').val(dataResult[0].country_name);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#editCountry").validate({
        rules: { country_name: { required: true } },
        messages: { country_name: { required: "Please Enter Country Name" } },

        submitHandler: function (form) {
            $('#editCountry').append(preLoader);
            var id = $('.country_id').val();
            var url = $('.u-url').val() + '/' + id;
            var formdata = new FormData(form);
            $(".btn").attr("disabled", true);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on("click", ".delete-country", function () {
        destroy_data($(this), 'country/')
    });

    // ========================================
    // script for State  module
    // ========================================

    $('#addState').validate({
        rules: { 
            state: { required: true }, 
            country: { required: true }
        },
        messages: { 
            state: { required: "Please Enter State Name" } ,
            country: { required: "Please Enter Country Name" } 
        },
        submitHandler: function (form) {
            $('#addState').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $(".btn").attr("disabled", true);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on('click', '.editState', function () {
        var id = $(this).attr('data-id');
        var url = base_url + '/admin/state/' + id + '/edit';
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].state_id);
                $('#modal-info input[name=state]').val(dataResult[0].state_name);
                $('#modal-info input[name=country]').val(dataResult[0].country_id);
                $("#modal-info select[name=country] option").each(function () {
                    if ($(this).val() == dataResult[0].country_id) {
                        $(this).attr('selected', true);
                        $('select[name=country]').val($(this).val());
                        $('select[name=country]').selectpicker('refresh')
                    }
                });
                $('#modal-info').modal('show');
            }
        });
    });

    $("#editState").validate({
        rules: {
            state: { required: true },
            country: { required: true }
        },
        messages: {
            state: { required: "Please Enter State Name" },
            country: { required: "Please Enter Country Name" }
        },
        submitHandler: function (form) {
            $('#editState').append(preLoader);
            var id = $('.state_id').val();
            var url = $('.u-url').val() + '/' + id;
            var formdata = new FormData(form);
            $(".btn").attr("disabled", true);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if(dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                },error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on("click", ".delete-state", function (){
        destroy_data($(this), 'state/')
    });

    // ========================================
    // script for City  module
    // ========================================

    $('#addCity').validate({
        rules: {
            state: { required: true },
            city_name: { required: true }
        },
        messages: {
            state: { required: "Please Enter State Name" },
            city_name: { required: "Please Enter City Name" }
        },
        submitHandler: function (form) {
            $('#addCity').append(preLoader);
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    } else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on('click', '.editcity', function () {
        var id = $(this).attr('data-id');
        var url = 'city/' + id + '/edit';
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=city_id]').val(dataResult[0].city_id);
                $('#modal-info input[name=state]').val(dataResult[0].state_id);
                $("#modal-info select[name=state] option").each(function () {
                    if ($(this).val() == dataResult[0].state_id) {
                        $(this).attr('selected', true);
                        $('select[name=state]').val($(this).val());
                        $('select[name=state]').selectpicker('refresh')
                    }
                });
                $('#modal-info input[name=city_name]').val(dataResult[0].city_name);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#editCity").validate({
        rules: {
            state: { required: true },
            city_name: { required: true }
        },
        messages: {
            state: { required: "Please Enter State Name" },
            city_name: { required: "Please Enter City Name" }
        },
        submitHandler: function (form) {
            $('#editCity').append(preLoader);
            var id = $('.city').val();
            var url = $('.u-url').val() + '/' + id;
            var formdata = new FormData(form);
            $(".btn").attr("disabled", true);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    } else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on("click", ".delete-city", function () {
        destroy_data($(this), 'city/')
    });

    // ========================================
    // script for Payment Method module
    // ========================================

    $('#addPayment').validate({
        rules: {
            payment_name: { required: true },
            status: { required: true }
        },
        messages: {
            payment_name: { required: "Please Enter Payment Method Name" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form) {
            $('#addPayment').append(preLoader);
            var url = base_url+'/admin/payment_method';
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.reload();
                        },1500);
                    } else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on('click', '.editPayment', function () {
        var id = $(this).attr('data-id');
        var url = base_url + '/admin/' + id + '/edit';
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].payment_id);
                $('#modal-info input[name=payment_name]').val(dataResult[0].payment_name);
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult[0].payment_id);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#editPayment").validate({
        rules: {
            payment_name: { required: true },
            status: { required: true }
        },
        messages: {
            payment_name: { required: "Please Enter Payment Method Name" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form) {
            $('#editPayment').append(preLoader);
            var id = $('.payment_id').val();
            var url = base_url + '/admin/payment_method/' + id;
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#modal-info').modal('hide');
                            window.location.reload();
                        },1500);
                    } else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on("click", ".delete-payment", function () {
        destroy_data($(this), 'payment_method/')
    });

    

    // ========================================
    // script for Reservation module
    // ========================================
    $('#CheckReservation').validate({
        rules: {
            date: { required: true },
            time: { required: true },
            person: { required: true }
         
        },
        submitHandler: function (form) {
            var date = $('.date').val();
            var start_time = $('.start_time').val();
            var person = $('.no_person').val();
            var formdata = new FormData(form);
            $.ajax({
                url: base_url+'/admin/reservation/check',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult){
                    $('#defaultModal input[name=date]').val(date);
                    $('#defaultModal input[name=start_time]').val(start_time);
                    $('#defaultModal input[name=no_person]').val(person);
                    // if (dataResult == '') {
                    //     $('.availabletable').append('<h2>No Table found!!!</h2>');
                    // } else { 
                    //     var output = '<ul class="table-list row">';
                    //     $.each(dataResult, function (i, v) {
                    //         output += '<li class="col-md-2"><button type="button" data-id="' + v.table_id + '" class="table_id bg-red" onclick="addReservation()">' + v.table_name + '</button></li>';
                    //     });
                    //     output += '</ul>';
                    //     console.log(output);
                    // }
                    $('.availabletable').html(dataResult);
                    
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                }
            });
        }
    }); 
 
    $(document).on('click', '.table_id', function (){
        var id = $(this).attr('data-id');
        var text = $(this).text();
        $('#defaultModal input[name=table]').val(text);
        $('#defaultModal input[name=table_no]').val(id);
        $('#defaultModal').modal('show');
       
    });


    $('#addReservation').submit(function(e){
        e.preventDefault();
        var table = $('input[name=table_no]').val();
        var person = $('input[name=no_person]').val();
        var date = $('input[name=date]').val();
        var start_time = $('input[name=start_time]').val();
        var end_time = $('input[name=end_time]').val();
        var c_name = $('input[name=c_name]').val();
        var c_phone = $('input[name=c_phone]').val();
        if(table == '' || person == '' || date == '' || start_time == '' || end_time == '' || c_name == '' || c_phone == ''){
            $('.message-box').html('<div class="alert alert-danger">Fill all the fields.</div>');
        }else{
            $('#addReservation').append(preLoader);
            $.ajax({
                url: base_url+'/admin/reservation',
                type: 'POST',
                data: {table_no:table,no_person:person,date:date,start_time:start_time,end_time:end_time,customer_name:c_name,phone:c_phone},
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Saved Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            $('#defaultModal').modal('hide');
                            window.location.href = base_url+'/admin/reservation';
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });


    $('#editReservation').validate({
        rules: {
            end_time: { required: true },
            customer_id: { required: true },
            phone: { required: true },
            status: { required: true }
        },
        messages: {
           end_time: { required: "Please Enter Your End Time" },
           customer_id: { required: "Please Enter Customer Name" },
           status: { required: "Please Enter status" }
        },

        submitHandler: function (form) {
            $('#editReservation').append(preLoader);
            var id = $('.url').val();
            var url = base_url + '/admin/reservation';
            var formdata = new FormData(form);
            $(".btn").attr("disabled", true);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if(dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            window.location.href = url;
                        },1500);
                    }else {
                        setTimeout(function(){
                            $('.loader-container').remove();
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        },1500);
                    }
                }, error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $(document).on("click", ".delete-reservation", function () {
        destroy_data($(this), ' reservation/')
    });

    // ========================================
    //  script for Oder List module
    // ========================================
    // $(document).on('click', '.get-cat-items', function () {
    $('.get-cat-items').on('change',function () {
        var id = $(this).val();
        var url = base_url + '/admin/get-cat-items';
        $.ajax({
            url: url,
            type: "POST",
            data: {id:id},
            success: function (dataResult) {
                console.log(dataResult)
                $('.food_items').empty();
                $('.food_items').append(dataResult);
            }
        });
    });

    $('.search-item').keyup(function(){
        var val = $(this).val();
        var cat = $('.get-cat-items option:selected').val();
        var url = base_url + '/admin/search-items';
        if(val != ''){
            $.ajax({
                url: url,
                type: "POST",
                data: {search:val,cat:cat},
                success: function (dataResult) {
                    $('.food_items').empty();
                    $('.food_items').append(dataResult);
                }
            });
        }
    });

    $('.customer_type').change(function(e){
        e.stopPropagation();
        var val = $('.customer_type option:selected').attr('data-slug');
        console.log(val);
        if(val == 'take-away'){
            $('.table_box').css('display','none');
            $('.waiter_box').css('display','none');
        }else if(val == 'dine-in-customer'){
            $('.table_box').css('display','block');
            $('.waiter_box').css('display','block');
        }else if(val == 'online-customer'){
            $('.table_box').css('display','none');
            $('.waiter_box').css('display','none');
        }else if(val == 'third-party-platform'){
            $('.table_box').css('display','none');
            $('.waiter_box').css('display','none');
        }
    });



    $(document).on('click', '.thumbnail', function () {
        var id = $(this).attr('data-id');
        addTable(id);
    });

    if(localStorage.getItem("FoodItem") !== null){
        addTable();
    }


    function addTable(id = null){
        var dltUrl = $('.dlt-url').val();
        if(id == null){
            if (typeof (Storage) !== "undefined" && localStorage.getItem("FoodItem") !== "" ) {
                var food = JSON.parse(localStorage.getItem("FoodItem"));
            } else {
                var food = [];
            }
        }else{
            if (typeof (Storage) !== "undefined" && localStorage.getItem("FoodItem") !== "" ) {
                var food = JSON.parse(localStorage.getItem("FoodItem")) || [];
                food.push(id);
                localStorage.setItem("FoodItem", JSON.stringify(food));
            } else {
                var food = [];
                food.push(id);
                localStorage.setItem("FoodItem", JSON.stringify(food));
            }  
        }
        if(food.length > 0){
            $.ajax({
                url: dltUrl,
                type: "POST",
                data: { items: food},
                cache: false,
                success: function (dataResult) {
                    $(".table-responsive").css("display", "block");
                    $(".item_table tbody").html(dataResult);
                    sub_total(); 
                }
            });
        }
    }

    $(document).on("click", ".deleteFood", function () {
        var id = $(this).attr('data-id');
        if(localStorage.getItem("FoodItem") !== null){
            var food = JSON.parse(localStorage.getItem("FoodItem"));
            food = $.grep(food, function (n) {
                return n != id;
            });
            localStorage.setItem("FoodItem", JSON.stringify(food));
        }
       
        $(this).parent().parent('tr').remove();
        sub_total();
    });

    function sub_total() {
        var amount = 0;
        $('.subtotal').each(function () {
            var val = $(this).html();
            var total = parseInt(amount) + parseInt(val);
            amount = total;
        });
        $('.total-amount').html(amount);
        calculate_tax();
    }

    function calculate_tax(){
        var amt = $('.total-amount').html();
        var tax = $('input[name=tax_percent]').val();
        var tax_amt = parseInt(amt)*tax/100;
        $('.tax-amount').html(tax_amt);
        net_total();
    }

    function net_total(){
        var amt = $('.total-amount').html();
        var tax = $('.tax-amount').html();
        var net_amt = parseInt(amt)+parseInt(tax);
        $('.net-amount').html(net_amt);
    }
  
    $(document).on("change", ".qty_value", function () {
        var qty = $(this).val();
        var price = $(this).parents('td').siblings('.price').text();
        var new_price = (qty * price);
        $(this).parents().siblings('.subtotal').html(new_price);
        sub_total();
    });

    // ========================================
    // script for Add Order module
    // ========================================
    $('.order_complete').click(function (e){
        e.preventDefault();
        $('.card').append(preLoader);
        var url = base_url + '/admin/order_list';
        var customer_name = $('.customer_name option:selected').val();
        var customer_type = $('.customer_type option:selected').val();
        var table_list = $('.table_list option:selected').val();
        var waiter = $('.waiter_list option:selected').val();
        var total_amount = $('.total-amount').html();
        var tax_amount = $('.tax-amount').html();
        var net_amount = $('.net-amount').html();
        var food_qty = [];
        $('input[name="food_qty[]"]').each(function () {
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
        if (customer_name != "" && table_list != "" && food_qty.length != 0 && food_price.length != 0 && food_id.length != 0) {
            // $(".btn").attr("disabled", true);
            $.ajax({
                url: url,
                method: 'POST',
                data: { customer_name: customer_name,customer_type: customer_type, table: table_list, waiter: waiter, food_qty: food_qty, food_price: food_price, food_id: food_id,total_amount:total_amount,tax_amount:tax_amount,net_amount:net_amount},
                success: function (dataResult){
                    console.log(dataResult);
                    if(dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Order Created Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        localStorage.removeItem("FoodItem");
                        window.location.href = url;
                    }else {
                        showNotification('bg-red', dataResult);
                    }
                },error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }else {
            $('.loader-container').remove();
            var msg = '';
            if(customer_name == ''){
                msg = 'Customer Name is Empty';
            }else if(table_list == ''){
                msg = 'Select Table';
            }else if(food_id.length == 0){
                msg = 'Select Items (no items found)';
            }
            Swal.fire({
                title: 'Warning',
                text: msg,
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

    $('.update_order').click(function (e){
        e.preventDefault();
        $('.card').append(preLoader);
        var customer_name = $('.customer_name option:selected').val();
        var customer_type = $('.customer_type option:selected').val();
        var table_list = $('.table_list option:selected').val();
        var waiter = $('.waiter_list option:selected').val();
        var total_amount = $('.total-amount').html();
        var tax_amount = $('.tax-amount').html();
        var net_amount = $('.net-amount').html();
        var food_qty = [];
        $('input[name="food_qty[]"]').each(function () {
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
        if (customer_name != "" && table_list != "" && food_qty.length != 0 && food_price.length != 0 && food_id.length != 0) {
            // $(".btn").attr("disabled", true);
            var id = $('input[name=order_id]').val();
            var token = $('meta[name=csrf-token]').attr('content');
            var method = 'PUT';
            $.ajax({
                url: base_url+'/admin/order_list/'+id,
                method: 'POST',
                data: { customer_name: customer_name,customer_type: customer_type, table: table_list, waiter: waiter, food_qty: food_qty, food_price: food_price, food_id: food_id,total_amount:total_amount,tax_amount:tax_amount,net_amount:net_amount,_method:method,_token:token},
                success: function (dataResult){
                    console.log(dataResult);
                    if(dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Order Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        localStorage.removeItem("FoodItem");
                        window.location.href = base_url+'/admin/order_list';
                    }else {
                        showNotification('bg-red', dataResult);
                    }
                },error: function (dataResult) {
                    $('.loader-container').remove();
                    show_formAjax_error(dataResult);
                }
            });
        }else {
            $('.loader-container').remove();
            var msg = '';
            if(customer_name == ''){
                msg = 'Customer Name is Empty';
            }else if(table_list == ''){
                msg = 'Select Table';
            }else if(food_id.length == 0){
                msg = 'Select Items (no items found)';
            }
            Swal.fire({
                title: 'Warning',
                text: msg,
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

        
    $('.delete-orderMenu').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
                url: base_url + '/admin/cancel_order/'+id,
                type: 'GET',
                success: function (dataResult) {
                    window.location.reload();
                }
            });
        
    });

    $('.complete-order').click(function(){
        var method = $('.pay_method option:selected').val();
        var id = $('.id').val();
        $('.card').append(preLoader);
        $.ajax({
            url: base_url + '/admin/complete_order',
            type: 'POST',
            data: {method:method,id:id},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1' || dataResult == '0') {
                    Swal.fire({
                        title: 'Success',
                        text: 'Completed Successfully',
                        icon: 'success',
                        showConfirmButton: false,
                    })
                    setTimeout(function () {
                        $('.response-alert').remove();
                        window.location.href = base_url+'/admin/on_going_order';
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



    // ========================================
    // script for GeneralSetting module
    // ========================================
    $('#updateGeneralSetting').validate({
        rules: {
            app_title: { required: true },
            store_name: { required: true },
            address: { required: true },
            email: { required: true },
            phone: { required: true },
            opening_time: { required: true },
            closing_time: { required: true },
            tax_percent: { required: true },
            service_charge: { required: true },
            curr_format: { required: true },
            copyright_text: { required: true },
            theme_color: { required: true },
        },
        submitHandler: function (form) {
            $('#updateGeneralSetting').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url + '/admin/general_settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
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
                        
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });

    // ========================================
    // script for Social Links module
    // ========================================
    $('#updateSocialLinks').validate({
        rules: {
            facebook: { required: true },
            instragram: { required: true },
            twitter: { required: true },
            linked_in: { required: true },
            you_tube: { required: true }
        },
        messages: {
            facebook: { required: "Please Enter Your Facebook Link" },
            instragram: { required: "Please Enter Your Instagram Link" },
            twitter: { required: "Please Enter Your Twitter Link" },
            linked_in: { required: "Please Enter Your linkedln Link" },
            you_tube: { required: "Please Enter Your YouTube Link" },
        },
        submitHandler: function (form) {
            $('#updateSocialLinks').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url+'/admin/social_links',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            window.location.reload();
                        },1500);
                    }else {
                        setTimeout(function(){
                            Swal.fire({
                                title: 'Error',
                                text: dataResult,
                                icon: 'error',
                                showConfirmButton: false,
                            })
                            $('.loader-container').remove();
                        },1500);
                    }
                },error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });


    $('#updateKitchenSettings').validate({
        rules: {
            username: { required: true },
            status: { required: true },
        },
        submitHandler: function (form) {
            $('#updateKitchenSettings').append(preLoader);
            var formdata = new FormData(form);
            $.ajax({
                url: base_url + '/admin/kitchen-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Updated Successfully',
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
                        
                    }
                }, error: function (dataResult) {
                    show_formAjax_error(dataResult);
                    $('.loader-container').remove();
                }
            });
        }
    });





    
});