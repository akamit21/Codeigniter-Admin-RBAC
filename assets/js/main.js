

// script for shrink property

  $(document).on("scroll", function(){
        if
        ($(document).scrollTop() > 80){
          $(".nav-shrink").addClass("shrink");
          //updateSliderMargin();
        }
        else
        {
          $(".nav-shrink").removeClass("shrink");
          //updateSliderMargin();
        }
      });
  
// script for shrink property ends

// animated dropdown

$('body').on('mouseenter mouseleave','.dropdown-hover',function(e){
     let dropdown=$(e.target).closest('.dropdown-hover');
      dropdown.addClass('show');
      
    setTimeout(function(){
          dropdown[dropdown.is(':hover')?'addClass':'removeClass']('show');
      },300);
  });

// animated dropdown ends

// js for plant-attraction

  jQuery(function ($) {
    var slider = $('.mis-stage').miSlider({
      //  The height of the stage in px. Options: false or positive integer. false = height is calculated using maximum slide heights. Default: false
      stageHeight: 380,
      //  Number of slides visible at one time. Options: false or positive integer. false = Fit as many as possible.  Default: 1
      slidesOnStage: false,
      //  The location of the current slide on the stage. Options: 'left', 'right', 'center'. Defualt: 'left'
      slidePosition: 'center',
      //  The slide to start on. Options: 'beg', 'mid', 'end' or slide number starting at 1 - '1','2','3', etc. Defualt: 'beg'
      slideStart: 'mid',
      //  The relative percentage scaling factor of the current slide - other slides are scaled down. Options: positive number 100 or higher. 100 = No scaling. Defualt: 100
      slideScaling: 150,
      //  The vertical offset of the slide center as a percentage of slide height. Options:  positive or negative number. Neg value = up. Pos value = down. 0 = No offset. Default: 0
      offsetV: -5,
      //  Center slide contents vertically - Boolean. Default: false
      centerV: true,
      //  Opacity of the prev and next button navigation when not transitioning. Options: Number between 0 and 1. 0 (transparent) - 1 (opaque). Default: .5
      navButtonsOpacity: 1
    });
  });

// js for plant-attraction ends


// js for index-attraction


var gallery = (function(){
  
  'use strict';
  
  // vars
  var gal_item = $('.gallery_item'),
      gal_img = $('.gallery_item_preview a img'),
      gal_full = $('.gallery_item_full'),
      gal_box = $('.box'),
      gal_top =  $('.gallery_top');
  
  
  return {
    // this.js(obj)
    js: function(e){return $("[data-js="+e+"]");},
    // this.lk(obj)
    lk: function(e){return $("[data-lk="+e+"]");},
    // Ready functions
    ready_: function(){this.events();},
    //  functions
    events:function(){
      var self = this;
      // add close link
      gal_full.append('<a href="#" data-js="cl" class="cl">X</a>');
      // Get all data js and add clickOn function
      var k = $('a[data-js]');
      k.each(function(i, v){
        i = i+1;
        self.clickOn(i);
      });
      // close on click
      self.js('cl').on("click",function(e){
        e.preventDefault();
        self.fx_out(gal_full);
        self.fx_out(gal_box);
      });

      // list style
      self.js('list').on("click",function(e){
        e.preventDefault();
        // toggle class
        gal_item.toggleClass('gallery_item_list');
        gal_img.toggleClass('gallery_line');
        
        
        // change icon style
        if(gal_item.hasClass('gallery_item_list')){
          $(this).addClass('icon_list_open')
          .html('<span>•••</span>'+
                '<span>•••</span>'+
                '<span>•••</span>');
          gal_top.attr("class", "gallery_top gallery_hide_top");
        }else{
          $(this).removeClass('icon_list_open')
          .html('<span>• -</span>'+
                '<span>• -</span>'+
                '<span>• -</span>');
          gal_top.attr("class", "gallery_top");
        }
      });
    },
    // Show on click
    clickOn: function(i){
      var self = this;
      this.js(i).on('click',function(e){
        e.preventDefault();
        self.fx_in(self.lk(i)); 
        self.fx_in(gal_box);
      });
    }, 
    // out function
    fx_out: function(el){
      el.addClass('efOut')
      .delay(500)
      .fadeOut('fast')
      .removeClass('efIn');
      // show scroll
      $('body').css({overflow:'auto'});
      return false;
    }, 
    // in function
    fx_in: function(el){
      el.removeClass('efOut')
      .show(200)
      .addClass('efIn');
      // hide scroll
      $('body').css({overflow:'hidden'});
      return false;
    }
  };
})();
// ready function of gallery
gallery.ready_();

// js for index-attraction ends


// js for testimonial-section
  $(document).on('ready', function() {
    $(".lazy").slick({
      lazyLoad: 'ondemand', // ondemand progressive anticipated
      infinite: true,
      autoplay: false,
      autoplaySpeed: 2000,
    });
  });

// js for testimonial-section ends

