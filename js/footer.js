//$('#top').mousemove(function( event ) {
//     var magnitudeForeground = 0.075;
//     var magnitudeBackground = 0.025;
//     var wh = $(window).height();
//     var ww = $(window).width();
//     $('.header-content').css('margin-left',(magnitudeForeground*event.pageX*-1));
//     $('.header-content').css('top',(magnitudeForeground*event.pageY*-0.25)+(55)+"%");
//     $('.header').css('background-position',(magnitudeBackground*event.pageX*-1+50)+"% "+(magnitudeBackground*event.pageY*0.25+50)+"%");
//});

particlesJS.load('particles-js', 'js/particles.json');

// Reloads animations into view
function checkAnimated(scroll) {
    // Hides elements when out of view
    $('.animate').each(function () {
        var offset = $(this).offset().top; // Distance from top to element
        var height = $(this).height(); // Height of element
        var wow = $(window).height(); // Height of window
        if (scroll > offset+height || scroll+wow <= offset) {
            $(this).addClass('animated');
            $(this).removeClass('animate');
        }
    });
    // Animates elements that appear in scroll view
    $('.animated').each(function () {
        var offset = $(this).offset().top;
        var height = $(this).height();
        var wow = $(window).height();
        if (scroll <= offset+(0.8*height) && scroll+wow > offset) {
            $(this).addClass('animate');
            $(this).removeClass('animated');
        }
    });
}
var timeoutId;
$(window).on('scroll',function() {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(function() {
        checkAnimated($(this).scrollTop());
    }, 100 );
});
checkAnimated($(window).scrollTop());
$('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: 200,
    gutter: 20
});
