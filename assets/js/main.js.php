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

// main.php

document.addEventListener("DOMContentLoaded", function() {
  const blocks = document.querySelectorAll('.block');
  let currentIndex = 0;

  function showBlock(index) {
    blocks.forEach((block, i) => {
      if (i === index) {
        block.style.display = 'flex';
        block.style.transform = 'translateX(0)';
      } else {
        block.style.transform = 'translateX(-100%)';
        setTimeout(() => {
          block.style.display = 'none';
        }, 500); // Wait for the transition to complete before hiding
      }
    });
  }

  function nextBlock() {
    currentIndex = (currentIndex + 1) % blocks.length;
    showBlock(currentIndex);
  }

  setInterval(nextBlock, 3000);
  showBlock(currentIndex);
});

// slider
let slideIndex = 0; // Start with the first card
showSlides();

function showSlides() {
    let slides = document.querySelectorAll('.c input[type="radio"]');
    slideIndex++;
    if (slideIndex >= slides.length) {
        slideIndex = 0; // Reset index to loop back to the first card
    }
    slides[slideIndex].checked = true; // Check the next radio button
    setTimeout(showSlides, 5000); // Change slide every 5 seconds
}

</script>