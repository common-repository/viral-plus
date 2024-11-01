<div id="icon-options-general" class="icon32"></div>
<h2>Sharing Popup Settings</h2>
<?php viral_share_popup_settings_update_check(); ?>
<form method="post" action="options.php">
  <?php settings_fields('viral_share_popup_settings'); ?>
  <?php global $viral_share_popup_settings; $options = $viral_share_popup_settings; ?>

  <table class="form-table" cellspacing="0" width="786">
    <thead>
      <tr>
        <th style="font-size:18px;" colspan="2">Settings</th>
      </tr>
    </thead>
   <tr valign="top">
      <th>Show On</th>
      <td><p>
          <input type="checkbox" name="viral_share_popup_settings[popup_v_pages]" id="v_pages" value="true" <?php if($options['popup_v_pages']=='true'){echo 'checked="checked"';} ?>>
          Pages</p>
        <p>
          <input type="checkbox" name="viral_share_popup_settings[popup_v_Posts]" id="v_Posts" value="true" <?php if($options['popup_v_Posts']=='true'){echo 'checked="checked"';} ?>>
          Post</p>
        <p>
          <input type="checkbox" name="viral_share_popup_settings[popup_v_fpage]" id="v_fpage" value="true" <?php if($options['popup_v_fpage']=='true'){echo 'checked="checked"';} ?>>
          Home Page</p></td>
    </tr>
     <tr valign="top">
      <th>Show Post / Page Title</th>
      <td>
        <input type="checkbox" name="viral_share_popup_settings[popup_v_show_title]" id="" value="1" <?php if($options['popup_v_show_title'] == 1) echo 'checked="checked"';?> >
        </td>
     </tr>
     <tr valign="top">
      <th>Share Button Text</th>
      <td>
       <input type="text" name="viral_share_popup_settings[popup_v_share_button_text]" id="" value="<?php if($options['popup_v_share_button_text'] != '') echo $options['popup_v_share_button_text'];?>" class="regular-text"> 
      </td>
    </tr>
    <tr valign="top">
      <th>Time Delay</th>
      <td>
       <input type="text" name="viral_share_popup_settings[popup_v_time_delay]" id="" value="<?php if($options['popup_v_time_delay'] != '') echo $options['popup_v_time_delay'];?>"  class="regular-text"/> 
      </td>
    </tr>
    <tr valign="top">
      <th>Title</th>
      <td>
       <input type="text" name="viral_share_popup_settings[popup_v_title]" id="" value="<?php if($options['popup_v_title'] != '') echo $options['popup_v_title'];?>"  class="regular-text" /> 
      </td>
    </tr>
    <tr valign="top">
      <th>Title Font Size</th>
      <td>
       <input type="text" name="viral_share_popup_settings[popup_v_title_size]" id="" value="<?php if($options['popup_v_title_size'] != '') echo $options['popup_v_title_size'];?>"  class="regular-text" /> 
      </td>
    </tr>
    <tr valign="top">
      <th>Height</th>
      <td>
       <input type="text" name="viral_share_popup_settings[popup_height]" id="" value="<?php if($options['popup_height'] != '') echo $options['popup_height'];?>"  class="regular-text" /> 
      </td>
    </tr>
    <tr valign="top">
      <th>Width</th>
      <td>
       <input type="text" name="viral_share_popup_settings[popup_width]" id="" value="<?php if($options['popup_width'] != '') echo $options['popup_width'];?>"  class="regular-text" /> 
      </td>
    </tr>
    <tr>
      <input type="hidden" name="viral_share_popup_settings[update]" value="UPDATED" />
    <tr>
      <td></td>
      <td><input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" /></td>
    </tr>
  </table>
</form>