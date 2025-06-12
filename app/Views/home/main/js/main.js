document.querySelectorAll('.planosSwiper').forEach((swiperEl) => {
  const swiperContainer = swiperEl.closest('.swiper-content');

  new Swiper(swiperEl, {
    slidesPerView: "auto",
    spaceBetween: 20,
    centeredSlides: true,
    keyboard: {
      enabled: true,
    },
    navigation: {
      nextEl: swiperContainer.querySelector('.swiper-button-next'),
      prevEl: swiperContainer.querySelector('.swiper-button-prev'),
    },
    pagination: {
      el: swiperContainer.querySelector(".swiper-pagination"),
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      992: {
        slidesPerView: 3,
        centeredSlides: false,
      }
    }
  });
});
