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
    $('#adminLogin').validate({
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
                url: base_url+'/admin/login',
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
                            window.location.href = base_url+'/admin/dashboard';
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
})

