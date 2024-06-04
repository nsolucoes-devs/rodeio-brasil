const register = {
    init() {
        this.setListeners();
    },

    setListeners: () => {
        $('#formAuthentication').validate(register.optionsToValidate());

        $(document).on('submit', '#formAuthentication', register.submit);
    },

    submit: (e) => {
        e.preventDefault();

        const form = $(e.target);
        const url = form.attr('action');
        const formData = new FormData(e.target);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: () => {
                form.find('button[type="submit"]').attr('disabled', true);
            },
            complete: () => {
                form.find('button[type="submit"]').attr('disabled', false);
            },
            success: (response) => {
                window.location.href = response.redirect;
            },
            error: (response) => {
                const message = response.responseJSON.message || 'Erro ao realizar login';

                swal({
                    title: 'Erro',
                    text: message,
                    type: 'error'
                });
            }
        });
    },

    optionsToValidate() {
        return {
            errorElement: "span",
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                },
                document: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                    confirmed: true,
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password',
                },
            },
            messages: {
                name: {
                    required: 'O campo nome é obrigatório.',
                    minlength: 'O campo nome deve ter no mínimo 3 caracteres.',
                    maxlength: 'O campo nome deve ter no máximo 255 caracteres.',
                },
                email: {
                    required: 'O campo email é obrigatório.',
                    email: 'O campo email deve ser um email válido.',
                },

                password: {
                    required: 'O campo senha é obrigatório.',
                    minlength: 'O campo senha deve ter no mínimo 8 caracteres.',
                },

                password_confirmation: {
                    required: 'O campo confirmar senha é obrigatório.',
                    equalTo: 'O campo confirmar senha deve ser igual ao campo senha.',
                },
            },

            submitHandler: function(form) {
                form.submit();
            },
        });
    },
};

$(function() {
    $(document).ready(function() {
        register.init();
    });
});
