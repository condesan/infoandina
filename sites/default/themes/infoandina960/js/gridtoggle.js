/**
 * $Id:$
 *  
 * Toggle grid for ninesixty
 * Created by: Emil Stjerneman - <http://www.anon-design.se> (anon - <http://drupal.org/user/464598>)
 *
 * Press "shift + g" to toggle 
 */
$(document).ready(function() {
  $(document).keypress(function(e){
    var target = e.target || e.srcElement;
    // Defeat Safari bug 
    if (target.nodeType==3) { 
      target = targ.parentNode;
    }
    // Prevent toggle of you are in a textarea for input field.
    if(target.tagName != "TEXTAREA" && target.tagName != "INPUT" && e.which==71 && e.shiftKey) {
      $('body').toggleClass('show-grid');
    }    
  });
});
