/*--------------------- Copyright (c) Restaurant and Catering -----------------------
[Master Javascript]
Project: Restaurant and Catering html
-------------------------------------------------------------------*/
(function($) {
    "use strict";
    var Catering = {
        initialised: false,
        version: 1.0,
        mobile: false,
        init: function() {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-------------- Restaurant and Catering Functions Calling ---------------------------------------------------
            ------------------------------------------------------------------------------------------------*/

            this.loader();
            this.bottom_top();
            this.toggle_menu();
            this.menu_tab();
            this.team_slider();
            this.testi_slider();
            this.history_slider();
            this.gallery_grid();
            this.formValidation();
            this.copy_right();
        },

        /*-------------- Restaurant and Catering Functions Calling ---------------------------------------------------
        --------------------------------------------------------------------------------------------------*/

        /*-----------------------------------------------------
            Loader
        -----------------------------------------------------*/
        loader: function() {
            $(window).on("load", function() {
                $(".loader").fadeOut();
                $(".spinner").delay(500).fadeOut("slow");
            });
        },


        /*-----------------------------------------------------
            Bottom To Top
        -----------------------------------------------------*/
        bottom_top: function() {
            if ($("#button").length > 0) {
                var btn = $("#button");
                var fixed = $(".rac_header_wrapper");
                $(window).scroll(function() {
                    if ($(window).scrollTop() > 200) {
                        btn.addClass("show");
                        fixed.addClass("fixed");
                    } else {
                        btn.removeClass("show");
                        fixed.removeClass("fixed");
                    }
                });
                btn.on("click", function(e) {
                    e.preventDefault();
                    $("html, body").animate({
                        scrollTop: 0
                    }, "200");
                });
            }
        },

        /*-----------------------------------------------------
            Toggle Menu
        -----------------------------------------------------*/
        toggle_menu: function() {
            $(document).on("click", function(event) {
                var $trigger = $(".rac_toggle_btn");
                if ($trigger !== event.target && !$trigger.has(event.target).length) {
                    $("body").removeClass("menu-open");
                }
            });
            $(".rac_toggle_btn").on("click", function() {
                $("body").toggleClass("menu-open");
            });
        },

        /*-----------------------------------------------------
            Menus Tabs
        -----------------------------------------------------*/
        menu_tab: function() {
            $('.rac_menu_tab li a').on('click', function() {
                var target = $(this).attr('data-rel');
                $('.rac_menu_tab li a').removeClass('active');
                $(this).addClass('active');
                $("#" + target).fadeIn('slow').siblings(".rac_tab_pane").hide();
                return false;
            });
        },

        /*-----------------------------------------------------
            Team Slider
        -----------------------------------------------------*/
        team_slider: function() {
            var swiper = new Swiper('.rac_chefs_slider .swiper', {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                speed: 3000,
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".rac_chefs_slider .swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    575: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    }
                }
            });
        },

        /*-----------------------------------------------------
            Testimonials Slider
        -----------------------------------------------------*/
        testi_slider: function() {
            var swiper = new Swiper('.rac_testimonial_slider .swiper', {
                slidesPerView: 2,
                spaceBetween: 30,
                loop: true,
                speed: 3000,
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".rac_testimonial_slider .swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    575: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    }
                }
            });
        },

        /*-----------------------------------------------------
            History Slider
        -----------------------------------------------------*/
        history_slider: function() {
            var swiper = new Swiper(".rac_history_slider .swiper", {
                slidesPerView: 1,
                loop: true,
                spaceBetween: 10,
                speed: 3000,
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".rac_history_slider .swiper-pagination",
                    clickable: true,
                    renderBullet: function(index, className) {
                        return '<span class="' + className + '">' + (index + 2020) + "</span>";
                    },
                },
                breakpoints: {
                    1199: {
                        direction: "vertical",
                        spaceBetween: 30,
                    },
                    0: {
                        direction: "horizontal",
                    }
                }
            });
        },

        /*-----------------------------------------------------
            Gallery Grid
        -----------------------------------------------------*/
        gallery_grid: function() {
            $('.grid').isotope({
                itemSelector: '.grid-item',
            });
            $("#gallery").lightGallery({
                mode: 'lg-fade',
                cssEasing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            });
        },

        /*-----------------------------------------------------
            Form Validation
        -----------------------------------------------------*/

        formValidation: function() {
            function checkRequire(formId, targetResp) {
                targetResp.html('');
                var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
                var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
                var image = /\.(jpe?g|gif|png|PNG|JPE?G)$/;
                var mobile = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
                var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
                var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
                var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
                var check = 0;
                $('#er_msg').remove();
                var target = (typeof formId == 'object') ? $(formId) : $('#' + formId);
                target.find('input , textarea , select').each(function() {
                    if ($(this).hasClass('require')) {
                        if ($(this).val().trim() == '') {
                            check = 1;
                            $(this).focus();
                            $(this).parent('div').addClass('form_error');
                            targetResp.html('You missed out some fields.');
                            $(this).addClass('error');
                            return false;
                        } else {
                            $(this).removeClass('error');
                            $(this).parent('div').removeClass('form_error');
                        }
                    }
                    if ($(this).val().trim() != '') {
                        var valid = $(this).attr('data-valid');
                        if (typeof valid != 'undefined') {
                            if (!eval(valid).test($(this).val().trim())) {
                                $(this).addClass('error');
                                $(this).focus();
                                check = 1;
                                targetResp.html($(this).attr('data-error'));
                                return false;
                            } else {
                                $(this).removeClass('error');
                            }
                        }
                    }
                });
                return check;
            }
            $(".submitForm").on('click', function() {
                var _this = $(this);
                var targetForm = _this.closest('form');
                var errroTarget = targetForm.find('.response');
                var check = checkRequire(targetForm, errroTarget);

                if (check == 0) {
                    var formDetail = new FormData(targetForm[0]);
                    formDetail.append('form_type', _this.attr('form-type'));
                    $.ajax({
                        method: 'post',
                        url: 'ajaxmail.php',
                        data: formDetail,
                        cache: false,
                        contentType: false,
                        processData: false
                    }).done(function(resp) {
                        console.log(resp);
                        if (resp == 1) {
                            targetForm.find('input').val('');
                            targetForm.find('textarea').val('');
                            errroTarget.html('<p style="color:green;">Mail has been sent successfully.</p>');
                        } else {
                            errroTarget.html('<p style="color:red;">Something went wrong please try again latter.</p>');
                        }
                    });
                }
            });
        },
        /*-----------------------------------------------------
            Copy Right
        -----------------------------------------------------*/
        copy_right: function() {
            document.getElementById("copyYear").innerHTML = new Date().getFullYear();
        },
    };
    Catering.init();
})(jQuery);