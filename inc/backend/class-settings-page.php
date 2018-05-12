<?php

namespace MZ_Mindbody\Inc\Backend;

use MZ_Mindbody\Inc\Core as Core;
use MZ_Mindbody\Inc\Common as Common;
use MZ_Mindbody\Inc\Libraries as Libraries;

/**
 * This file contains the class which holds all the actions and methods to create the admin dashboard sections
 *
 * This file contains all the actions and functions to create the admin dashboard sections.
 * It should probably be refactored to use oop approach at least for the sake of consistency.
 *
 * @since 2.1.0
 *
 * @package MZ_Mindbody
 * 
 */
 /**
 * Actions/Filters
 *
 * Related to all settings API.
 *
 * @since  1.0.0
 */
 
 class Settings_Page {
 	
 	static protected $wposa_obj;
 
 	public function __construct() {
		self::$wposa_obj = new Libraries\WP_OSA();
	}
	
	public function addSections() {
	
		// Section: Basic Settings.
		self::$wposa_obj->add_section(
			array(
				'id'    => 'mz_mbo_basic',
				'title' => __( 'Basic Settings', 'mz-mindbody-api' ),
			)
		);

		// Section: Shortcodes.
		self::$wposa_obj->add_section(
			array(
				'id'    => 'mz_mbo_shortcodes',
				'title' => __( 'Shortcodes', 'mz-mindbody-api' ),
			)
		);

		// Section: Default Settings.
		self::$wposa_obj->add_section(
			array(
				'id'    => 'mz_mbo_events',
				'title' => __( 'Events', 'mz-mindbody-api' ),
			)
		);
		
		// Field: Server Check HTML.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'server_check',
				'type'    => 'html',
				'name'    => __( 'Server Check', 'mz-mindbody-api' ),
				'desc'    => $this->server_check()
			)
		);
		
		// Field: Credentials Intro HTML.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'credentials_intro',
				'type'    => 'html',
				'name'    => __( 'Enter your mindbody credentials below.', 'mz-mindbody-api' ),
				'desc'    => $this->credentials_intro()
			)
		);

		// Field: Source Name.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'mz_source_name',
				'type'    => 'text',
				'name'    => __( 'Source Name', 'mz-mindbody-api' ),
				'desc'    => 'MBO Developer Source Name',
				'default' => __('YOUR SOURCE NAME', 'mz-mindbody-api')
			)
		);

		// Field: Password.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'mz_mindbody_password',
				'type'    => 'password',
				'name'    => __( 'Password', 'mz-mindbody-api' ),
				'desc'    => 'MBO Developer Password',
				'default' => __('YOUR MINDBODY PASSWORD', 'mz-mindbody-api')
			)
		);

		// Field: Primary MBO Site ID.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'mz_mindbody_siteID',
				'type'    => 'number',
				'name'    => __( 'Primary (default) MBO Site ID', 'mz-mindbody-api' ),
				'desc'    => 'MBO Site ID (-99 is the sandbox account for testing)',
				'default' => __('-99', 'mz-mindbody-api')
			)
		);
		
		// Field: Event IDs.
		self::$wposa_obj->add_field(
			'mz_mbo_events',
			array(
				'id'      => 'mz_mindbody_eventID',
				'type'    => 'text',
				'name'    => __( 'Event IDs', 'mz-mindbody-api' ),
				'desc'    => 'Event Type IDs to return',
				'default' => __('12345, 34, 64', 'mz-mindbody-api')
			)
		);
		
		// Field: Events Duration Display.
		self::$wposa_obj->add_field(
			'mz_mbo_events',
			array(
				'id'      => 'mz_mindbody_eventsDuration',
				'type'    => 'text',
				'name'    => __( 'Event Display Duration', 'mz-mindbody-api' ),
				'desc'    => 'How many days from today to display events for',
				'default' => __('60', 'mz-mindbody-api')
			)
		);

		// Field: Separator.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'   => 'separator',
				'type' => 'separator',
			)
		);


		// Field: Title.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'   => 'credentials_test',
				'type' => 'title',
				'name' => '<h1>Credentials Test</h1>',
			)
		);
		
		// Field: Credentials Test Intro HTML.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'credentials_test_intro',
				'type'    => 'html',
				'name'    => __( 'Test MBO credentials.', 'mz-mindbody-api' ),
				'desc'    => $this->credentials_test_intro()
			)
		);


		// Field: Textarea.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'   => 'credentials_test',
				'type' => 'html',
				'name' => __( 'Debug Output', 'mz-mindbody-api' ),
				'desc' => $this->mz_mindbody_debug_text()
			)
		);
		

		// Field: Checkbox.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'   => 'checkbox',
				'type' => 'checkbox',
				'name' => __( 'Checkbox', 'mz-mindbody-api' ),
				'desc' => __( 'Checkbox Label', 'mz-mindbody-api' ),
			)
		);

		// Field: Radio.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'radio',
				'type'    => 'radio',
				'name'    => __( 'Radio', 'mz-mindbody-api' ),
				'desc'    => __( 'Radio Button', 'mz-mindbody-api' ),
				'options' => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
			)
		);

		// Field: Multicheck.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'multicheck',
				'type'    => 'multicheck',
				'name'    => __( 'Multile checkbox', 'mz-mindbody-api' ),
				'desc'    => __( 'Multile checkbox description', 'mz-mindbody-api' ),
				'options' => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
			)
		);

		// Field: Select.
		self::$wposa_obj->add_field(
			'mz_mbo_basic',
			array(
				'id'      => 'select',
				'type'    => 'select',
				'name'    => __( 'A Dropdown', 'mz-mindbody-api' ),
				'desc'    => __( 'A Dropdown description', 'mz-mindbody-api' ),
				'options' => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
			)
		);

		// Field: Schedule Codes.
		self::$wposa_obj->add_field(
			'mz_mbo_shortcodes',
			array(
				'id'      => 'schedule_codes',
				'type'    => 'html',
				'name'    => __( 'Schedule Display', 'mz-mindbody-api' ),
				'desc'    => $this->schedule_codes()
			)
		);
		
		// Field: Staff Codes.
		self::$wposa_obj->add_field(
			'mz_mbo_shortcodes',
			array(
				'id'      => 'staff_codes',
				'type'    => 'html',
				'name'    => __( 'Staff Display', 'mz-mindbody-api' ),
				'desc'    => $this->staff_codes()
			)
		);
	
	}
	
	private function server_check() {
	
		$return = '';
		$mz_requirements = 0;
		
		include 'PEAR/Registry.php';

		$reg = new \PEAR_Registry;

		if (extension_loaded('soap'))
		{
			$return .= __('SOAP installed! ', 'mz-mindbody-api');
		}
		else
		{
			$return .= __('SOAP is not installed. ', 'mz-mindbody-api');
			$mz_requirements = 1;
		}
		$return .=  '&nbsp;';
		
		if (class_exists('System')===true)
		{
		   $return .= __('PEAR installed! ', 'mz-mindbody-api');
		}
		else
		{
		   $return .= __('PEAR is not installed. ', 'mz-mindbody-api');
		   $mz_requirements = 1;
		}

		if ($mz_requirements == 1)
		{

			$return .=  '<div class="settings-error"><p>';
			$return .= __('MZ Mindbody API requires SOAP and PEAR. Please contact your hosting provider or enable via your CPANEL of php.ini file.', 'mz-mindbody-api');
			$return .=  '</p></div>';
		}
		else
		{
			
			$return .=  '<div class="" ><p>';
			$return .= __('Congratulations. Your server appears to be configured to integrate with mindbodyonline.', 'mz-mindbody-api');
			$return .=  '</p></div>';
		}
		return $return;
	}
	
	private function credentials_intro(){
		$return = '';
		$return .= '</p>'.sprintf(__('If you do not have them yet, visit the %1$s MindBodyOnline developers website %2$s and register for developer credentials.', 'mz-mindbody-api'),
							'<a href="https://api.mindbodyonline.com/Home/LogIn">', 
							'</a>').'</p>';
		$return .= '(<a href="http://www.mzoo.org/creating-your-mindbody-credentials/">'. __('Detailed instructions here', 'mz-mindbody-api').'</a>.)';
		return $return;
	}
	
	private function schedule_codes(){
		$return = '';
		$return .= "<p>['mz-mindbody-show-schedule']</p>";
		$return .= "<p>".__('Attributes for schedule shortcodes. For boolean attributes use numeral 1 for true. Lists should be separated with commas', 'mz-miindbody-api').".</p>";
		$return .= "<ul>";
		$return .= "<li><strong>type</strong>: " . __("'week' or 'day'. Defaults to 'week'", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>locations</strong>: " . __("(numeric) List of IDs of MBO locations to display", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>account</strong>: " . __("(numeric) Which MBO account to display schedule for", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>filter</strong>: " . __("(boolean) Option to show a filter by class type, teacher.", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>grid</strong>: " . __("(boolean) Display schedule in grid format as opposed to list", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>advanced</strong>: " . __("(boolean) Allow users to sign in directory from wordpress site", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>hide</strong>: " . __("Remove any of following from display: teacher, signup, duration", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>class_types</strong>: " . __("List of MBO-registered class types to display", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>show_registrants</strong>: " . __("(boolean) If true, modal pop-up window will display registrants of class", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>hide_cancelled</strong>: " . __("(boolean) True will hide cancelled classes", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>registrants_count</strong>: " . __("(boolean) Display number of registrants in class", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>mode_select</strong>: " . __("(boolean) Allow user to select between grid and list view", 'mz-mindbody-api')."</li>";
		$return .= "<li><strong>unlink</strong>: " . __(" ", 'mz-mindbody-api')."</li>";
		$return .= "</ul>";

		$return .= sprintf('<p>%1$s: [%2$s %3$s=%4$s %5$s="1, 2" %6$s=-99 %7$s="Meditation, Hot Yoga"]</p>',
		'Examples',
		'mz-mindbody-show-schedule', 'type', 'day', 'locations', 'account', 'class_types');
		$return .= __('Grid and Filter can be added like this:', 'mz-mindbody-api').'<br/>';
		$return .= sprintf(' [%1$s %2$s=1 %3$s=1]',
							'mz-mindbody-show-schedule', 'grid', 'filter');
		return $return;
	}
	
	private function staff_codes(){
		$return = '';
		$return .= '<p>'.sprintf('[%1$s]', 'mz-mindbody-staff-list').'</p>';
		$return .= __('To display staff page as a responsive gallery of images with pop-up biographies, use ', 'mz-mindbody-api');
		$return .= sprintf('[%1$s %2$s]<br/>', 'mz-mindbody-staff-list', 'gallery=1');
		return $return;
	}
	
	
	private function credentials_test_intro(){
		$return = sprintf(__('Once credentials have been set and activated, look for %1$s in the 
	  GetClassesResponse box below to confirm settings are correct.',  'mz-mindbody-api'),
	  '<code>&lt;ErrorCode&gt;200&lt;/ErrorCode&gt;</code>');
		return $return;
	}
	
	private function mz_mindbody_debug_text() {
	  $mz_timeframe = array_slice(Common\Schedule_Operations::mz_getDateRange(date_i18n('Y-m-d'), 1), 0, 1);
	  $mb = Core\MBO_Init::instantiate_mbo_API();
	  $test = $mb->GetClasses($mz_timeframe);
	  return $mb->debug();
	}

}