(function($) {
  "use strict"; // Start of use strict
  // Configure tooltips for collapsed side navigation
  $('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
  })
  // Toggle the side navigation
  $("#sidenavToggler").click(function(e) {
    e.preventDefault();
    $("body").toggleClass("sidenav-toggled");
    $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
    $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
  });
  // Force the toggled class to be removed when a collapsible nav link is clicked
  $(".navbar-sidenav .nav-link-collapse").click(function(e) {
    e.preventDefault();
    $("body").removeClass("sidenav-toggled");
  });
  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
    var e0 = e.originalEvent,
      delta = e0.wheelDelta || -e0.detail;
    this.scrollTop += (delta < 0 ? 1 : -1) * 30;
    e.preventDefault();
  });
  // Scroll to top button appear
  $(document).scroll(function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });
    //   $('[data-toggle="tooltip"]').tooltip("disable");
  // Configure tooltips globally
  $('[data-toggle="tooltip"]').tooltip()
  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });
})(jQuery); // End of use strict


$(document).ready(function(){
  
  $("#divconcepto").change(function(){
    // var precio=$("option:selected").att('id');
    var option = $('option:selected', this).attr('id');
    $('#total').val(option);
    // console.log(options);
    })
})

// alert-success operacion 

window.setTimeout(function() {      
    $(".myAlert-top").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
    // $(".alert.desvanecen").fadeTo(500, 0).slideUp(500, function(){
    //   $(this).remove(); 
    // });
  }, 4000);


  $('#total').number( true, 2 );
  $('.precio').number( true, 2 );
  // $('.precio').number( true, 2 );
  
  /* window.setTimeout(function() {      
    alert('hola');
    $(".alert.desvaneces").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 4000);  
 */


