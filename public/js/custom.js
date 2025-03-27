/**
 * Global AJAX Setup
 * Configure CSRF token for all AJAX requests
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * Input Validation
 * Restrict input to numbers only
 */
$('input.onlynumber').on('input', function() {
    this.value = this.value.replace(/\D/g, '');
});

/**
 * Notification Management
 * Auto-hide notifications after 3 seconds
 */
const NOTIFICATION_TIMEOUT = 3000;
const $notification = $("#notificationflush");

setTimeout(() => $notification.fadeOut(1000), NOTIFICATION_TIMEOUT);

function hideflash() {
    $notification.fadeOut(150);
}

/**
 * Form Field Requirements
 * Add required field indicators (*)
 */
$('input[required], textarea[required], select[required]').prev('label')
    .append('<span class="text-red-500">*</span>');

/**
 * URL Slug Generator
 * Convert string to URL-friendly slug
 */
function slugify(string) {
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

/**
 * Document Ready Handler
 * Initialize all components and event listeners
 */
$(document).ready(function() {
    /**
     * Carousel Configuration
     */
    const SLIDE_INTERVAL = 3000;
    let currentSlide = 0;
    const $slides = $('.carousel-slide');
    const $bullets = $('.bullet');
    const totalSlides = $slides.length;
    let autoPlayInterval;

    // Carousel Controls
    function showSlide(index) {
        $slides.removeClass('active').eq(index).addClass('active');
        $bullets.removeClass('active').eq(index).addClass('active');
        currentSlide = index;
    }

    function nextSlide() {
        showSlide((currentSlide + 1) % totalSlides);
    }

    function prevSlide() {
        showSlide((currentSlide - 1 + totalSlides) % totalSlides);
    }

    // Autoplay Controls
    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, SLIDE_INTERVAL);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Event Listeners
    $('.next-btn').click(nextSlide);
    $('.prev-btn').click(prevSlide);
    
    $bullets.click(function() {
        const slideIndex = $(this).data('slide');
        showSlide(slideIndex);
        stopAutoPlay();
        startAutoPlay();
    });

    $('.carousel-container').hover(stopAutoPlay, startAutoPlay);

    // Initialize autoplay
    startAutoPlay();

    /**
     * Mobile Navigation
     */
    const mobileDropdowns = {
        'mobile-dropdown-button': 'mobile-dropdown-menu',
        'mobile-member-dropdown-button': 'mobile-member-dropdown-menu',
        'mobile-agent-dropdown-button': 'mobile-agent-dropdown-menu'
    };

    // Mobile Menu Toggle
    $('#mobile-menu-button').click(() => $('#mobile-menu').toggleClass('hidden'));

    // Mobile Dropdown Handlers
    $.each(mobileDropdowns, function(buttonClass, menuClass) {
        $(`.${buttonClass}`).click(function() {
            const $menu = $(this).next(`.${menuClass}`);
            const $arrow = $(this).find('svg');
            
            $menu.toggleClass('hidden');
            $arrow.toggleClass('rotate-180');
        });
    });

    /**
     * Desktop Navigation
     */
    // Desktop Dropdown Handlers
    const dropdownMap = {
        'desktop-dropdown-button': 'desktop-dropdown',
        'desktop-member-dropdown-button': 'desktop-member-dropdown',
        'agent-dropdown-button': 'agent-dropdown'
    };

    // Initialize dropdown buttons
    $.each(dropdownMap, function(buttonClass, targetName) {
        $(`.${buttonClass}`).attr('data-target', targetName);
    });

    // Handle dropdown clicks
    $('.desktop-dropdown-button, .desktop-member-dropdown-button, .agent-dropdown-button')
        .click(function(e) {
            e.stopPropagation();
            const $button = $(this);
            const $arrow = $button.find('svg');
            const menuClass = `.${$button.data('target')}-menu`;
            
            // Close other dropdowns
            $('.desktop-dropdown-menu, .desktop-member-dropdown-menu, .agent-dropdown-menu')
                .not(menuClass)
                .addClass('hidden');
            $('svg.rotate-180').not($arrow).removeClass('rotate-180');
            
            // Toggle current dropdown
            $(menuClass).toggleClass('hidden');
            $arrow.toggleClass('rotate-180');
        });

    // Global click handler to close dropdowns
    $(document).click(() => {
        $('.desktop-dropdown-menu, .desktop-member-dropdown-menu, .agent-dropdown-menu')
            .addClass('hidden');
        $('svg.rotate-180').removeClass('rotate-180');
    });

    // Prevent dropdown close when clicking inside
    $('.desktop-dropdown-menu, .desktop-member-dropdown-menu, .agent-dropdown-menu')
        .click(e => e.stopPropagation());

    /**
     * Marquee Animation
     */
    const $marquee = $('#marquee');
    const marqueeContent = $marquee.html();
    const MARQUEE_DURATION = 15000; // 15 seconds

    // Initialize marquee
    $marquee.html(marqueeContent + marqueeContent);

    function animateMarquee() {
        const firstWidth = $marquee.find('span').first().outerWidth();
        $marquee.animate(
            { marginLeft: -firstWidth }, 
            MARQUEE_DURATION, 
            'linear',
            function() {
                $(this).css('margin-left', 0);
                animateMarquee();
            }
        );
    }

    // Start marquee animation
    animateMarquee();
});
