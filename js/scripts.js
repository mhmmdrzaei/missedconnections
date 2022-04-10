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
gsap.set("#pageCitations", {height: (sections.length * 100) + "%"});

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
    gsap.to(currentSection, {scale: 0.8, autoAlpha: 0})
    gsap.to(newSection, {scale: 1, autoAlpha: 1});
    currentSection = newSection;
  }
}

// handles the infinite part, wrapping around at either end....
ScrollTrigger.create({
  start: 1,
  end: () => ScrollTrigger.maxScroll('.pageCitations') - 1,
  onLeaveBack: self => self.scroll(ScrollTrigger.maxScroll('.pageCitations') - 2),
  onLeave: self => self.scroll(2)
}).scroll(2);


});