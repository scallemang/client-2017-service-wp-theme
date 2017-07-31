<?php
if(!class_exists('Teledent_Settings'))
{
	class Teledent_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('teledent-group', 'api_gmap_key');

        	// add your settings section
            add_settings_section(
                'teledent-section',
                'API Keys Settings',
                array(&$this, 'settings_section_teledent'),
                'teledent'
            );

            add_settings_field(
                'teledent-api_gmap_key',
                'Google Map API Key',
                array(&$this, 'settings_field_input_text'),
                'teledent',
                'teledent-section',
                array(
                    'field' => 'api_gmap_key'
                )
            );

            // Possibly do additional admin_init tasks
        } // END public static function activate

        public function settings_section_teledent()
        {
            // Think of this as help text for the section.
            echo 'More settings to be established as needed for project';
        }

        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)

        /**
         * add a menu
         */
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Teledent Settings',
        	    'Teledent',
        	    'manage_options',
        	    'teledent',
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()

        /**
         * Menu Callback
         */
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}

        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class Teledent_Settings
} // END if(!class_exists('Teledent_Settings'))
