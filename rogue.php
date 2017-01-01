<div class="item-content">
    <div class="item-view container animate fade-in-up">
        <h1>Rogue</h1>
        <p>Rogue was designed as a simple one-page demo of a client-side application for the famous Counter Strike: Global Offensive game. The client wanted an effective means of showcasing the power of their application, so a full-page live video runs above the fold for every user that reaches the site.</p>
        <p>Each user that came across the page could view the primary features of the application and request a license with a simple one-click checkout. The footer kept track of the hundreds of users who had installed the application, and allowed new buyers to email their questions to the client.</p>
        <a target="_blank" href="http://demo.abbondanzo.com/rogue/"><button class="btn">View Demo</button></a>
        <i class="fa fa-times contact-close" aria-hidden="true"></i>
    </div>
</div>
<script>
function closeAll() {
    // Reset form container
    $('.contact-form').empty();
    // Allow scrolling on main page
    $('body').css('overflow','auto');
    // Reveal mobile menu close button
    $('.close-menu').css('display','block');
}
$(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode 27
        closeAll();
    }
});
$('.contact-close').one('click',function() {
    closeAll();
});
$(document).one('click',function() {
    if(!$(event.target).closest('.item-view').length) {
        closeAll();
    }
});
</script>
