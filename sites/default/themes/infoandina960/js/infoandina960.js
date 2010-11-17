$(document).ready(function(){
	$('#slideshow .slideshow-home  .view-content').cycle({ 
			speed:       200, 
			timeout:     5000, 
			pager:      '#nav', 
			pagerEvent: 'mouseover',
			pauseOnPagerHover: true, 
	});
  //desactiva grid de 960
	//$('body').removeClass('show-grid');	
});
