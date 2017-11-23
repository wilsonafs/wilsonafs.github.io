$(window).scroll(function() {
   var scroll = $(window).scrollTop();
   
   if (scroll > 800) {
      $('.button-orcamento').css("display", "block");
   } else {
      $('.button-orcamento').css("display", "none");
   }
});