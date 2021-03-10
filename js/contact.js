document.addEventListener("touchstart", function() {}, false);
(function($) {
    "use strict";
    $(function() {
        var randNumber_1 = parseInt(Math.ceil(Math.random() * 15), 10);
        var randNumber_2 = parseInt(Math.ceil(Math.random() * 15), 10);
        humanCheckCaptcha(randNumber_1, randNumber_2);
    });

    function humanCheckCaptcha(randNumber_1, randNumber_2) {
        $("#humanCheckCaptchaBox").html("Solve The Math ");
        $("#firstDigit").html('<input name="mathfirstnum" id="mathfirstnum" class="form-control" type="text" value="' + randNumber_1 + '" readonly>');
        $("#secondDigit").html('<input name="mathsecondnum" id="mathsecondnum" class="form-control" type="text" value="' + randNumber_2 + '" readonly>');
    }
    $("#contactForm").validator().on("submit", function(event) {
		var parametros =$(this).serialize();
        if (event.isDefaultPrevented()) {
            formError();
            submitContactFormActionMSG(false, "Please complete the form correctly");
        } else {
            var fname = $("#fname").val();
            var email = $("#email").val();
            var subject = $("#subject").val();
            var message = $("#message").val();
            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;

            event.preventDefault();
            $.ajax({
                    type: "POST",
                    url: "contact.php",
                    data: parametros,
                    success: function(text) {
                        if (text == "success") {
                            contactFormSuccess();
                        } else {
                            formError();
                            submitContactFormActionMSG(false, text);
                        }
                    }
                });
        }
    });

    function submitContactFormActionMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center text-success col-md-12";
        } else {
            var msgClasses = "h3 text-center text-danger col-md-12";
        }
        $("#msgContactSubmit").removeClass().addClass(msgClasses).text(msg);
        return false;
    }

    function contactFormSuccess() {
        submitContactFormActionMSG(true, "The data has been sent successfully");
    }


   

    

    function formError() {
        $(".help-block.with-errors").removeClass('hidden');
    }
})(jQuery);