$(document).ready(function(){
	$('#slideshow .slideshow-home  .view-content').cycle({ 
			speed:       200, 
			timeout:     5000, 
			pager:      '#nav', 
			pagerEvent: 'mouseover',
			pauseOnPagerHover: true, 
	});
});
