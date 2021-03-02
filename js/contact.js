(function enviar_correo() {
    "use strict";

    jQuery(document).ready(function ($) {
        $(document).on('submit', '#main_contact_form', function (e) {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var subject = $('#subject').val();
            var message = $('#message').val();

            if (name && email && subject && message) {
                $.ajax({
                    type: "POST",
                    url: '../contact.php',
                    data: {
                        'name': name,
                        'email': email,
                        'subject': subject,
                        'message': message,
                    },
                    success: function (data) {
                        $('#contact_form_submit').children('.email-success').remove();
                        $('#contact_form_submit').prepend('' + data + '');
                        $('#name').val('');
                        $('#email').val('');
                        $('#message').val('');
                        $('.email-success').fadeOut(3000);
                    },
                    error: function (res) {

                    }
                });
            } else {
                $('#contact_form_submit').children('.email-success').remove();
                $('#contact_form_submit').prepend('');
                $('.email-success').fadeOut(3000);
            }

        });
    })

}(jQuery));