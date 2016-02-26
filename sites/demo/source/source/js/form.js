jQuery(document).ready(function($) {

    var onFormSubmit = function(e) {
        // Prevent form submission
        e.preventDefault();

        var $form = $(e.target),
            fv    = $form.data('formValidation');

        // Use Ajax to submit form data
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {

                // Conversion code.
                var url = '/conversion';

                var iframe = document.createElement('iframe');
                iframe.style.width = '0px';
                iframe.style.height = '0px';
                document.body.appendChild(iframe);
                iframe.src = url;

                $form
                    .formValidation('resetForm', true)
                    .find('.after')
                    .removeClass('hidden')
                    .find('.before')
                    .removeClass('show');


            },
            error: function(jqXHR, textStatus, errorThrown ) {

                $form
                    .find('.error')
                    .removeClass('hidden');
            }

        });
    };

    var formValidationConfig = {
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, indique su nombre.'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, indique su telefono.'
                    },
                    phone: {
                        country: 'ES',
                        message: 'Lo sentimos no es un numero de telefono válido.'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, indique su email.'
                    },
                    emailAddress: {
                        message: 'Lo sentimos no es una dirección de email válida.'
                    }
                }
            }
        }
    };

    $('form.ajax-form')
        // Validate behaviour.
        .formValidation(formValidationConfig)

        // AJAX behaviour for the form.
        .on('success.form.fv', onFormSubmit);
});