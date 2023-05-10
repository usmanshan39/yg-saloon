var divisor = document.getElementById("divisor"),
handle = document.getElementById("handle"),
slider = document.getElementById("slider");

function moveDivisor() {
handle.style.left = slider.value + "%";
divisor.style.width = slider.value + "%";
}

window.onload = function () {
moveDivisor();
};
$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        padding: 40,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            800: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });
});