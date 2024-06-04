const Candidates = {
    init : () => {
        Candidates.setMasks();
        Candidates.setListener();
    },

    setMasks: () => {
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#phone').mask('(00) 00000-0000');
    },
    
    setListener: () => {
        $('#makeVote').on('click', Candidates.makeVote);
    },

    makeVote: () => {

        // validar recaptha 
        if(grecaptcha.getResponse() === '') {

            Swal.fire({
                title: "Recaptcha inválido!",
                text: "Por favor, valide o recaptcha",
                icon: "error",
                showCloseButton: true
            });

            return;
        }
        $.ajax({
            url: '/vote',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                cpf: $('#cpf').val(),
                phone: $('#phone').val(),
                full_name: $('#full_name').val(),
                candidate: $('#candidate').val(),
                recaptcha: grecaptcha.getResponse()
            },
            success: (data) => {
                Swal.fire({
                    title: "Voto computado com sucesso!",
                    text: "Obrigado por votar!",
                    icon: "success",
                    showCloseButton: true
                });

                window.location.reload();
            },
            error: (err) => {
                // recarregar recaptcha
                grecaptcha.reset();
                if(err.status === 422) {
                    Swal.fire({
                        title: "Preencha todos os campos!",
                        text: err.responseJSON.message,
                        icon: "error",
                        showCloseButton: true
                    });
                }

                if(err.status === 403) {
                    Swal.fire({
                        title: "Não pode votar novamente!",
                        text: err.responseJSON.message,
                        icon: "error",
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonText: "Quero ser um assinante!",
                        reverseButtons: true
                    }).then((result) => {
                        if(result.isConfirmed) {
                            $.ajax({
                                url: '/generatePaymentLink',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    cpf: $('#cpf').val(),
                                },
                                success: (data) => {

                                    Swal.fire({
                                        title: "Link de pagamento gerado!",
                                        text: "Em segundos, você será redirecionado para a página de pagamento!",
                                        icon: "success",
                                        showCloseButton: true
                                    })

                                    setTimeout(() => {
                                        window.open(data.url, '_blank');
                                    }, 3000);
                                },
                                error: (err) => {
                                    Swal.fire({
                                        title: "Erro ao gerar link de pagamento!",
                                        text: err.responseJSON.message,
                                        icon: "error",
                                        showCloseButton: true
                                    });
                                }
                            });
                        }
                    });
                }
            }
        });
    }
};

Candidates.init();

