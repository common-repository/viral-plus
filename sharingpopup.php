<?php
/*
    Plugin Name: FacebooK Popup Share  Viral plus
   Plugin URI: http://wptit.com/portfolio/viralshare-facebook-popup-like-share-wordpress
   Description: Viral Plus Plugin ask your users to share your website article or blog on facebook without annoying them in friendly popup style, Just like other viral website you can also make your article or website or video go viral .
   Version: 1.0
   Author: Wptit
   Author URI: http://wptit.com/
   Copyright: 2015,
*/


// default settings
$viral_share_popup_defaults = apply_filters('viral_share_popup_defaults', array(
	'popup_width' => 300,
	'popup_height' => 370,
	'popup_v_pages' =>'true',
	'popup_v_Posts' => 'true',
	'popup_v_fpage' => 'true',

));

//	pull the settings from the db
$viral_share_popup_settings = get_option('viral_share_popup_settings');

//	fallback
$viral_share_popup_settings = wp_parse_args($viral_share_popup_settings, $viral_share_popup_defaults);


add_action('admin_init', 'viral_share_popup_register_settings');
function viral_share_popup_register_settings() {
	register_setting('viral_share_popup_settings', 'viral_share_popup_settings', 'viral_share_popup_settings_validate');
}


add_action('admin_menu', 'viral_plugin_menu');

function viral_plugin_menu() {
	add_menu_page('Viral FB Share Setting', 'Share Popup', 'administrator', 'viral-plugin-settings', 'viral_plugin_settings_page', 'dashicons-admin-post');
}
function viral_plugin_settings_page() {
	require 'include/setting_page.php' ;
}

function viral_share_popup_settings_validate($input) {
 	$input['popup_v_pages'] = $input['popup_v_pages'];
	$input['popup_v_Posts'] = $input['popup_v_Posts'];
	$input['popup_v_fpage'] = $input['popup_v_fpage'];
	return $input;
}


function viral_share_popup_settings_update_check() {
	global $viral_share_popup_settings;
	if(isset($viral_share_popup_settings['update'])) {
		echo '<div class="updated fade" id="message" style="margin-left:0;"><p> Popup Settings <strong>'.$viral_share_popup_settings['update'].'</strong></p></div>';
		unset($viral_share_popup_settings['update']);
		update_option('viral_share_popup_settings', $viral_share_popup_settings);
	}
}


function viral_share_popup_popup($args = array(), $content = null) {
	require 'include/popup.php';
}

if (!is_admin() ){


	function viral_js(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'viral_popup.js', plugins_url( '/js/viral_popup.js' , __FILE__ ));
		wp_enqueue_script( 'viral_fb.js', plugins_url( '/js/viral_facebook.js' , __FILE__ ));
		wp_enqueue_style( 'viral_popup.css', plugins_url('/css/viral_popup.css', __FILE__ ));
	}

	function viral_head() {

		global $viral_share_popup_settings;
		$options = $viral_share_popup_settings;
		//$appid = $options['v_appid'];
		$link = get_permalink();
		$content = '';
		$title = '';
		if(is_single()){ $post = get_post($post_id); }
		elseif(is_front_page()){$post_id = get_option('page_on_front'); $post = get_page( $post_id ); }
		else{ $post = get_page( $post_id ); }
		$content = substr(strip_tags($post->post_content,'') , 0, 200);
		$title = $post->post_title;
		$first_img = '';
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  		$first_img = $matches[1][0];
		if(empty($first_img)){ //Defines a default image
			$first_img = plugins_url( 'include/default.jpg',__FILE__);
		}
		echo '<script type="text/javascript">
				var cont = "'.preg_replace( "/\r|\n/", "<br/>", $content).'";
			add_viral_meta("'.$link.'","'.$title.'",cont,"'.get_bloginfo().'","'.$first_img.'");
		</script>';
	}

	function viral_share_popup_header() {
		global $viral_share_popup_settings;
		$options = $viral_share_popup_settings;
		$link = get_permalink();	?>
	 <!-- Load Facebook SDK for JavaScript -->
    <script type="text/javascript">
        jQuery(document).ready( function() {
            <?php $v_posts = $options['popup_v_Posts'];
					$v_pages = $options['popup_v_pages'];
					$f_page = $options['popup_v_fpage'];

			if(($f_page == 'true' && is_front_page()) || ($v_posts =='true' && is_single() == 1) || ($v_pages == 'true' && is_page() == 1)){
				if($options['popup_v_time_delay']){ ?>
					setTimeout(function(){
						  loadPopupBox();
					},<?php echo ($options['popup_v_time_delay'] * 1000 );?>);
					<?php
				} else{ ?>
				loadPopupBox();
			<?php }
			}?>
        });


    function share() {
        jQuery("#popup_box").fadeOut(200);
        jQuery("#wrap-out").css({
            "display": "none"
        });
        window.open("https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>","_blank","width=400, height=300");
    }
	</script>
    <style type="text/css">
	/* Popup */
	#popup_box {
		height:<?php echo $viral_share_popup_settings['popup_height']; ?>px;
		width:<?php echo $viral_share_popup_settings['popup_width']; ?>px;
		margin: -<?php echo $viral_share_popup_settings['popup_height'] / 2; ?>px 0 0 -<?php echo $viral_share_popup_settings['popup_width'] / 2; ?>px;
	}
	#popup_box .inner1 {
		height:<?php echo $viral_share_popup_settings['popup_height']; ?>px;
		background:url('<?php echo $options['st_upload']; ?>') no-repeat center !important;
	}
	#popupBoxClose {
		background:url('<?php echo plugins_url( "cross.png"); ?>') no-repeat;
	}
	.inner1 > h2{ font-size:<?php echo $viral_share_popup_settings['popup_v_title_size']; ?>px;}
	<?php echo $viral_share_popup_settings['popup_style']; ?>
	</style>
	<?php viral_share_popup_popup(); ?>
	<?php }

	add_action( 'wp_enqueue_scripts', 'viral_js' );
	add_action( 'wp_head', 'viral_head' );
	add_action( 'wp_head', 'viral_share_popup_header' );
}
?>