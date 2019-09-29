$(window).scroll(function() {
   var scroll = $(window).scrollTop();
   
   if (scroll > 800) {
      $('.button-whats').css("display", "block");
   } else {
      $('.button-whats').css("display", "none");
   }
});