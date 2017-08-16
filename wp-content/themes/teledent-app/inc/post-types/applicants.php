<?php
if(!class_exists('Post_Type_Applicant'))
{
    /**
     * A PostTypeTemplate class that provides 3 additional meta fields
     */
    class Post_Type_Applicant
    {
        const POST_TYPE = "applicant";
        private $_meta  = array(
            'applicant_name',
            'applicant_postal',
            'applicant_phone',
            'applicant_email',
            'applicant_lat',
            'applicant_lng',
        );

        /**
         * The Constructor
         */
        public function __construct()
        {
            // register actions
            add_action('init', array(&$this, 'init'));
            add_action('admin_init', array(&$this, 'admin_init'));

        } // END public function __construct()

        /**
         * hook into WP's init action hook
         */
        public function init()
        {
            // Initialize Post Type
            $this->create_post_type();
            add_action('save_post', array(&$this, 'save_post'));
        } // END public function init()

        /**
         * Create the post type
         */
        public function create_post_type() {

            $labels = array(
                'name'               => _x( 'Applicants', 'post type general name' ),
                'singular_name'      => _x( 'Applicant', 'post type singular name' ),
                'add_new'            => _x( 'Add New', 'Applicant' ),
                'add_new_item'       => __( 'Add New Applicant' ),
                'edit_item'          => __( 'Edit Applicant' ),
                'new_item'           => __( 'New Applicant' ),
                'all_items'          => __( 'All Applicants' ),
                'view_item'          => __( 'View Applicant' ),
                'search_items'       => __( 'Search applicants' ),
                'not_found'          => __( 'No applicants found' ),
                'not_found_in_trash' => __( 'No applicants found in the Trash' ),
                'parent_item_colon'  => '',
                'menu_name'          => 'Applicants'
              );


            register_post_type(self::POST_TYPE,

                array(
                    'labels' => $labels,
                    'public' => true,
                    'has_archive' => true,
                    'description' => __("Displays applicants and their details"),
                    'supports' => array(
                        'title'
                    ),
                )
            );

            $post_types = array('applicant', 'office', 'order');

            function tax_jobTypes($post_types) {
                $tax_labels = array(
                    'name'              => _x( 'Job Types', 'taxonomy general name' ),
                    'singular_name'     => _x( 'Job Type', 'taxonomy singular name' ),
                    'search_items'      => __( 'Search Job Types' ),
                    'all_items'         => __( 'All Job Types' ),
                    'parent_item'       => __( 'Parent Job Type' ),
                    'parent_item_colon' => __( 'Parent Job Type:' ),
                    'edit_item'         => __( 'Edit Job Type' ),
                    'update_item'       => __( 'Update Job Type' ),
                    'add_new_item'      => __( 'Add New Job Type' ),
                    'new_item_name'     => __( 'New Job Type' ),
                    'menu_name'         => __( ' Job Types' ),
                  );

                $tax_args = array(
                    'labels' => $tax_labels,
                    'hierarchical' => true,
                );

                // create a new taxonomy
                register_taxonomy(
                    'job_category',
                    $post_types,
                    $tax_args
                );
            }

            function tax_postitionTypes($post_types) {
                $tax_labels = array(
                    'name'              => _x( 'Positions', 'taxonomy general name' ),
                    'singular_name'     => _x( 'Position', 'taxonomy singular name' ),
                    'search_items'      => __( 'Search Positions' ),
                    'all_items'         => __( 'All Positions' ),
                    'parent_item'       => __( 'Parent Position' ),
                    'parent_item_colon' => __( 'Parent Position:' ),
                    'edit_item'         => __( 'Edit Position' ),
                    'update_item'       => __( 'Update Position' ),
                    'add_new_item'      => __( 'Add New Position' ),
                    'new_item_name'     => __( 'New Position' ),
                    'menu_name'         => __( ' Positions' ),
                  );

                $tax_args = array(
                    'labels' => $tax_labels,
                    'hierarchical' => true,
                );

                // create a new taxonomy
                register_taxonomy(
                    'postitions_category',
                    $post_types,
                    $tax_args
                );
            }

            function tax_softwareTypes($post_types) {
                $tax_labels = array(
                    'name'              => _x( 'Software Skills', 'taxonomy general name' ),
                    'singular_name'     => _x( 'Software', 'taxonomy singular name' ),
                    'search_items'      => __( 'Search Software' ),
                    'all_items'         => __( 'All Software' ),
                    'parent_item'       => __( 'Parent Software' ),
                    'parent_item_colon' => __( 'Parent Software:' ),
                    'edit_item'         => __( 'Edit Software' ),
                    'update_item'       => __( 'Update Software' ),
                    'add_new_item'      => __( 'Add New Software' ),
                    'new_item_name'     => __( 'New Software' ),
                    'menu_name'         => __( ' Software' ),
                  );

                $tax_args = array(
                    'labels' => $tax_labels,
                    'hierarchical' => true,
                );

                // create a new taxonomy
                register_taxonomy(
                    'software_category',
                    $post_types,
                    $tax_args
                );
            }

            function tax_languages($post_types) {
                $tax_labels = array(
                    'name'              => _x( 'Languages', 'taxonomy general name' ),
                    'singular_name'     => _x( 'Language', 'taxonomy singular name' ),
                    'search_items'      => __( 'Search Language' ),
                    'all_items'         => __( 'All Language' ),
                    'parent_item'       => __( 'Parent Language' ),
                    'parent_item_colon' => __( 'Parent Language:' ),
                    'edit_item'         => __( 'Edit Language' ),
                    'update_item'       => __( 'Update Language' ),
                    'add_new_item'      => __( 'Add New Language' ),
                    'new_item_name'     => __( 'New Language' ),
                    'menu_name'         => __( ' Language' ),
                  );

                $tax_args = array(
                    'labels' => $tax_labels,
                    'hierarchical' => true,
                );

                // create a new taxonomy
                register_taxonomy(
                    'language_category',
                    $post_types,
                    $tax_args
                );
            }

            tax_jobTypes($post_types);

            tax_postitionTypes($post_types);

            tax_softwareTypes($post_types);

            tax_languages($post_types);


        }

        /**
         * Save the metaboxes for this custom post type
         */
        public function save_post($post_id)
        {
            // verify if this is an auto save routine.
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }

            if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
            {
                foreach($this->_meta as $field_name)
                {
                    // Update the post's meta field
                    update_post_meta($post_id, $field_name, $_POST[$field_name]);
                }
            }
            else
            {
                return;
            } // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
        } // END public function save_post($post_id)



        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
            // Add metaboxes
            //add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
        } // END public function admin_init()

        /**
         * hook into WP's add_meta_boxes action hook
         */
        public function add_meta_boxes()
        {
            // Add this metabox to every selected post
            add_meta_box(
                sprintf('wp_plugin_template_%s_section', self::POST_TYPE),
                sprintf('%s Information', ucwords(str_replace("_", " ", self::POST_TYPE))),
                array(&$this, 'add_inner_meta_boxes'),
                self::POST_TYPE
            );
        } // END public function add_meta_boxes()

        /**
         * called off of the add meta box
         */
        public function add_inner_meta_boxes($post)
        {
            // Render the job order metabox
            include(sprintf("applicant_metabox.php", dirname(__FILE__), self::POST_TYPE));
        } // END public function add_inner_meta_boxes($post)

    } // END class Post_Type_Applicant
} // END if(!class_exists('Post_Type_Applicant'))
