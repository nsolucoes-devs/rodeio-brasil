(function($) {
    const Page = {
        init () {
            this.setListeners();
        },

        setListeners: () => {
            $(document).on('click', '.expand-image', Page.expandImage);

            // Outher Candidates carousel
            $(".outher-candidates-carousel").owlCarousel({
                autoplay: true,
                smartSpeed: 1000,
                margin: 10,
                dots: false,
                loop: true,
                nav : true,
                navText : [
                    '<i class="bi bi-arrow-left"></i>',
                    '<i class="bi bi-arrow-right"></i>'
                ],
                responsive: {
                    0:{
                        items:1
                    },
                    576:{
                        items:2
                    },
                    768:{
                        items:4
                    }
                }
            });
        },

        expandImage: (e) => {
            e.preventDefault();
            const $this = $(e.currentTarget);
            const src = $this.attr('src');
            const $modal = $('#image-modal');
            const $modalImage = $modal.find('.modal-image');
            $modalImage.attr('src', src);
            $modal.modal('show');
        }
    }

    $(document).ready(() => {
        Page.init();
    });
})(jQuery);

