(function ($) {
    'use strict';

    $('body').on('input propertychange', '.floating-label-form-group', function (e) {
        $(this).toggleClass('floating-label-form-group-with-value', !!$(e.target).val());
    }).on('focus', '.floating-label-form-group', function () {
        $(this).addClass('floating-label-form-group-with-focus');
    }).on('blur', '.floating-label-form-group', function () {
        $(this).removeClass('floating-label-form-group-with-focus');
    });

    if ($(window).width() > 992) {
        let headerHeight = $('#mainNav').height();
        $(window).on('scroll', {previousTop: 0},
            function () {
                let currentTop = $(window).scrollTop;
                let mainNav = $('#mainNav');
                if (currentTop < this.previousTop) {
                    if (currentTop > 0 && mainNav.hasClass('is-fixed')) {
                        mainNav.addClass('is-visible');
                    } else {
                        mainNav.removeClass('is-visible is-fixed');
                    }
                } else if (currentTop > this.previousTop) {
                    mainNav.removeClass('is-visible');
                    if (currentTop > headerHeight && !mainNav.hasClass('is-fixed')) {
                        mainNav.addClass('is-fixed');
                    }
                }
                this.previousTop = currentTop;
            });
    }

    if ($('#visual-content')[0] !== undefined) {
        tinymce.init({
            selector: '#visual-content',
            plugins: 'image',
            media_live_embeds: true,
            init_instance_callback: function (editor) {
                editor.on('Change', function (e) {
                    $('#visual-content').html(editor.getContent());
                });
            },
            height: 300,
            menubar: false
        });
    }

    $('#contactForm').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "/contact",
            data: $(this).serializeArray()
        })
            .done(function (msg) {
                let message = $('.message-status');
                if (msg === 'true') {
                    message.text('Wiadomość została wysłana!');
                    message.css('color', 'green');
                } else {
                    message.text('Wiadomość nie została wysłana!');
                    message.css('color', 'red');
                }
            });
    })

})(jQuery);
