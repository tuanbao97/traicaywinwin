	
/*scrolling banner*/
(function ($) {
  "use strict";

	var enableEventMouseDrag = true;
	// Check size screen. If mobile then disable event mouseDrag
	if (window.matchMedia('(max-width: 767px)').matches) {
        enableEventMouseDrag = false;
    } else {
        enableEventMouseDrag = true;
    }
	 $(document).ready(function(){
		 $('.carousel_se_01_carousel' ).owlCarousel({
		    items: 3,
		    nav: true,
		    loop :true,
		   
		    mouseDrag: enableEventMouseDrag, /*= false very important to fix click tag a mobile device*/
		    responsiveClass: true,
		    /*navText : ["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"],*/
		    responsive: {
		        0:{
		          items: 1
		        },
		        480:{
		          items: 1
		        },
		        767:{
		          items: 2
		        },
		        992:{
		          items: 2
		        },
		        1200:{
		          items: 3
		        }
		    }
		  });

	});


	$(document).ready(function(){
	    $('.carousel_se_03_carousel').owlCarousel({
	        items: 4,
	        nav: true,
	        dots: false,
	        loop :true,
	       
	        mouseDrag: enableEventMouseDrag, /*= false very important to fix click tag a mobile device*/
	        responsiveClass: true,
	        autoplay: true,
	        autoplayTimeout: 3000,
	        autoplayHoverPause: true,
	        navText : ["<i class='icofont-scroll-left'></i>","<i class='icofont-scroll-right'></i>"],
	        responsive: {
	            0:{
	              items: 1
	            },
	            480:{
	              items: 2
	            },
	            767:{
	              items: 3
	            },
	            992:{
	              items: 3
	            },
	            1200:{
	              items: 4
	            }
	        }
	    });
	});  

	$(document).ready(function(){
		 var el04 = $('.carousel_se_04_carousel');
		 var carousel04;
		 var carousel04Options = {
		    items: 3,
		    nav: true,
		    dots: true,
			loop :false,
		   
		    mouseDrag: enableEventMouseDrag, /*= false very important to fix click tag a mobile device*/
		    responsiveClass: true,
		    autoplay: true,
		    autoplayTimeout: 10000,
		    autoplayHoverPause: true,
		    /*navText : ["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"],*/
		    responsive: {
		        0:{
		          items: 1,
		          rows: 1
		        },
		        480:{
		          items: 1,
		          rows: 1
		        },
		        767:{
		          items: 2,
		          rows: 2
		        },
		        992:{
		          items: 2,
		          rows: 2
		        },
		        1200:{
		          items: 3,
		          rows: 2
		        }
		    }
		  };
		  
		  // Taken from Owl Carousel so we calculate width the same way
		  var viewport = function() {
		    var width;
		    if (carousel04Options.responsiveBaseElement && carousel04Options.responsiveBaseElement !== window) {
		      width = $(carousel04Options.responsiveBaseElement).width();
		    } else if (window.innerWidth) {
		      width = window.innerWidth;
		    } else if (document.documentElement && document.documentElement.clientWidth) {
		      width = document.documentElement.clientWidth;
		    } else {
		      console.warn('Can not detect viewport width.');
		    }
		    return width;
		  };
		
		  var severalRows = false;
		  var orderedBreakpoints = [];
		  for (var breakpoint in carousel04Options.responsive) {
		    if (carousel04Options.responsive[breakpoint].rows > 1) {
		      severalRows = true;
		    }
		    orderedBreakpoints.push(parseInt(breakpoint));
		  }
		  
		  // Custom logic is active if carousel is set up to have more than one row for some given window width
		  if (severalRows) {
		    orderedBreakpoints.sort(function (a, b) {
		      return b - a;
		    });
		    var slides = el04.find('[data-slide-index]');
		    var slidesNb = slides.length;
		    if (slidesNb > 0) {
		      var rowsNb;
		      var previousRowsNb = undefined;
		      var colsNb;
		      var previousColsNb = undefined;
		
		      //Calculates number of rows and cols based on current window width
		      var updateRowsColsNb = function () {
		        var width =  viewport();
		        for (var i = 0; i < orderedBreakpoints.length; i++) {
		          var breakpoint = orderedBreakpoints[i];
		          if (width >= breakpoint || i == (orderedBreakpoints.length - 1)) {
		            var breakpointSettings = carousel04Options.responsive['' + breakpoint];
		            rowsNb = breakpointSettings.rows;
		            colsNb = breakpointSettings.items;
		            break;
		          }
		        }
		      };
		
		      var updateCarousel = function () {
		        updateRowsColsNb();
		
		        //Carousel is recalculated if and only if a change in number of columns/rows is requested
		        if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
		          var reInit = false;
		          if (carousel04) {
		            //Destroy existing carousel if any, and set html markup back to its initial state
		            carousel04.trigger('destroy.owl.carousel');
		            carousel04 = undefined;
		            slides = el04.find('[data-slide-index]').detach().appendTo(el04);
		            el04.find('.fake-col-wrapper').remove();
		            reInit = true;
		          }
		
		
		          //This is the only real 'smart' part of the algorithm
		
		          //First calculate the number of needed columns for the whole carousel
		          var perPage = rowsNb * colsNb;
		          var pageIndex = Math.floor(slidesNb / perPage);
		          var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));
		
		          //Then populate with needed html markup
		          var count = 0;
		          for (var i = 0; i < fakeColsNb; i++) {
		            //For each column, create a new wrapper div
		            var fakeCol = $('<div class="fake-col-wrapper"></div>').appendTo(el04);
		            for (var j = 0; j < rowsNb; j++) {
		              //For each row in said column, calculate which slide should be present
		              var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
		              if (index < slidesNb) {
		                //If said slide exists, move it under wrapper div
		                slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
		              }
		              count++;
		            }
		          }
		          //end of 'smart' part
		
		          previousRowsNb = rowsNb;
		          previousColsNb = colsNb;
		
		          if (reInit) {
		            //re-init carousel with new markup
		            carousel04 = el04.owlCarousel(carousel04Options);
		          }
		        }
		      };
		
		      //Trigger possible update when window size changes
		      $(window).on('resize', updateCarousel);
		
		      //We need to execute the algorithm once before first init in any case
		      updateCarousel();
		    }
		  }
		
		  //init
		  carousel04 = el04.owlCarousel(carousel04Options);

	 });

	 $(document).ready(function(){
		 $('.carousel_se_06_carousel' ).owlCarousel({
		    items: 4,
		    nav: true,
		    loop :true,
		   
		   	autoplay: false,

		    mouseDrag: enableEventMouseDrag, /*= false very important to fix click tag a mobile device*/
		    responsiveClass: true,
		    /*navText : ["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"],*/
		    responsive: {
		        0:{
		          items: 1
		        },
		        480:{
		          items: 1
		        },
		        767:{
		          items: 3
		        },
		        992:{
		          items: 4
		        },
		        1200:{
		          items: 4
		        }
		    }
		  });

	 });

	  


})(jQuery); 
