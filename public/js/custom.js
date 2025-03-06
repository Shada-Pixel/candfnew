
// Ajax csrf token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Only number in text
$('input.onlynumber').keyup(function(e){
    if (/\D/g.test(this.value)){
      this.value = this.value.replace(/\D/g, '');
    }
});


// success notification
setTimeout(function () { $("#notificationflush").fadeOut(1000) }, 3000);

function hideflash() {
    setTimeout(function () { $("#notificationflush").fadeOut(150) });
}

$('input[required], textarea[required], select[required]').each(function () {
    $(this).prev('label').append('<span class="text-red-500">*</span>');
});



// This function is to make product slug
function slugify(string){
    return string
        .toString()
        .trim()
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-")
        .replace(/^-+/, "")
        .replace(/-+$/, "");
}

const toggleButton = document.querySelector('#menu-button');
const menu = document.querySelector('#menu');


// toggleButton.addEventListener('click', () => {
//   menu.classList.toggle('hidden');
// });


$(document).ready(function() {
    let currentSlide = 0;
    const slides = $('.carousel-slide');
    const bullets = $('.bullet');
    const totalSlides = slides.length;
    let autoPlayInterval;

    // Function to show slide
    function showSlide(index) {
        slides.removeClass('active');
        bullets.removeClass('active');
        
        slides.eq(index).addClass('active');
        bullets.eq(index).addClass('active');
        currentSlide = index;
    }

    // Next slide
    function nextSlide() {
        let next = (currentSlide + 1) % totalSlides;
        showSlide(next);
    }

    // Previous slide
    function prevSlide() {
        let prev = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(prev);
    }

    // Autoplay
    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, 3000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Navigation buttons
    $('.next-btn').click(nextSlide);
    $('.prev-btn').click(prevSlide);

    // Bullet navigation
    bullets.click(function() {
        let slideIndex = $(this).data('slide');
        showSlide(slideIndex);
        stopAutoPlay();
        startAutoPlay();
    });

    // Hover controls
    $('.carousel-container').hover(
        function() { stopAutoPlay(); },
        function() { startAutoPlay(); }
    );

    // Start autoplay
    startAutoPlay();


    // -------------------------------------------------

    // Toggle mobile menu
    $('#mobile-menu-button').click(function () {
        $('#mobile-menu').toggleClass('hidden');
    });

    // Toggle mobile dropdown
    $('#mobile-dropdown-button').click(function (e) {
        e.stopPropagation(); // Prevent the click from closing the dropdown immediately
        $('#mobile-dropdown-menu').toggleClass('hidden');
    });

    // Toggle desktop dropdown
    $('#desktop-dropdown-button').click(function (e) {
        e.stopPropagation(); // Prevent the click from closing the dropdown immediately
        $('#desktop-dropdown-menu').toggleClass('hidden');
    });

    // Close dropdowns when clicking outside
    $(document).click(function () {
        $('#desktop-dropdown-menu').addClass('hidden');
        $('#mobile-dropdown-menu').addClass('hidden');
    });

    // Prevent dropdowns from closing when clicking inside
    $('#desktop-dropdown-menu, #mobile-dropdown-menu').click(function (e) {
        e.stopPropagation();
    });

    // Marquee animation
    const marquee = $('#marquee');
    const marqueeContent = marquee.html(); // Get the content

    // Duplicate the content to create a seamless loop
    marquee.html(marqueeContent + marqueeContent);

    // Animate the marquee
    function animateMarquee() {
        const firstWidth = marquee.find('span').first().outerWidth(); // Width of the first span
        marquee.animate({ marginLeft: -firstWidth }, 15000, 'linear', function () { // 15 seconds
            marquee.css('margin-left', 0); // Reset margin
            animateMarquee(); // Restart the animation
        });
    }

    animateMarquee(); // Start the animatio
});
