$(function(){

  $('.current-artists').on('click', function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Check if the current page is the home page
    if (window.location.pathname === '/') {
        // If on the home page, scroll to the target element
        var target = $('#artists');
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    } else {
        // If on another page, redirect to the home page
        window.location.href = '/#artists';
    }
});
	if ($(window).width() > 775) {

	$('ul.sub-menu li').each( function(){
		var headerMenuWidth = $(this).parents().eq(1).width();
		$(this).css({
			'width' : (headerMenuWidth + 'px')
		});

	});

	}

    $('#menu-wrapper').click(function() {
          $("#menu-header-menu").toggleClass('activeMenu',1000, "easeOutSine");
          $('body').toggleClass('hidden');
          $('.languageChoiceEach').toggleClass('fontColour');


    });

	  $.fn.readMore = function(options) {
	    if(options === 'destroy') {
	      $(this).each(function (_j, element) {
	        $($(element).data().controller).off('click');
	        $(element).html($(element).children().last().html());
	      });
	      return;
	    }

	    var maxLines = parseInt(options.lines),
	      readMoreLabel = options.readMoreLabel || "+ Read more",
	      readLessLabel = options.readLessLabel || "- Less",
	      ellipsis = options.ellipsis || "",
	      splitOn = options.splitOn || ' ';

	    if(!maxLines || isNaN(maxLines)) {
	      console.error("lines must be an integer");
	      return;
	    }
	  
	    $(this).each(function (_j, element) {
	      var originalText = $(element).html(),
	        textArr = originalText.split(splitOn),
	        $newDiv = $("<div/>"),
	        $fullDiv = $("<div/>"),
	        $readMore = $($(element).data().controller),
	        hPrev = 0, 
	        lines = 0, 
	        overflow = false, 
	        l = textArr.length, 
	        i;
	  
	      $fullDiv.html(originalText);
	      $(element).html($newDiv).append($fullDiv);
	      
	      for(i=0; i < l; i++) {
	        $newDiv.append(textArr[i] + ' ');
	        var h = $newDiv.height();
	        if(h > hPrev) {
	          hPrev = h;
	          lines++;
	          if(lines > maxLines) {
	            overflow = true;
	            $newDiv.html(textArr.slice(0, i).join(' '))
	            break;
	          }
	        }
	      }
	  
	      if(overflow) {
	        $readMore.text(readMoreLabel).css('display', 'block');
	        $newDiv.append(ellipsis);
	        var minH = $newDiv.height();
	        var realH =  $fullDiv.height();
	        var display = $newDiv.css('display');
	  
	        function callback() {
	          if($(element).data().expanded) {
	            $fullDiv.animate(6000, function() {
	              $newDiv.css('display', display);
	              $fullDiv.css('display', 'none');
	            });
	            $readMore.animate({opacity: 0}, 500, function() {
	              $readMore.text(readMoreLabel);
	            }).animate({opacity: 1}, 500);
	            $(element).data('expanded', false);
	          } else {
	            $newDiv.css('display', 'none');
	            $fullDiv.css('display', display);
	            // $fullDiv.css('height', minH + 'px')
	            // $fullDiv.animate({height: realH + 'px'}, 1000);
	            $readMore.animate({opacity: 0}, 500, function() {
	              $readMore.text(readLessLabel);
	            }).animate({opacity: 1}, 500);
	            $(element).data('expanded', true);
	          }
	        }

	        $readMore.on('click', callback);
	      } else {
	        $readMore.css('display', 'none');
	      }
	      $fullDiv.css('display', 'none');
	    });
	  }

	$(".text-area").readMore({lines: 6})


	 $(".blob").click(function() { 
    $('.navLink').toggleClass('visible');

  });

	$('.navLink').click(function() {
		$('.navLink').toggleClass('visible');
	});


//lang option

$('.languageChoiceContent:nth-child(3)').addClass('visible');
$('.lds-roller').hide();


 $(".languageChoiceEach").click(function() {

    if ($('.languageChoiceContent').hasClass('visible')) {
      $('.languageChoiceContent').removeClass('visible');

    } 
    $(this).next('.languageChoiceContent').addClass('visible');

  });


$(window).scroll(function() {
  var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
  var x = $(window).width();
  if ((scrollBottom > 350) && (x > 700)) {
  	$(".languageChoiceEach").fadeIn(100);
  	 // $(".pageTitlePage h1").css('position', 'fixed');

  } else if ((scrollBottom < 350) && (x > 700)) {
    $(".languageChoiceEach").fadeOut(100);
    // $(".pageTitlePage h1").css('position', 'relative');


  }
});
 //smoothscroll
 	$("a").on('click', function(event) {

 	  // Make sure this.hash has a value before overriding default behavior
 	  if (this.hash !== "") {
 	    // Prevent default anchor click behavior
 	    event.preventDefault();

 	    // Store hash
 	    var hash = this.hash;

 	    // Using jQuery's animate() method to add smooth page scroll
 	    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
 	    $('html, body').animate({

 	      scrollTop: $(hash).offset().top
 	    }, 800, function(){

 	      // Add hash (#) to URL when done scrolling (default click behavior)
 	      window.location.hash = hash;
 	    });
 	  } // End if
 	});

});


