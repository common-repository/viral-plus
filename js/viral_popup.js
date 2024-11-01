function unloadPopupBox() {
	jQuery('#popup_box').fadeOut(200);
	jQuery("#wrap-out").css({	
		"display": "none"  
	}); 
}

function loadPopupBox() {
	jQuery('#popup_box').fadeIn(200);
	jQuery("#wrap-out").css({
		"background": "#000",
		"opacity": "0.7"  
	}); 		
}
 
function add_viral_meta(metaLink,metaTitle,metaContent,metaBloginfo,metaFirstimg){
	var meta = '';
	meta = '<meta property="og:url" content="'+metaLink+'" /><meta property="og:type" content="website" /><meta property="og:title" content="'+metaTitle+'" /><meta property="og:description" content="'+metaContent+'" /><meta property="og:site_name" content="'+metaBloginfo+'" /><meta property="og:image" content="'+metaFirstimg+'" />';
	jQuery('head').append(meta);	
}

jQuery(document).ready( function() {
	 jQuery('#wrap-out, #popupBoxClose').click( function() {
		unloadPopupBox();
	});
});