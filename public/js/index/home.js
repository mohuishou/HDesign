$(document).ready(function () {
// Global variables
    homeImageCount = 0;
    homeImageNumber = 1;
    homeImageWidth = 0;
    homeImageHeight = 0;
    homeImageWidthLoader = 0;
    homeImageHeightLoader = 0;
// Mouse events
    $('#home-bgs-container').click(function () {
        var i = window['homeImage' + homeImageNumber + 'Link'];
        if (i != '') {
            window.location = i;
        }
    });
// Set-up
    $(window).resize(function () {
        calcReplacementHome();
        toggleResponsiveItemsHome();
    });
    calcReplacementHome();
    toggleResponsiveItemsHome();
    $('#home-cover img').imagesLoaded(function () {
        $(this).unbind('load')
            .show()
            .addClass('animate-fade-in-2');
        startHomeBg();
    });
// Mobile set-up
    if (touchScreen) {

    }
});

function calcReplacementHome() {
    if (!Modernizr.csscalc) {

    }
}

function toggleResponsiveItemsHome() {
    if ($(window).width() < 768) {

    } else {

    }
    if ($('#home-bg-container-static img').attr('src') != '') {
        resizeHomeImages();
    }
    if ($('#home-bg-container-animated img').attr('src') != '') {
        resizeHomeImagesLoader();
    }
    if (homeImageCount != 1 && $('#home-bgs-timers').is(':visible') == true) {
        if (homeImageCount == 5) {
            var i = Math.floor(($(window).width() / 5) - 1);
        } else if (homeImageCount == 4) {
            i = Math.floor(($(window).width() / 3) - 1);
        } else if (homeImageCount == 3) {
            i = Math.floor(($(window).width() / 3) - 1);
        } else {
            i = Math.floor(($(window).width() / 2) - 1);
        }
        $('.home-bg-timer').css({width: i + 'px'});
    }
}

function startHomeBg() {
    $('#home-bg-container-static h3').append(homeImage1Title);
    $('#home-bg-container-static img').attr({src: homeImage1File})
        .imagesLoaded(function () {
            $(this).unbind('load');
            homeImageWidth = homeImage1FileWidth;
            homeImageHeight = homeImage1FileHeight;
            resizeHomeImages();
            setTimeout(function () {
                if (homeImageCount != 1) {
                    $('#home-bgs-timers').show();
                    if (homeImageCount == 5) {
                        var i = Math.floor(($(window).width() / 5) - 1);
                    } else if (homeImageCount == 4) {
                        i = Math.floor(($(window).width() / 3) - 1);
                    } else if (homeImageCount == 3) {
                        i = Math.floor(($(window).width() / 3) - 1);
                    } else {
                        i = Math.floor(($(window).width() / 2) - 1);
                    }
                    $('.home-bg-timer').css({width: i + 'px'});
                }
                $('#home-cover').addClass('animate-fade-out-1');
                setTimeout(function () {
                    $('#home-cover').hide();
                    if (homeImageCount != 1) {
                        goToHomeBg(2);
                    }
                }, 1000);
            }, 1000);
        });
}

function goToHomeBg(i) {
    if (i == 1) {
        var ii = homeImageCount;
    } else {
        ii = i - 1;
    }
    $('#home-bg-container-animated h3').append(window['homeImage' + i + 'Title']);
    var j = window['homeImage' + i + 'File'];
    $('#home-bg-container-animated img').attr({src: j})
        .imagesLoaded(function () {
            $(this).unbind('load');
            homeImageWidthLoader = window['homeImage' + i + 'FileWidth'];
            homeImageHeightLoader = window['homeImage' + i + 'FileHeight'];
            resizeHomeImagesLoader();
            $('#home-bg-timer-' + ii + ' .home-bg-timer-wrapper').stop()
                .velocity({width: '100%'}, 5000, function () {
                    $('#home-bg-container-animated').stop()
                        .velocity({left: '0'}, 1000, function () {
                            $('#home-bg-container-static h3').empty()
                                .append(window['homeImage' + i + 'Title']);
                            $('#home-bg-container-static img').attr({src:j});
                            homeImageWidth = homeImageWidthLoader;
                            homeImageHeight = homeImageHeightLoader;
                            resizeHomeImages();
                            $('#home-bg-container-animated').css({left: '100%'});
                            $('#home-bg-container-animated img').attr({src: ''});
                            $('#home-bg-container-animated h3').empty();
                            if (i == homeImageCount) {
                                goToHomeBg(1);
                            } else {
                                var k = i + 1;
                                goToHomeBg(k);
                            }
                        });
                    if (i == 1) {
                        $('.home-bg-timer .home-bg-timer-wrapper').css({width: '0'});
                    }
                    homeImageNumber = i;
                }); // Slideshow timer
        });
}

function resizeHomeImages() {
    var i = homeImageWidth;
    var j = homeImageHeight;
    if ($(window).height() > $('#home-bg-container-static img').height() || $(window).width() < $('#home-bg-container-static img').width()) {
        $('#home-bg-container-static img').height($(window).height());
        var k = $('#home-bg-container-static img').height() / j * 100;
        k = i / 100 * k;
        $('#home-bg-container-static img').width(k);
    }
    if ($(window).width() > $('#home-bg-container-static img').width() || $(window).height() < $('#home-bg-container-static img').height()) {
        $('#home-bg-container-static img').width($(window).width());
        k = $('#home-bg-container-static img').width() / i * 100;
        k = j / 100 * k;
        $('#home-bg-container-static img').height(k);
    }
    var l = $(window).width() - $('#home-bg-container-static img').width();
    l = Math.round(l / 2);
    k = $(window).height() - $('#home-bg-container-static img').height();
    k = Math.round(k / 2);
    $('#home-bg-container-static img').css({top: k + 'px', left: l + 'px'});
}

function resizeHomeImagesLoader() {
    var i = homeImageWidthLoader;
    var j = homeImageHeightLoader;
    if ($(window).height() > $('#home-bg-container-animated img').height() || $(window).width() < $('#home-bg-container-animated img').width()) {
        $('#home-bg-container-animated img').height($(window).height());
        var k = $('#home-bg-container-animated img').height() / j * 100;
        k = i / 100 * k;
        $('#home-bg-container-animated img').width(k);
    }
    if ($(window).width() > $('#home-bg-container-animated img').width() || $(window).height() < $('#home-bg-container-animated img').height()) {
        $('#home-bg-container-animated img').width($(window).width());
        k = $('#home-bg-container-animated img').width() / i * 100;
        k = j / 100 * k;
        $('#home-bg-container-animated img').height(k);
    }
    var l = $(window).width() - $('#home-bg-container-animated img').width();
    l = Math.round(l / 2);
    k = $(window).height() - $('#home-bg-container-animated img').height();
    k = Math.round(k / 2);
    $('#home-bg-container-animated img').css({top: k + 'px', left: l + 'px'});
}