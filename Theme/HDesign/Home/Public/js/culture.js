$(document).ready(function() {
// Global variables
postCount = 0;
blogWidth = 0;
postImage = 0;
postImageCount = 0;
postImageWidth = 0;
postImageHeight = 0;
// Mouse events
$(document).keydown(function(e) {
// alert(e.keyCode)
if (e.keyCode == 39) {
scrollBlog();
if ($('#post-container').length == 1 && postImageCount > 1) {
nextPostImage();
}
} else if (e.keyCode == 37) {
if ($('#post-container').length == 1 && postImageCount > 1) {
prevPostImage();
}
}
});
// Set-up
$(window).resize(function() {
calcReplacementCulture();
toggleResponsiveItemsCulture();
});
calcReplacementCulture();
toggleResponsiveItemsCulture();
$('#sub-nav').stop()
.velocity({marginTop: '0'}, 500);
// Mobile set-up
if (touchScreen) {
if ($('#post-container').length == 1) {
$('#post-cover-container').swipe({swipeLeft:function(event, direction, distance, duration, fingerCount) {
nextPostImage();
}, threshold: 50, excludedElements: '.noSwipe'
});
$(window).swipe({swipeRight:function(event, direction, distance, duration, fingerCount) {
prevPostImage();
}, threshold: 50, excludedElements: '.noSwipe'
});
}
}
});

function calcReplacementCulture() {
if (! Modernizr.csscalc) {
$('#blog').css({height: '100%'}).css({height: '-=43px'});
}
}

function toggleResponsiveItemsCulture() {
if ($(window).width() < 960) {

} else {

}
$('#blog a img').css({height: Math.floor($(window).height() - 183) + 'px'});
var ii = 0;
$('#blog a').each(function(i) {
if ($(this).is(':visible') == true) {
$('.post-title', this).css({width: $('img', this).width() + 'px'});
ii = ii + $(this).width() + 2;
}
});
setBlogWidth(ii);
resizePostImage();
}

function loadPost(i) {
var j = $('#post-' + i + ' img').attr('alt');
$('#post-' + i + ' img').attr({src: j})
.imagesLoaded(function() {
$(this).unbind('load')
.css({height: Math.floor($(window).height() - 183) + 'px'});
$('#post-' + i).show();
$('#post-' + i + ' .post-title').css({width: $(this).width() + 'px'});
var ii = blogWidth + $(this).width() + 2;
setBlogWidth(ii);
if (i == 1) {
$('a#blog-arrow').stop()
.velocity({right: '0'}, 500);
}
setTimeout(function() {
$('#post-' + i).addClass('animate-fade-in-1')
.css({opacity: 1});
if (i < postCount) {
var k = i + 1;
loadPost(k);
}
}, 100);
});
}

function setBlogWidth(i) {
$('#blog').css({width: i + 'px'});
blogWidth = i;
}

function scrollBlog() {
var i = $('#blog-container').width();
var j = $('#blog-container').scrollLeft();
i = i + j;
$('#blog-container').stop()
.animate({scrollLeft: i}, 1000);
}

function loadPostPage() {
$('#post-container').show()
.addClass('animate-fade-in-1');
loadPostImage(1);
}

function loadPostImage(i) {
var j = window['image' + i + 'File'];
$('#post-cover-container img#post-cover').hide()
.attr({src: 'content/img/' + j})
.imagesLoaded(function() {
if ($('#post-cover-container').is(':visible') == false) {
$('#post-cover-container').show();
setTimeout(function() {
$('#post-container p').show()
.addClass('animate-fade-in-1');
}, 500);
}
$(this).unbind('load')
.show()
.addClass('animate-fade-in-1');
$('#post-cover-container h5').empty()
.append(window['image' + i + 'Description']);
postImageWidth = window['image' + i + 'FileWidth'];
postImageHeight = window['image' + i + 'FileHeight'];
resizePostImage();
});
postImage = i;
}

function resizePostImage() {
$('#post-cover-container').css({height: ($(window).height() / 2) + 'px'});
$('#post-container p').css({marginTop: (($(window).height() / 2) + ($('#post-cover-container h5').height() + 30)) + 'px'});
if (postImageWidth) {
$('#post-cover-container img#post-cover').css({top: '', left: '', width: '', height: ''});
var k = $('#post-cover-container').height() / postImageHeight * 100;
var l = postImageWidth / 100 * k; 
if (l > $('#post-cover-container').width()) {
$('#post-cover-container img#post-cover').css({width: $('#post-cover-container').width() + 'px', height: ''});
var m = $('#post-cover-container img#post-cover').width() / postImageWidth * 100;
m = postImageHeight / 100 * m; 
$('#post-cover-container img#post-cover').css({top: Math.floor(($('#post-cover-container').height() - m) / 2) + 'px', left: '0'});
} else {
$('#post-cover-container img#post-cover').css({height: $('#post-cover-container').height() + 'px', width: ''});
m = $('#post-cover-container img#post-cover').height() / postImageHeight * 100;
m = postImageWidth / 100 * m; 
$('#post-cover-container img#post-cover').css({left: Math.floor(($('#post-cover-container').width() - m) / 2) + 'px', top: '0'});
}
}
}

function prevPostImage() {
if (postImage == 1) {
var i = postImageCount;
} else {
i = postImage - 1;
}
loadPostImage(i);
}

function nextPostImage() {
if (postImage == postImageCount) {
var i = 1;
} else {
i = postImage + 1;
}
loadPostImage(i);
}