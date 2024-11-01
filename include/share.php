<?php
global $viral_share_popup_settings;
$options = $viral_share_popup_settings;
$appid = $options['v_appid'];
$link = get_permalink();
$content = '';
$title = '';

if(is_single()){ $post = get_post($post_id); }
else{ $post = get_page( $post_id ); }
$content = substr(strip_tags($post->post_content,'') , 0, 200);
$title = $post->post_title;	
  
function catch_that_image() {

  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = plugins_url( 'default.jpg',__FILE__);
	
  }
  return $first_img;
}
?>
<div class="sa-icon sa-custom" style="display: block;background-image: url('<?php echo catch_that_image() ?>');width:auto;height:200px;"></div>
<button class="fbshare_bt" type="button" onClick="share();"><?php if(trim($options['popup_v_share_button_text']) !== ''){ echo $options['popup_v_share_button_text']; } else { ?>Share On Facebook<?php } ?></button> 
