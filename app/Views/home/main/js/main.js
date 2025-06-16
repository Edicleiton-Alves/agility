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

document.querySelectorAll('#bannerSwipper').forEach((swiperEl) => {
  const swiperContainer = swiperEl.closest('.section');
  const slides = swiperEl.querySelectorAll('.swiper-slide');

  if (slides.length > 1) {
    new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
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
          slidesPerView: 1,
        },
        992: {
          slidesPerView: 1,
        }
      }
    });
  } else {
    const pagination = swiperContainer.querySelector(".swiper-pagination");
    if (pagination) pagination.style.display = 'none';

    const navPrev = swiperContainer.querySelector('.swiper-button-prev');
    const navNext = swiperContainer.querySelector('.swiper-button-next');
    if (navPrev) navPrev.style.display = 'none';
    if (navNext) navNext.style.display = 'none';
  }
});
