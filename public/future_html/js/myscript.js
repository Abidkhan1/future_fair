$(document).ready(function() {


    $('.my_tabs ul li a').on('click', function(event) {
        event.preventDefault();

        $('.tab_active').removeClass('tab_active');
        $(this).addClass('tab_active');
        $('.tab_detail .main_detail').hide();
        $($(this).attr('href')).show();
    });
    $('.tabs-nav a:first').trigger('click');




    $('.menu_btn a').click(function() {
        $('.menu').addClass('menu_open');
    });

    $('.close_menu').click(function() {
        $('.menu').removeClass('menu_open');
    });




    // read more

    $(".read_text").hide();
    $(".read_more").on("click", function() {
        var txt = $(".read_text").is(':visible') ? 'Read More' : 'Read Less';
        $(".read_more").text(txt);
        $(this).prev('.read_text').slideToggle(200);
    });


    // blogs tab

    $('.blog_tabs ul li a').on('click', function(event) {
        event.preventDefault();

        $('.blogs_tab_active').removeClass('blogs_tab_active');
        $(this).addClass('blogs_tab_active');
        $('.blogs_tabDetail .blogTab_main').hide();
        $($(this).attr('href')).show();
    });
    $('.blog_tabs a:first').trigger('click');



    // tabs

    $('.my_tabs ul li a').on('click', function(event) {
        event.preventDefault();

        $('.tab_active').removeClass('tab_active');
        $(this).addClass('tab_active');
        $('.tab_detail .main_detail').hide();
        $($(this).attr('href')).show();
    });
    $('.tabs-nav a:first').trigger('click');


    // slider





    // animation

    wow = new WOW({
        animateClass: 'animated',
        offset: 50,
        callback: function(box) {
            console.log("WOW: animating < " + box.tagName.toLowerCase() + ">")
        }
    });
    wow.init();
    document.getElementById('moar').onclick = function() {
        var section = document.createElement('section');
        section.className = 'section--purple wow fadeInDown';
        this.parentNode.insertBefore(section, this);
    };



});






// sticky header

$(window).scroll(function() {
    if ($(window).scrollTop() >= 100) {

        $('.wrapper').addClass('fixed_header');
    } else {
        $('.wrapper').removeClass('fixed_header');
    }
});



$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        center: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: true,
                loop: false
            }
        }
    })
});