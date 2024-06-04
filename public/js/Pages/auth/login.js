const login = {
    init() {
        this.setListeners();
    },

    setListeners: () => {
        $(document).on('submit', '#formAuthentication', login.submit);
    },


    submit: (e) => {
        e.preventDefault();

        let form = $(e.target);
        let data = form.serialize();
        let url = form.attr('action');

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            success: (response) => {
                window.location.href = response.redirect;
            },
            error: (response) => {
                const message = response.responseJSON.message || 'Erro ao realizar login';

                swal.fire({
                    title: 'Erro',
                    text: message,
                    icon: 'error'
                });
            }
        });
    }
};

$(function() {
    $(document).ready(function() {
        login.init();
    });
});
