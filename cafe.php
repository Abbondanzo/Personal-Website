<div class="item-content">
    <div class="item-view container animate fade-in-up">
        <h1>Bonne Vie Café</h1>
        <p>Bonne Vie Café began as a mockup design made for a college student. He had very little requirements, other than to satisfy a number of sections. When he came to me, I knew just how to build the perfect site.</p>
        <p>I started by designing a wireframe and various slides in Adobe Photoshop and InDesign. The customer instantly fell in love and we went from there. I built the site from scratch using various amounts of PHP and Javascript to handle contact/review forms and table reservations. Everything else was made using HTML and CSS.</p>
        <p>Users can book a reservation in just a few clicks. I utilized Zapla's table management API to allow potential restaurant-goers to see what number of tables are available.</p>
        <a target="_blank" href="http://cafe.abbondanzo.com/"><button class="btn">View Mockup</button></a>
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
