
$(function () {
    function validateEmail(email) {
        var regEmail = /^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/;
        return jQuery.trim(email).toUpperCase().match(regEmail);
    }
    function validateName(name) {
        var regName =  /^[a-zA-Z ابتثجحخدذرزسشصضطظعغفقكلمنهويأإآىؤئءىة]+$/;
        return jQuery.trim(name).match(regName);
    }
    function validate_form(form) {
        var valid = true;
        var required = $('.required');
        var hasError = $('.has-error' ,form);
        $(form).removeClass("form-has-error");
        $(hasError).removeClass('has-error');
        $(hasError).siblings(".error").remove();
        $('.required', form).each(function () {
            if ($(this).val() == "") {
                valid = false;
                $(this).addClass('has-error');
                $(form).addClass("form-has-error");
                $(this).after('<p class="error">'+ form.data("empty") +'</p>');
            }
        });
        $('.email', form).each(function () {
            if ($(this).val() !== "" && !validateEmail($(this).val())) {
                valid = false;
                $(this).addClass('has-error');
                $(form).addClass("form-has-error");
                $(this).after('<p class="error">'+ $(this).data("validation") +'</p>');
            }
        });
        $('.name', form).each(function () {
            if ($(this).val() !== "" && !validateName($(this).val())) {
                valid = false;
                $(this).addClass('has-error');
                $(form).addClass("form-has-error");
                $(this).after('<p class="error">'+ $(this).data("validation") +'</p>');
            }
        });
        return valid;
    }

    function validate_newsletter(form){
        var valid = true;
        var required = $('.required');
        var hasError = $('.has-error' ,form);
        $(form).removeClass("form-has-error");
        $(hasError).removeClass('has-error');
        $(hasError).siblings(".error").remove();
        $('.required', form).each(function () {
            if ($(this).val() == "") {
                valid = false;
                $(form).addClass("form-has-error");
                $(".alertP", form).text(form.data("empty"));
            }
        });
        $('.email', form).each(function () {
            if ($(this).val() !== "" && !validateEmail($(this).val())) {
                valid = false;
                $(form).addClass("form-has-error");
                $(".alertP", form).text($(this).data("validation"));
            }
        });
        return valid;
    }
    $(".form-validate").submit(function () {
        var this_form = $(this);
        return  validate_form(this_form);
    });
    $(".form-validate-newsletter").submit(function () {
        var this_form = $(this);
        return  validate_newsletter(this_form);
    });

});