// gsap

gsap.config({
  autoSleep: 60,
  force3D: false,
  nullTargetWarn: false,
  trialWarn: false,
  units: {left: "%", top: "%", rotation: "rad"}
});
function animateFrom(elem, direction) {
	  gsap.registerPlugin(ScrollTrigger);
  direction = direction || 1;
  var x = 0,
      y = direction * 100;
  if(elem.classList.contains("gs_reveal_fromLeft")) {
    x = -100;
    y = 0;
  } else if (elem.classList.contains("gs_reveal_fromRight")) {
    x = 100;
    y = 0;

  } 

  elem.style.transform = "translate(" + x + "px, " + y + "px)";
  elem.style.opacity = "1";
  gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
    duration: 1.6, 
    x: 0,
    y: 0, 
    autoAlpha: 1, 
    overwrite: "auto",
    ease: "power2", 
    stagger: 0.6
  });
}

function hide(elem) {
  gsap.set(elem, {autoAlpha: 1});
}

document.addEventListener("DOMContentLoaded", function() {
  gsap.registerPlugin(ScrollTrigger);
  
  gsap.utils.toArray(".gs_reveal").forEach(function(elem) {
    hide(elem); // assure that the element is hidden when scrolled into view
    
    ScrollTrigger.create({
      trigger: elem,
      onEnter: function() { animateFrom(elem, -1) }, 
      onEnterBack: function() { animateFrom(elem, -1) },
      onLeave: function() { hide(elem, -1) } // assure that the element is hidden when scrolled into view
    });
  });
});





// Scroll Scenes 
  if (($(window).width() > 775) && ($('body').hasClass('home') || $('body').hasClass('page-id-46') || $('body').hasClass('page-id-525'))) {
const scenes = gsap.utils.toArray('.scene');

// maybe use dymanic height for pin/scroll ends?
const height = ((scenes.length - 1) * 400) + '%';

// Scenes Timeline
const pinTl = gsap.timeline({
  scrollTrigger: {
    trigger: ".scenes__items",
    pin: ".scenes",
    start: "center center",
    end: `+=${height}`,
   // onEnterBack: () => startVideo(scenes[scenes.length - 1]),
    scrub: true,
  }
});

// Set scenes wrapper to absolute
gsap.set(scenes, {position: "absolute", top: "20vh" });

// Loop over scenes
scenes.forEach(function(elem, i) {

  
  if (i != 0) {
    // Scene Enter animations
    pinTl.from(elem.querySelector('.scene__figure'), { 
        autoAlpha:0, 
      }, i
    )

    pinTl.from(elem.querySelector('.scene__header'), { 
      autoAlpha:0, 
      translateY: 100,
      }, i
    )
        pinTl.from(elem.querySelector('.scene__figureCite'), { 
        autoAlpha:0, 
      }, i
    )

    pinTl.from(elem.querySelector('.scene__headerCite'), { 
      autoAlpha:0, 
      translateY: 100,
      }, i
    )
  }

  if (i < scenes.length) {
    pinTl.to(elem.querySelector('.scene__header'), { 

        className: "scene__header zIndex openingDesc"

      }, i 
     )
    pinTl.to(elem.querySelector('.scene__figure'), { 
        className: "scene__figure zIndex",
        
      }, i
    )
    pinTl.to(elem.querySelector('.scene__headerCite'), { 

        className: "scene__headerCite zIndex postTitle"

      }, i 
     )
    pinTl.to(elem.querySelector('.scene__figureCite'), { 
        className: "scene__figureCite zIndex",
        
      }, i
    )
  }
   
  // Scene Exit animations
  if (i != scenes.length - 1) {
    pinTl.to(elem.querySelector('.scene__header'), { 
        autoAlpha:0, 
        translateY: -100,
      }, i + 0.75
    )
    pinTl.to(elem.querySelector('.scene__figure'), { 
        autoAlpha:0,
      }, i + 0.75
    )
    pinTl.to(elem.querySelector('.scene__headerCite'), { 
        autoAlpha:0, 
        translateY: -100,
      }, i + 0.75
    )
    pinTl.to(elem.querySelector('.scene__figureCite'), { 
        autoAlpha:1,
      }, i + 0.75
    )
  }

});	

}

gsap.to(".svg1", {
  yPercent: 50,
  ease: "none",
  scrollTrigger: {
    trigger: "body",
    // start: "top bottom", // the default values
    // end: "bottom top",
    scrub: true
  }, 
});
gsap.to(".svg2", {
  yPercent: 20,
  ease: "none",
  scrollTrigger: {
    trigger: "body",
    // start: "top bottom", // the default values
    // end: "bottom top",
    scrub: true
  }, 
});
gsap.to(".svg4", {
  yPercent: 60,
  ease: "none",
  scrollTrigger: {
    trigger: "body",
    // start: "top bottom", // the default values
    // end: "bottom top",
    scrub: true
  }, 
});

gsap.to(".svg3", {
  yPercent: 60,
  ease: "none",
  scrollTrigger: {
    trigger: "body",
    // start: "top bottom", // the default values
    // end: "bottom top",
    scrub: true
  }, 
});






