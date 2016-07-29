$.ajaxSetup({
    cache: false
});

// Set-up

$(document).ready(function () {
// Global variables
    touchScreen = false;
    deviceWidth = 0;
    deviceHeight = 0;
    mobileSubNavActive = false;
// Detect mobile
    if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i))) {
        deviceWidth = $(window).width();
        deviceHeight = $(window).height();
        touchScreen = true;
    }
// Mouse events
// Set-up
    $(window).resize(function () {
        calcReplacement();
        toggleResponsiveItems();
    });
    calcReplacement();
    toggleResponsiveItems();
// Mobile set-up
    if (touchScreen) {

    }
});

function deactivateLink(i) {
    $(i).bind('click.deactivateLink', function (event) {
            event.preventDefault();
        })
        .css({cursor: 'default'});
}

function activateLink(i) {
    $(i).unbind('.deactivateLink')
        .css({cursor: 'pointer'});
}

/* Calc replacement */

function calcReplacement() {
    if (!Modernizr.csscalc) {

    }
}

/* Template */

function toggleResponsiveItems() {
    if ($(window).width() < 768) {

    } else {

    }
    if ($(window).width() < 960) {
        if ($(window).height() < 562) {
            var i = 40;
        } else {
            i = Math.floor(($(window).height() - 482) / 2);
        }
        $('#contact-wrapper').css({
            position: 'static',
            width: '320px',
            marginLeft: '0',
            marginTop: '0',
            paddingTop: i + 'px',
            paddingBottom: i + 'px',
            margin: 'auto',
            height: '482px'
        });
        $('.contact-column').css({
            width: '320px',
            borderRight: 'none',
            borderBottom: '1px solid #FFF',
            height: '160px',
            float: 'none'
        });
        $('#contact-column-3').css({borderBottom: 'none'});
        $('.contact-column-text h4, .contact-column-text p').css({padding: '25px'});
        $('.contact-column-text h4').css({paddingBottom: '0'});
        $('#contact-container').css({
            overflow: 'auto',
            minHeight: '280px',
            '-webkit-overflow-scrolling': 'touch',
            overflowX: 'hidden'
        });
        $('#careers-menu-wrapper').css({width: '100%'});
        $('#contact-more-map-wrapper').hide();
        $('#career-wrapper').css({width: '100%', marginLeft: '100%'});
        $('#contact-more-text-container').css({width: '100%', marginLeft: '0'});
        $('#career-wrapper p, #contact-more-text-container p').css({padding: '25px'});
        $('a#header-contact span, span#menu-text').hide();
        $('a#header-contact img').show();
        $('a#header-contact, a#header-menu').css({top: '15px'});
        $('span#menu-icon').css({display: 'inline-block'});
        $('#nav-wrapper span').css({display: 'block', width: '0', height: '0'});
        $('#nav-wrapper a').css({padding: '25px', textAlign: 'center', width: '270px'});
        $('a#nav-showcase, a#nav-about').css({borderBottom: '1px solid #FFF'});
    } else {
        $('#contact-wrapper').css({
            width: '',
            margin: '',
            marginLeft: '',
            height: '',
            marginTop: '',
            height: '',
            position: '',
            paddingTop: '',
            paddingBottom: ''
        });
        $('.contact-column').css({
            width: (($('#contact-wrapper').width() / 3) - 1) + 'px',
            borderRight: '',
            borderBottom: 'none',
            height: '',
            float: ''
        });
        $('.contact-column-text h4, .contact-column-text p').css({padding: ''});
        $('.contact-column-text h4').css({paddingBottom: ''});
        $('#contact-container').css({overflow: '', minHeight: '', '-webkit-overflow-scrolling': '', overflowX: ''});
        $('#careers-menu-wrapper').css({width: ''});
        $('#contact-more-map-wrapper').show();
        $('#career-wrapper, #contact-more-text-container').css({width: '', marginLeft: ''});
        $('#career-wrapper p, #contact-more-text-container p').css({padding: ''});
        $('a#header-contact span, span#menu-text').show();
        $('a#header-contact img').hide();
        $('a#header-contact, a#header-menu').css({top: ''});
        $('span#menu-icon').css({display: ''});
        $('#nav-wrapper span').css({display: '', width: '', height: ''});
        $('#nav-wrapper a').css({padding: '', textAlign: '', width: ''});
        $('a#nav-showcase, a#nav-about').css({borderBottom: ''});
    }
    closeCareers();
    closeContactMore();
}

