// JavaScript extracted from embed snippet.
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.reviewmgr.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "reviewmgr-wjs");
// Disable scrolling on the first iframe in the widget.
window.onload = function() { document.getElementsByClassName('ureviews-widget')[0].getElementsByTagName('iframe')[0].setAttribute('scrolling','no'); }
//Custom Code to hide/unhide widget modal
jQuery('.ureviews-widget .ureview-toggle-button').click(function(){
  
  jQuery('.ureviews-widget .ureview-popup').css("visibility", "visible");
  jQuery('.ureviews-widget .ureview-popup').css("height", "100%");
  
  jQuery('.ureviews-widget .ureview-close-btn').css("display", "block");
  jQuery('.reviewmgr-writereview').css("display", "block");
  jQuery('.ureviews-widget .reviewmgr-header').css("display", "block");

});
	
jQuery('.ureviews-widget .ureview-close-btn').click(function(){
  
  jQuery('.ureviews-widget .ureview-popup').css("visibility", "hidden");
  jQuery('.ureviews-widget .ureview-popup').css("height", "0%");
  
  jQuery('.ureviews-widget .ureview-close-btn').css("display", "none");
  jQuery('.reviewmgr-writereview').css("display", "none");
  
  jQuery('.ureviews-widget .reviewmgr-header').css("display", "none");
	  
});