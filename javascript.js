
 

window.onscroll = () =>{
  searchForm.classList.remove('active');
  if(window.scrollY > 80)
  {
      document.querySelector('.header .header-2').classList.add('active');
  }
  else
  {
      document.querySelector('.header .header-2').classList.remove('active');
  }
}

window.onload = () =>{
  if(window.scrollY > 80)
  {
      document.querySelector('.header .header-2').classList.add('active');
  }
  else
  {
      document.querySelector('.header .header-2').classList.remove('active');
  }
fadeOut();
}


//   reviews slider swiper
var swiper = new Swiper(".reviews-slider", {
    spaceBetween: 10,
    grabCursor: true,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:7000,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

//   blogs swiper section
  var swiper = new Swiper(".blogs-slider", {
    spaceBetween: 10,
    grabCursor: true,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:7000,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });