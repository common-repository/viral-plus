<?php

add_action('wp_footer', 'fb_viral_share');
function fb_viral_share(){ 
	global $viral_share_popup_settings;
	$options = $viral_share_popup_settings;
	echo '<div id="popup_box"><a id="popupBoxClose">X</a>';
	echo '<div class="inner1"><h2>';
	if(trim($options['popup_v_title']) != ''){ echo $options['popup_v_title']; } 
	else { echo 'Are you sure ?'; } 
	echo '</h2>'."\n";
	require "share.php";
	echo '</div>'."\n";
	echo '</div>';
	echo '<div id="wrap-out" style="width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index:10000;"></div>';
	
	
}