function headerLogoClick() {
    if ($('nav').is(':visible') == true) {
        closeNav();
    } else {
        window.location = '/';
    }
}

/* Nav */

function openNav() {
    if ($('nav').is(':visible') == true) {
        closeNav();
    } else {
        $('nav').css({display: 'table'})
            .addClass('animate-fade-in-1');
        $('header').css({backgroundColor: 'transparent'});
        $('a#header-logo img').attr({src: '/Theme/HDesign/Home/Public/img/index/logo_header_white.png'});
        $('a#header-menu, a#header-contact').css({color: '#FFF'});
        $('span#menu-icon').css({borderColor: '#FFF'});
        $('span#menu-icon span').css({backgroundColor: '#FFF'});
        calcReplacement();
        toggleResponsiveItems();
    }
}

function closeNav() {
    $('nav').css({display: ''})
        .removeClass('animate-fade-in-1');
    $('header').css({backgroundColor: ''});
    $('a#header-logo img').attr({src: '/Theme/HDesign/Home/Public/img/index/logo_header.png'});
    $('a#header-menu, a#header-contact').css({color: ''});
    $('span#menu-icon').css({borderColor: ''});
    $('span#menu-icon span').css({backgroundColor: ''});
}

/* Contact */

function openContact() {
    $('#contact-container').show()
        .addClass('animate-fade-in-1');
    calcReplacement();
    toggleResponsiveItems();
}

function closeContact() {
    $('#contact-container').hide()
        .removeClass('animate-fade-in-1');
}

function loadCareers() {
    $('#contact-container').scrollTop(0);
    $('#careers-container').css({zIndex: '2'});
    if ($(window).width() < 960) {
        $('#careers-container').stop()
            .velocity({right: '0'}, 500);
    } else {
        $('#careers-container').stop()
            .velocity({right: '-50%'}, 500);
    }
}

function loadCareer(i) {
    $('#career-wrapper').scrollTop(0);
    if ($(window).width() < 960) {
        $('#careers-container').stop()
            .velocity({right: '100%'}, 500);
    } else {
        $('#careers-container').stop()
            .velocity({right: '0'}, 500);
    }
    $('#career-wrapper p').hide();
    $('a#careers-close, p#career-' + i).show();
}

function closeCareers() {
    $('#careers-container').css({zIndex: '', right: '-100%'});
    $('a#careers-close').hide();
}

function loadContactMore(i) {
    $('#contact-container').scrollTop(0);
    $('#contact-more-container').stop()
        .velocity({right: '0'}, 500)
        .css({zIndex: '2'});
    $('#contact-more-text-container p').hide();
    if (i == 'nyc') {
        if ($(window).width() >= 960) {
            $('#contact-more-map-wrapper iframe').attr({src: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.71359478399!2d-73.998409!3d40.72432099999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2598c194b1da1%3A0x17eb4d015373e4f5!2sYabu+Pushelberg!5e0!3m2!1sen!2sus!4v1401384559189'});
        }
        $('#contact-more-text-container p#contact-more-46').show();
    } else {
        if ($(window).width() >= 960) {
            $('#contact-more-map-wrapper iframe').attr({src: 'http://gaode.com/search?query=%E5%85%B1%E5%92%8C%E6%96%B0%E8%B7%AF4965%E5%8F%B7%E4%B8%87%E8%BE%BE%E5%B9%BF%E5%9C%BA4%E5%8F%B7%E6%A5%BC1010%E5%AE%A4&city=310000&geoobj=120.154285%7C30.664018%7C122.791003%7C31.796003'});
        }
        $('#contact-more-text-container p#contact-more-47').show();
    }
    $('a#contact-more-close').show();
}

function closeContactMore() {
    $('#contact-more-container').css({zIndex: '', right: '-100%'});
    $('a#contact-more-close').hide();
}

var wx_i=1;
$('#icon-wx').click(function () {
    if(wx_i){
        $("#wx").css('display','block');
        wx_i=0;
    }else {
        $("#wx").css('display','none');
        wx_i=1;
    }
});

