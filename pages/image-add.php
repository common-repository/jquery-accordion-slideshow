<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$JaS_errors = array();
$JaS_success = '';
$JaS_error_found = FALSE;

// Preset the form fields
$form = array(
	'JaS_id' => '',
	'JaS_Location' 	=> '',
	'JaS_Gallery' 	=> '',
	'JaS_timeout' 	=> '',
	'JaS_width' 	=> '',
	'JaS_height' 	=> '',
	'JaS_slideWidth' => '',
	'JaS_slideHeight' => '',
	'JaS_tabWidth' 	=> '',
	'JaS_Random' 	=> '',
	'JaS_speed' 	=> '',
	'JaS_trigger' 	=> '',
	'JaS_pause' 	=> '',
	'JaS_invert' 	=> '',
	'JaS_easing' 	=> '',
	'JaS_Date' 		=> ''
);

// Form submitted, check the data
if (isset($_POST['JaS_form_submit']) && $_POST['JaS_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('JaS_form_add');
	
	$form['JaS_Location'] 	= isset($_POST['JaS_Location']) ? sanitize_text_field($_POST['JaS_Location']) : '';	
	$form['JaS_Gallery'] 	= isset($_POST['JaS_Gallery']) ? sanitize_text_field($_POST['JaS_Gallery']) : '';
	$form['JaS_timeout'] 	= isset($_POST['JaS_timeout']) ? sanitize_text_field($_POST['JaS_timeout']) : '';
	$form['JaS_width'] 		= isset($_POST['JaS_width']) ? sanitize_text_field($_POST['JaS_width']) : '';
	$form['JaS_height'] 	= isset($_POST['JaS_height']) ? sanitize_text_field($_POST['JaS_height']) : '';
	$form['JaS_slideWidth'] = isset($_POST['JaS_slideWidth']) ? sanitize_text_field($_POST['JaS_slideWidth']) : '';
	$form['JaS_slideHeight'] = isset($_POST['JaS_slideHeight']) ? sanitize_text_field($_POST['JaS_slideHeight']) : '';
	$form['JaS_tabWidth'] 	= isset($_POST['JaS_tabWidth']) ? sanitize_text_field($_POST['JaS_tabWidth']) : '';
	$form['JaS_Random'] 	= isset($_POST['JaS_Random']) ? sanitize_text_field($_POST['JaS_Random']) : '';
	$form['JaS_speed'] 		= isset($_POST['JaS_speed']) ? sanitize_text_field($_POST['JaS_speed']) : '';
	$form['JaS_trigger'] 	= isset($_POST['JaS_trigger']) ? sanitize_text_field($_POST['JaS_trigger']) : '';
	$form['JaS_pause'] 		= isset($_POST['JaS_pause']) ? sanitize_text_field($_POST['JaS_pause']) : '';
	$form['JaS_invert'] 	= isset($_POST['JaS_invert']) ? sanitize_text_field($_POST['JaS_invert']) : '';
	$form['JaS_easing'] 	= isset($_POST['JaS_easing']) ? sanitize_text_field($_POST['JaS_easing']) : '';
	
	if ($form['JaS_Location'] == '')
	{
		$JaS_errors[] = __('Please enter the image folder(Where you have your images).', 'jquery-accordion-slideshow');
		$JaS_error_found = TRUE;
	}
	
	if ($form['JaS_Gallery'] == '')
	{
		$JaS_errors[] = __('Please select the gallery name.', 'jquery-accordion-slideshow');
		$JaS_error_found = TRUE;
	}
	
	$returnvalue = JaS_Validation::num_val($form['JaS_width']);
	if ($form['JaS_width'] == '' || $form['JaS_width'] == 'invalid')
	{
		$JaS_errors[] = __('Please enter valid width.', 'jquery-accordion-slideshow');
		$JaS_error_found = TRUE;
	}
	
	$returnvalue = JaS_Validation::num_val($form['JaS_height']);
	if ($form['JaS_height'] == '' || $form['JaS_height'] == 'invalid')
	{
		$JaS_errors[] = __('Please enter valid height.', 'jquery-accordion-slideshow');
		$JaS_error_found = TRUE;
	}
	
	$returnvalue = JaS_Validation::num_val($form['JaS_slideWidth']);
	if ($form['JaS_slideWidth'] == '' || $form['JaS_slideWidth'] == 'invalid')
	{
		$JaS_errors[] = __('Please enter valid slide width.', 'jquery-accordion-slideshow');
		$JaS_error_found = TRUE;
	}
	
	$returnvalue = JaS_Validation::num_val($form['JaS_slideHeight']);
	if ($form['JaS_slideHeight'] == '' || $form['JaS_slideHeight'] == 'invalid')
	{
		$JaS_errors[] = __('Please enter valid slide height.', 'jquery-accordion-slideshow');
		$JaS_error_found = TRUE;
	}
	
	if(!is_numeric($form['JaS_timeout'])) { $form['JaS_timeout'] = 6000; }
	if(!is_numeric($form['JaS_tabWidth'])) { $form['JaS_tabWidth'] = 25; }
	if(!is_numeric($form['JaS_speed'])) { $form['JaS_speed'] = 1200; }
	
	if($form['JaS_pause'] != "true" && $form['JaS_pause'] != "false")
	{
		$form['JaS_pause'] = "true";
	} 
	
	if($form['JaS_Random'] != "YES" && $form['JaS_Random'] != "NO")
	{
		$form['JaS_Random'] = "YES";
	} 
	
	if($form['JaS_trigger'] != "click" && $form['JaS_trigger'] != "mouseover")
	{
		$form['JaS_trigger'] = "click";
	}
	
	if($form['JaS_invert'] != "true" && $form['JaS_invert'] != "false")
	{
		$form['JaS_invert'] = "true";
	} 
	
	
	//	No errors found, we can add this Group to the table
	if ($JaS_error_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".WpJqueryAccordionSlidshowTbl."`
			(`JaS_Location`, `JaS_Gallery`, `JaS_timeout`, `JaS_width`, `JaS_height`, `JaS_slideWidth`, `JaS_slideHeight`, `JaS_tabWidth`, `JaS_Random`, `JaS_speed`, `JaS_trigger`, `JaS_pause`, `JaS_invert`, `JaS_easing`)
			VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			array($form['JaS_Location'], $form['JaS_Gallery'], $form['JaS_timeout'], $form['JaS_width'], $form['JaS_height'], $form['JaS_slideWidth'], $form['JaS_slideHeight'], $form['JaS_tabWidth'], $form['JaS_Random'], $form['JaS_speed'], $form['JaS_trigger'], $form['JaS_pause'], $form['JaS_invert'], $form['JaS_easing'])
		);
		$wpdb->query($sql);
		
		$JaS_success = __('New details was successfully added.', 'jquery-accordion-slideshow');
		
		// Reset the form fields
		$form = array(
			'JaS_id' 		=> '',
			'JaS_Location' 	=> '',
			'JaS_Gallery' 	=> '',
			'JaS_timeout' 	=> '',
			'JaS_width' 	=> '',
			'JaS_height' 	=> '',
			'JaS_slideWidth' => '',
			'JaS_slideHeight' => '',
			'JaS_tabWidth' 	=> '',
			'JaS_Random' 	=> '',
			'JaS_speed' 	=> '',
			'JaS_trigger' 	=> '',
			'JaS_pause' 	=> '',
			'JaS_invert' 	=> '',
			'JaS_easing' 	=> '',
			'JaS_Date' 		=> ''
		);
	}
}

if ($JaS_error_found == TRUE && isset($JaS_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $JaS_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($JaS_error_found == FALSE && strlen($JaS_success) > 0)
{
	?>
	  <div class="updated fade">
		<p><strong><?php echo $JaS_success; ?> <a href="<?php echo WP_JaS_ADMIN_URL; ?>"><?php _e('Click here to view the details', 'jquery-accordion-slideshow'); ?></a></strong></p>
	  </div>
	  <?php
	}
?>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php _e('Jquery accordion slideshow', 'jquery-accordion-slideshow'); ?></h2>
	<form name="JaS_form" method="post" action="#" onsubmit="return JaS_submit()"  >
      <h3><?php _e('Add details', 'jquery-accordion-slideshow'); ?></h3>
      
		<label for="tag-title"><?php _e('Image folder location', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_Location" type="text" id="JaS_Location" value="<?php echo $form['JaS_Location']; ?>" size="80" maxlength="1024" />
		<p><?php _e('Where is the picture located on your server? upload your images in "wp-content/uploads/your-folder" and add the folder path in this box as per the below example.', 'jquery-accordion-slideshow'); ?><br />Example: wp-content/plugins/jquery-accordion-slideshow/gallery1/</p>
		
		<label for="tag-title"><?php _e('Gallery name', 'jquery-accordion-slideshow'); ?></label>
		<select name="JaS_Gallery" id="JaS_Gallery">
	    <option value=''>Select</option>
			<?php
			for($i=1; $i<=20; $i++)
			{
				if($i == 1)
				{
					echo "<option value='GALLERY".$i."'>GALLERY".$i." (Widget)</option>";	
				}
				else
				{
					echo "<option value='GALLERY".$i."'>GALLERY".$i." </option>";	
				}
			}
			?>
		</select>
		<p><?php _e('Select your gallery name. This name used to display the gallery in front page.', 'jquery-accordion-slideshow'); ?></p>
		
		<label for="tag-title"><?php _e('Time out', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_timeout" type="text" id="JaS_timeout" value="6000" maxlength="4" />
		<p><?php _e('Time between each slide (in ms)', 'jquery-accordion-slideshow'); ?> Example: 6000</p>
		
		<label for="tag-title"><?php _e('Width', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_width" type="text" id="JaS_width" value="<?php echo $form['JaS_width']; ?>" maxlength="4" />
		<p><?php _e('Width of the container (in px)', 'jquery-accordion-slideshow'); ?> Example: 250</p>
		
		<label for="tag-title"><?php _e('Height', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_height" type="text" id="JaS_height" value="<?php echo $form['JaS_height']; ?>" maxlength="4" />
		<p><?php _e('Height of the container (in px)', 'jquery-accordion-slideshow'); ?> Example: 150</p>
		
		<label for="tag-title"><?php _e('Slide Width', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_slideWidth" type="text" id="JaS_slideWidth" value="<?php echo $form['JaS_slideWidth']; ?>" maxlength="4" />
		<p><?php _e('Width of each slide (in px)', 'jquery-accordion-slideshow'); ?> Example: 200</p>
		
		<label for="tag-title"><?php _e('Slide Height', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_slideHeight" type="text" id="JaS_slideHeight" value="<?php echo $form['JaS_slideHeight']; ?>" maxlength="4" />
		<p><?php _e('Height of each slide (in px)', 'jquery-accordion-slideshow'); ?> Example: 150</p>
		
		<label for="tag-title"><?php _e('Speed', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_speed" type="text" id="JaS_speed" value="1200" maxlength="4" />
		<p><?php _e('Speed of the slide transition (in ms)', 'jquery-accordion-slideshow'); ?> Example: 1200 </p>
		
		<label for="tag-title"><?php _e('Tab Width', 'jquery-accordion-slideshow'); ?></label>
		<input name="JaS_tabWidth" type="text" id="JaS_tabWidth" value="25" maxlength="4" />
		<p><?php _e('Width of each slides TAB (when clicked it opens the slide)', 'jquery-accordion-slideshow'); ?> Example: 25</p>
		
		<label for="tag-title"><?php _e('Pause', 'jquery-accordion-slideshow'); ?></label>
		<select name="JaS_pause" id="JaS_pause">
			<option value='true'>true</option>
			<option value='false'>false</option>
		</select>
		<p><?php _e('Pause on hover.', 'jquery-accordion-slideshow'); ?></p>
		
		<label for="tag-title"><?php _e('Trigger', 'jquery-accordion-slideshow'); ?></label>
		<select name="JaS_trigger" id="JaS_trigger">
            <option value='click'>click</option>
            <option value='mouseover'>mouseover</option>
		</select>
		<p><?php _e('Event type that will bind to the "tab"', 'jquery-accordion-slideshow'); ?> (click, mouseover, etc.)</p>
		
		<label for="tag-title"><?php _e('Invert', 'jquery-accordion-slideshow'); ?></label>
		<select name="JaS_invert" id="JaS_invert">
			<option value='true'>true</option>
			<option value='false'>false</option>
		</select>
		<p><?php _e('Whether or not to invert the slideshow, so the last slide stays in the same position, rather than the first slide', 'jquery-accordion-slideshow'); ?></p>
		
		<label for="tag-title"><?php _e('Random', 'jquery-accordion-slideshow'); ?></label>
		<select name="JaS_Random" id="JaS_Random">
            <option value='YES'>YES</option>
            <option value='NO'>NO</option>
          </select>
		<p><?php _e('Do you want to display images in random order?', 'jquery-accordion-slideshow'); ?></p>
	  
	  <input name="JaS_easing" id="JaS_easing" type="hidden" value="null">
      <input name="JaS_id" id="JaS_id" type="hidden" value="<?php echo $form['JaS_id']; ?>">
      <input type="hidden" name="JaS_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Insert Details', 'jquery-accordion-slideshow'); ?>" type="submit" />&nbsp;
        <input name="publish" lang="publish" class="button add-new-h2" onclick="JaS_redirect()" value="<?php _e('Cancel', 'jquery-accordion-slideshow'); ?>" type="button" />&nbsp;
        <input name="Help" lang="publish" class="button add-new-h2" onclick="JaS_help()" value="<?php _e('Help', 'jquery-accordion-slideshow'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('JaS_form_add'); ?>
    </form>
</div>
</div>