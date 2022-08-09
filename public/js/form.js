(function ($) {
    "use strict";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete-confirm').on('click', function(event) {
        let url = $(this).data('action');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function(response){
                        if (response.redirect){
                            if (response.message){
                                Sweet('success', response.message)
                            }
                            window.location.href = response.redirect;
                        }else{
                            Sweet('success', response)
                        }
                    },
                    error: function(xhr, status, error)
                    {
                        if (xhr.responseJSON.message){
                            Sweet('error', xhr.responseJSON.message);
                        } else if (xhr.responseJSON){
                            Sweet('error', xhr.responseJSON);
                        }else {
                            Sweet('error', xhr.responseText);
                        }
                    }
                })
            }
        })
    });


    $(document).on('submit', '.ajaxform_with_redirect', function (e) {
        e.preventDefault();

            var basicBtnHtml = $('.basicbtn').html();

            $.ajax({
                type: 'POST',
                url: this.action,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.basicbtn').html('Please Wait....');
                    $('.basicbtn').attr('disabled', '');
                },
                success: function (response) {
                    if (response.message) {
                        Sweet('success', response.message);
                    }
                    if (response.redirect) {
                        if (response.message) {
                            window.setTimeout(function () {
                                window.location.href = response.redirect;
                            }, 1500)
                        } else {
                            window.location.href = response.redirect;
                        }
                    }
                },
                error: function (xhr) {
                    $('.basicbtn').html(basicBtnHtml);
                    $('.basicbtn').removeAttr('disabled');

                    if (xhr.responseJSON.message) {
                        Sweet('error', xhr.responseJSON.message);
                    } else if (xhr.responseJSON) {
                        Sweet('error', xhr.responseJSON);
                    } else {
                        Sweet('error', xhr.responseText);
                    }

                    showInputErrors(xhr.responseJSON)
                }
            });
    });



    /*-------------------------
        Ajaxform with Submit
    -----------------------------*/


    $(".ajaxform").on('submit', function (e) {
        e.preventDefault();

            var basicBtnHtml = $('.basicbtn').html();

            $.ajax({
                type: 'POST',
                url: this.action,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.basicbtn').html("Please Wait....");
                    $('.basicbtn').attr('disabled', '');
                },
                success: function (response) {
                    $('.basicbtn').html(basicBtnHtml);
                    $('.basicbtn').removeAttr('disabled');
                    $('.ajaxform').trigger('reset');
                    Sweet('success', response);
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON.message) {
                        Sweet('error', xhr.responseJSON.message);
                    }
                    $('.basicbtn').html(basicBtnHtml);
                    $('.basicbtn').removeAttr('disabled');

                }
            });
    });

    $(".ajaxform_without_reset").on('submit', function (e) {
        e.preventDefault();

        var basicBtnHtml = $('.basicbtn').html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '');
            },
            success: function (response) {
                $('.basicbtn').html(basicBtnHtml);
                $('.basicbtn').removeAttr('disabled');
                Sweet('success', response);
            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON.message) {
                    Sweet('error', xhr.responseJSON.message);
                }
                $('.basicbtn').html(basicBtnHtml);
                $('.basicbtn').removeAttr('disabled');

            }
        });
    });





})(jQuery);

/*---------------------------
        Sweet Alert Active
    -----------------------------*/
function Sweet(icon, title, time = 3000) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: time,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });


    Toast.fire({
        icon: icon,
        title: title,
    });
}





