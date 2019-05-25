
 ///Scroll to top  / ////
 $("#scroll-to-top").on("click", function (e) {
     $("body, html").animate({
         scrollTop: 0
     }, 800);
     return false;
 });
 $(document).ready(function () {
     var $scrollToTop, defaultBottom, scrollArea;
     $scrollToTop = $("#scroll-to-top");
     defaultBottom = $scrollToTop.css("bottom");
     scrollArea = function () {
         return $(document).outerHeight() - $("").outerHeight() - $(window).outerHeight();
     };
     if ($('body').hasClass("boxed")) {
         return $(window).scroll(function () {
             if ($(this).scrollTop() > 500) {
                 return $scrollToTop.addClass("in");
             } else {
                 return $scrollToTop.removeClass("in");
             }
         });
     } else {
         return $(window).scroll(function () {
             if ($(this).scrollTop() > 500) {
                 $scrollToTop.addClass("in");
             } else {
                 $scrollToTop.removeClass("in");
             }
             if ($(this).scrollTop() >= scrollArea()) {
                 return $scrollToTop.css({
                     bottom: $(this).scrollTop() - scrollArea() + 10
                 });
             } else {
                 return $scrollToTop.css({
                     bottom: defaultBottom
                 });
             }
         });
     }
 });

  //Scroll to top end /////