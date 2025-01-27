function initMap() {
    const latitude = $("#map").data("latitude");
    const longitude = $("#map").data("longitude");
    const zoomLevel = $("#map").data("zoom");
    const mapCenter = new google.maps.LatLng(latitude, longitude);

    const mapOptions = {
        zoom: zoomLevel,
        center: mapCenter,
        mapTypeControl: false,
        disableDefaultUI: true,
        zoomControl: true,
        scrollwheel: false,
        styles: [
            {
                stylers: [
                    { hue: "#ff1a00" },
                    { invert_lightness: true },
                    { saturation: -100 },
                    { lightness: 33 },
                    { gamma: 0.5 }
                ]
            },
            {
                featureType: "water",
                elementType: "geometry",
                stylers: [{ color: "#2a2b30" }]
            }
        ]
    };

    const map = new google.maps.Map(document.getElementById("map"), mapOptions);

    new google.maps.Marker({
        position: mapCenter,
        map: map,
        title: "We are here!"
    });
}

function contactFormSetup() {
    $(".input-field").each(function () {
        $(this).val() ? $(this).addClass("input--filled") : $(this).removeClass("input--filled");
    });

    $(".input-field").on("keyup", function () {
        $(this).val() ? $(this).addClass("input--filled") : $(this).removeClass("input--filled");
    });

    $("#contact-form").on("submit", function (e) {
        e.preventDefault();

        const name = $("#cf-name").val().trim();
        const email = $("#cf-email").val().trim();
        const message = $("#cf-message").val().trim();
        let errorCount = 0;

        // Validate input fields
        $(".cf-validate", this).each(function () {
            if ($(this).val() === "") {
                $(this).addClass("cf-error");
                errorCount++;
            } else {
                $(this).removeClass("cf-error");
            }
        });

        // If validation passes, send AJAX request
        if (errorCount === 0) {
            $.ajax({
                type: "POST",
                url: contactFormUrl, // Make sure this variable is defined with the correct URL.
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // CSRF token header
                },
                data: {
                    name: name,
                    email: email,
                    message: message
                },
                success: function (response) {
                    $("#contact-form .input-field").val(""); // Clear form fields
                    showAlertBox(200, response.message || "Message sent successfully!"); // Success message
                },
                error: function (xhr) {
                    console.error("Error Response:", xhr);
                    const errorMessage = xhr.responseJSON?.message || "An error occurred. Please try again."; // Handle error
                    showAlertBox(xhr.status, errorMessage);
                }
            });
        } else {
            showAlertBox(400, "Please fill in all fields."); // Display error if validation fails
        }
    });
}

function showAlertBox(status, message) {
    const alertBox = $('<div class="alert"></div>');
    const alertContainer = $("#contact-form .alert-container");

    if (status === 200) {
        alertBox.addClass("alert-success").html(message); // Success style
    } else {
        alertBox.addClass("alert-danger").html(message); // Error style
    }

    alertContainer.html(alertBox).fadeIn(300).delay(2000).fadeOut(400);
}

$(window).on("load", function () {
    $(".loading-text").delay(1000).fadeOut("slow");
    $(".preloader").delay(2000).fadeOut("slow");

    if ($(".portfolio-items").length) {
        const portfolioItems = $(".portfolio-items");
        const portfolioFilters = $(".portfolio-filter ul li");

        portfolioItems.isotope();

        portfolioFilters.on("click", function () {
            portfolioFilters.removeClass("active");
            $(this).addClass("active");

            const filterValue = $(this).data("filter");
            portfolioItems.isotope({ filter: filterValue });
        });
    }
});

$(document).ready(function () {
    "use strict";

    if ($(".text-slideshow").length) animateText();

    $(".pages-stack .page").each(function () {
        const pageSelector = "#" + $(this).attr("id");
        new SimpleBar($(pageSelector)[0], { scrollbarMinSize: 15 });
    });

    $(".portfolio-items .image-link").magnificPopup({ type: "image" });
    $(".portfolio-items .video-link").magnificPopup({ type: "iframe" });

    $(".testimonials .owl-carousel").owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        smartSpeed: 500,
        responsiveClass: true,
        dots: false,
        autoplayHoverPause: true,
        responsive: {
            0: { items: 1 },
            800: { items: 1 },
            992: { items: 2 }
        }
    });

    $(".clients .owl-carousel").owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        smartSpeed: 500,
        responsiveClass: true,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: { items: 2 },
            575: { items: 3 },
            768: { items: 4 },
            1000: { items: 6 }
        }
    });

    if ($("#map").length) initMap(); // Initialize map if present

    $(window).on("hashchange", function () {
        setTimeout(function () {
            if (window.location.hash.slice(2) === "contact" && $("#map").length) {
                initMap();
            }
        }, 500);
    });

    contactFormSetup(); // Initialize contact form
});
