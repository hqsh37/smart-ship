<script>
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

// handle fixed css menu
window.addEventListener('scroll', function() {
    if (window.pageYOffset >= 133) {
        $(".main-header").classList.add("main-header-scroll");
    } else {
        $(".main-header").classList.remove("main-header-scroll");
    }
});

// show notification
tippy('#noti-tippy-hov', {
    content: 'Thông báo',
});

tippy('#noti-tippy', {
    content: $("#noti-body"),
    allowHTML: true,
    interactive: true,
    trigger: 'click', 
    placement: 'bottom',
});

// show accoun information
tippy('#avt-tippy', {
    content: $("#usr-body"),
    allowHTML: true,
    interactive: true,
    trigger: 'click', 
    placement: 'bottom',
});

// xử lý update ql đơn hàng 

</script>