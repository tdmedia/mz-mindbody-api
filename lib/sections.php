<?php
add_action ('admin_menu', 'mz_mindbody_settings_menu');

	function mz_mindbody_settings_menu() {
		//create submenu under Settings
		add_options_page ('MZ Mindbody Settings', esc_attr__('MZ Mindbody', 'mz-mindbody-api'),
		'manage_options', __FILE__, 'mz_mindbody_settings_page');
	}

	function mz_mindbody_settings_page() {
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<form action="options.php" method="post">
				<?php settings_fields('mz_mindbody_options'); ?>
				<?php do_settings_sections('mz_mindbody'); ?>
				<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
			</form>
		</div>
		<?php
	}

	// Register and define the settings
	add_action('admin_init', 'mz_mindbody_admin_init');

	function mz_mindbody_admin_init(){
		register_setting(
			'mz_mindbody_options',
			'mz_mindbody_options',
			'mz_mindbody_validate_options'
		);

		add_settings_section(
			'mz_mindbody_server',
			'MZ Mindbody Server',
			'mz_mindbody_server_check',
			'mz_mindbody'
		);
		
		add_settings_section(
			'mz_mindbody_section2_text',
			__('', 'mz_mindbody_api'),
			'mz_mindbody_section2_text',
			'mz_mindbody'
		);
		
		add_settings_section(
			'mz_mindbody_section4_text',
			__('', 'mz_mindbody_api'),
			'mz_mindbody_section4_text',
			'mz_mindbody'
		);
		
		add_settings_section(
			'mz_mindbody_main',
			__('MZ Mindbody Credentials', 'mz-mindbody-api'),
			'mz_mindbody_section_text',
			'mz_mindbody'
		);

		
		add_settings_field(
			'mz_mindbody_source_name',
			__('Source Name: ', 'mz-mindbody-api'),
			'mz_mindbody_source_name',
			'mz_mindbody',
			'mz_mindbody_main'
		);

		add_settings_field(
			'mz_mindbody_password',
			__('Key: ', 'mz-mindbody-api'),
			'mz_mindbody_password',
			'mz_mindbody',
			'mz_mindbody_main'
		);

		add_settings_field(
			'mz_mindbody_siteID',
			__('Site ID: ', 'mz-mindbody-api'),
			'mz_mindbody_siteID',
			'mz_mindbody',
			'mz_mindbody_main'
		);

		add_settings_field(
			'mz_mindbody_eventID',
			__('Event IDs: ', 'mz-mindbody-api'),
			'mz_mindbody_eventID',
			'mz_mindbody',
			'mz_mindbody_main'
		);
		
		add_settings_section(
			'mz_mindbody_section3_text',
			__('', 'mz-mindbody-api'),
			'mz_mindbody_section3_text',
			'mz_mindbody'
		);

		add_settings_field(
			'mz_mindbody_clear_cache',
			__('Force Cache Reset ', 'mz-mindbody-api'),
			'mz_mindbody_clear_cache',
			'mz_mindbody',
			'mz_mindbody_main'
		);

		add_settings_section(
			'mz_mindbody_secondary',
			__('Debug', 'mz-mindbody-api'),
			'mz_mindbody_debug_text',
			'mz_mindbody'
		);
	}

	// Draw the section header
	function mz_mindbody_server_check() {
		$mz_requirements = 0;
		require_once 'System.php';

		if (extension_loaded('soap'))
		{
			_e( 'SOAP installed! ', 'mz-mindbody-api');
		}
		else
		{
		   _e('SOAP is not installed. ', 'mz-mindbody-api');
		   $mz_requirements = 1;
		}

		if (class_exists('System')===true)
		{
		   _e('PEAR installed! ', 'mz-mindbody-api');
		}
		else
		{
		   _e('PEAR is not installed. ', 'mz-mindbody-api');
		   $mz_requirements = 1;
		}

		if ($mz_requirements == 1)
		{
			echo '<div class="settings-error" style="max-width:60%"><p>';
			_e('MZ Mindbody API requires SOAP and PEAR. Please contact your hosting provider or enable via your CPANEL of php.ini file.', 'mz-mindbody-api');
			echo '</p></div>';
		}
		else
		{
			
			echo '<div class="updated" style="max-width:60%"><p>';
			_e('Congratulations. Your server appears to be configured to integrate with mindbodyonline.', 'mz-mindbody-api');
			echo '</p></div>';
		}
	}

	function mz_mindbody_section_text() { ?>
		<div style="max-width:60%">
		<p><?php _e('Enter your mindbody credentials below.', 'mz-mindbody-api') ?></p>
		<p><?php printf(__('If you do not have them yet, visit the %1$s MindBodyOnline developers website %2$s 
		and register for developer credentials.', 'mz-mindbody-api'),
		 '<a href="https://api.mindbodyonline.com/Home/LogIn">', '</a>')?>
		(<a href="http://www.mzoo.org/creating-your-mindbody-credentials/"><?php _e('Detailed instructions here', 'mz-mindbody-api') ?></a>.)</p>
		<p><?php _e('Add to page or post with shortcode: [mz-mindbody-show-schedule], [mz-mindbody-show-events], [mz-mindbody-staff-list], [mz-mindbody-show-schedule type=day location=1]', 'mz-mindbody-api') ?> </p>
		<p> <?php _e('Parameter "account" can be added to any of the above shortcodes like:  [shortcode account=-99] to call from a different MBO business account. 
		(-99 is the MBO <em>sandbox</em> account)', 'mz-mindbody-api')?></font></p>
		<p><?php _e('Advanced version offers some new shortcodes: [mz-mindbody-login], [mz-mindbody-logout], [mz-mindbody-signup]', 'mz-mindbody-api') ?></p>
		<p><?php _e('In order for these to work correctly, the permalinks for those pages need to be: <em>login</em>, <em>logout</em> and <em>create-account</em>', 'mz-mindbody-api')?>

		</div>
	<?php
	
	}

	function mz_mindbody_section2_text() {
	?><div style="float:right;width:150px;background:#CCCCFF;padding:5px 20px 20px 20px;margin-left:20px;margin-bottom:8px;">
	<h4><?php _e('Contact', 'mz-mindbody-api')?></h4>
	<p><a href="http://www.mzoo.org">www.mzoo.org</a></p>
	<p><div class="dashicons dashicons-email-alt" alt="f466"></div> 
	<?php printf(__('welcome, but please also post in the %1$s support forum %2$s for the benefit of others.', 'mz-mindbody-api'),
	'<a href="https://wordpress.org/support/plugin/mz-mindbody-api">', '</a>')?></p>
	<p><div class="dashicons dashicons-heart" alt="f487" style="color:red;"></div>
	<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=A95ZEELLHGECE" target="_blank">
	<?php printf(__('Small donations %1$s and %2$s reviews %3$s welcome.'),
	'</a>', '<a href="https://wordpress.org/support/view/plugin-reviews/mz-mindbody-api">','</a>'); ?> </p>

	</div>
	<br style='clear:right;'/>
	<?php
	}
	
	function mz_mindbody_section4_text() {
	?><div style="float:right;width:150px;background:#CCCCFF;padding:5px 20px 20px 20px;margin-left:20px;">
	<h4><i class="dashicons dashicons-megaphone" alt="f488" style="max-width:90%"></i> <?php _e('News', 'mz-mindbody-api')?></h4>
	<p><?php _e('Now supports multiple locations and MBO accounts.', 'mz-mindbody-api')?><p>
	<hr/>
	<h4><?php _e("Customization requests invited, and there's an ADVANCED VERSION of the plugin which integrates MBO class registration without leaving the WP site.", 'mz-mindbody-api')?>
	</h4>
	</div>
	<?php
	}
	
		add_action( 'wp_footer', 'mz_mindbody_debug_text' );
	function mz_mindbody_debug_text() {
	  require_once MZ_MINDBODY_SCHEDULE_DIR .'mindbody-php-api/MB_API.php';
	  require_once MZ_MINDBODY_SCHEDULE_DIR .'inc/mz_mbo_init.inc';
	  echo "<p>";
	  printf(__('Once credentials have been set and activated, look for %1$s in the 
	  GetClassesResponse box below to confirm settings are correct.'),
	  '<code>&lt;ErrorCode&gt;200&lt;/ErrorCode&gt;</code>');
	  echo "</p>";
	  $mz_timeframe = array_slice(mz_getDateRange(date_i18n('Y-m-d'), 1), 0, 1);
	  $test = $mb->GetClasses($mz_timeframe);
	  $mb->debug();
	  echo "<br/>";
	}

	// Display and fill the form field
	function mz_mindbody_source_name() {
		// get option 'mz_source_name' value from the database
		$options = get_option( 'mz_mindbody_options',__('Option Not Set') );
		$mz_source_name = (isset($options['mz_source_name'])) ? $options['mz_source_name'] : _e('YOUR SOURCE NAME');
		// echo the field
		echo "<input id='mz_source_name' name='mz_mindbody_options[mz_source_name]' type='text' value='$mz_source_name' />";
	}

	// Display and fill the form field
	function mz_mindbody_password() {
		$options = get_option( 'mz_mindbody_options',__('Option Not Set') );
		$mz_mindbody_password = (isset($options['mz_mindbody_password'])) ? $options['mz_mindbody_password'] : _e('YOUR MINDBODY PASSWORD');
		// echo the field
		echo "<input id='mz_mindbody_password' name='mz_mindbody_options[mz_mindbody_password]' type='text' value='$mz_mindbody_password' />";
	}

	// Display and fill the form field
	function mz_mindbody_siteID() {
		// get option 'text_string' value from the database
		$options = get_option( 'mz_mindbody_options',__('Option Not Set') );
		$mz_mindbody_siteID = (isset($options['mz_mindbody_siteID'])) ? $options['mz_mindbody_siteID'] : _e('YOUR SITE ID');
		// echo the field
		echo "<input id='mz_mindbody_siteID' name='mz_mindbody_options[mz_mindbody_siteID]' type='text' value='$mz_mindbody_siteID' />";
	}

	// Display and fill the form field
	function mz_mindbody_eventID() {
		// get option 'text_string' value from the database
		$options = get_option( 'mz_mindbody_options',__('Option Not Set') );
		$mz_mindbody_eventID = (isset($options['mz_mindbody_eventID'])) ? $options['mz_mindbody_eventID'] : _e('Event Category IDs');
		// echo the field
		echo "<input id='mz_mindbody_eventID' name='mz_mindbody_options[mz_mindbody_eventID]' type='text' value='$mz_mindbody_eventID' />  eg: 25,17";
	}

	function mz_mindbody_section3_text() {
		echo "Having this checked will allow you to see immediate changes in MBO, ";
		echo "<br/>";
		echo "but may end up costing more in API transfer fees.";
		echo "<br/>";
		echo "Class calendar cache is held for 1 day. Event calendar for 1 hour.";
		}
		
	// Display and fill the cache reset form field
	function mz_mindbody_clear_cache() {
		$options = get_option( 'mz_mindbody_options','Option Not Set' );
		printf(
	    '<input id="%1$s" name="mz_mindbody_options[%1$s]" type="checkbox" %2$s />',
	    'mz_mindbody_clear_cache',
	    checked( isset($options['mz_mindbody_clear_cache']) , true, false )
		);
	}

	// Validate user input (we want text only)
	function mz_mindbody_validate_options( $input ) {
	    foreach ($input as $key => $value)
	    {
				$valid[$key] = wp_strip_all_tags(preg_replace( '/\s/', '', $input[$key] ));
				if( $valid[$key] != $input[$key] )
				{
					add_settings_error(
						'mz_mindbody_text_string',
						'mz_mindbody_texterror',
						'Does not appear to be valid ',
						'error'
					);
				}
			}

		return $valid;
	}
?>