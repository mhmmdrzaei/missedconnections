$(function(){

	if ($(window).width() > 775) {

	$('ul.sub-menu li').each( function(){
		var headerMenuWidth = $(this).parents().eq(1).width();
		$(this).css({
			'width' : (headerMenuWidth + 'px')
		});

	});

	}

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

	//citations page

let sections = gsap.utils.toArray(".citationsPost"),
    currentSection = sections[0];

gsap.defaults({overwrite: 'auto', duration: 0.3});

// stretch out the body height according to however many sections there are. 
gsap.set("#pageCitations", {height: (sections.length * 80) + "%"});

// create a ScrollTrigger for each section
sections.forEach((section, i) => {
  ScrollTrigger.create({
    // use dynamic scroll positions based on the window height (offset by half to make it feel natural)
    start: () => (i - 0.5) * innerHeight,
    end: () => (i + 0.5) * innerHeight,
    // when a new section activates (from either direction), set the section accordinglyl.
    onToggle: self => self.isActive && setSection(section)
  });
});

function setSection(newSection) {
  if (newSection !== currentSection) {
    gsap.to(currentSection, {scale: 1, autoAlpha: 0})
    gsap.to(newSection, {scale: 1, autoAlpha: 1});
    currentSection = newSection;
  }
}

// // handles the infinite part, wrapping around at either end....
// ScrollTrigger.create({
//   start: 1,
//   end: () => ScrollTrigger.maxScroll('.pageCitations') - 1,
//   onLeaveBack: self => self.scroll(ScrollTrigger.maxScroll('.pageCitations') - 2),
//   onLeave: self => self.scroll(2)
// }).scroll(2);


//languages options

$('.languageChoiceContent:nth-child(2)').addClass('visible');


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
  	 $(".pageTitlePage h1").css('position', 'fixed');

  } else if ((scrollBottom < 350) && (x > 700)) {
    $(".languageChoiceEach").fadeOut(100);
    $(".pageTitlePage h1").css('position', 'relative');


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


//google maps
(function( $ ) {

/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */
function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 16,
        mapTypeId   : google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });

    // Center map based on markers.
    centerMap( map );

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };

    // Create marker instance.
    var marker = new google.maps.Marker({
        position : latLng,
        map: map
    });

    // Append to reference for later use.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else{
        map.fitBounds( bounds );
    }
}

// Render maps on page load.
$(document).ready(function(){
    $('.acf-map').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);