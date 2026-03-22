// Mobile menu
const toggleMenu = () => {
  const menus = document.querySelector(".menu");
  menus.classList.toggle("open-menus");
};
jQuery(document).ready(function($) {
  if (window.matchMedia("(max-width: 767px)").matches) {
    $(".dropdownButton").on("click", function (event) {
      var $dropdownMenu = $(this).siblings(".dropdownMenu");
      var $dropdown = $(this).parent(".dropdown");
    
      // Toggle active state
      var isActive = $(this).hasClass("active");
    
      // Close all dropdowns and remove active classes
      $(".dropdownMenu").hide().removeClass("active");
      $(".dropdownButton").removeClass("active");
      $(".dropdown").removeClass("active");
    
      if (!isActive) {
        $dropdownMenu.show().addClass("active");
        $(this).addClass("active");
        $dropdown.addClass("active");
      }
    
      event.stopPropagation();
    });
    
    $(document).on("click", function () {
      $(".dropdownMenu").hide().removeClass("active");
      $(".dropdownButton").removeClass("active");
      $(".dropdown").removeClass("active");
    });
    
    $(".dropdownMenu").on("click", function (event) {
      event.stopPropagation();
    });    
  }
});

jQuery(document).ready(function($) {
  let designation = '<?php the_title(); ?>';
  let designation_id = '<?= get_the_ID(); ?>';
  $('#designation').val(designation);
  $('#designation_id').val(designation_id);

  $('#menu-item-280.menu-item-has-children').on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $(this).siblings('.menu-item-has-children').removeClass('active');
    
    $(this).find('.sub-menu').on('click', function(e) {
        e.stopPropagation();
    });
});

});

document.addEventListener('DOMContentLoaded', function() {
  const fileInput = document.querySelector('input[name="file-829"]');
  const fileNameDisplay = document.querySelector('.file-name');
  const errorMessage = document.querySelector('.error-message');

  if (fileInput) {
      fileInput.addEventListener('change', function(event) {
          const file = event.target.files[0];
          
          errorMessage.textContent = '';

          if (file) {
              const fileSizeLimit = 2 * 1024 * 1024;
              if (file.size > fileSizeLimit) {
                  errorMessage.textContent = 'File size exceeds 2MB limit.';
                  fileInput.value = '';
                  fileNameDisplay.textContent = 'No file selected';
              } else {
                  fileNameDisplay.textContent = file.name;
              }
          } else {
              fileNameDisplay.textContent = 'No file selected';
          }
      });
  }
});

document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".service-box", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,

        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
});
