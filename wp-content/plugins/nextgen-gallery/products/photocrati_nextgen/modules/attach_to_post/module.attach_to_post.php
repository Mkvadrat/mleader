<?php

define('NGG_ATTACH_TO_POST_SLUG', 'nextgen-attach_to_post');

class M_Attach_To_Post extends C_Base_Module
{
	var $attach_to_post_tinymce_plugin  = 'NextGEN_AttachToPost';
    var $_event_publisher               = NULL;
    static $substitute_placeholders     = TRUE;

	/**
	 * Defines the module
	 * @param string|bool $context
	 */
    function define($id = 'pope-module',
                    $name = 'Pope Module',
                    $description = '',
                    $version = '',
                    $uri = '',
                    $author = '',
                    $author_uri = '',
                    $context = FALSE)
    {
        parent::define(
			'photocrati-attach_to_post',
			'Attach To Post',
			'Provides the "Attach to Post" interface for displaying galleries and albums',
			'0.18',
            'https://www.imagely.com/wordpress-gallery-plugin/nextgen-gallery/',
            'Imagely',
            'https://www.imagely.com',
		    $context
		);

		C_NextGen_Settings::get_instance()->add_option_handler('C_Attach_To_Post_Option_Handler', array(
			'attach_to_post_url',
			'gallery_preview_url',
			'attach_to_post_display_tab_js_url'
		));
        if (is_multisite()) C_NextGen_Global_Settings::get_instance()->add_option_handler('C_Attach_To_Post_Option_Handler', array(
            'attach_to_post_url',
            'gallery_preview_url',
            'attach_to_post_display_tab_js_url'
        ));

		C_Photocrati_Installer::add_handler($this->module_id, 'C_Attach_To_Post_Installer');
    }

    static function is_atp_url()
    {
        return (strpos(strtolower($_SERVER['REQUEST_URI']), NGG_ATTACH_TO_POST_SLUG) !== false) ? TRUE : FALSE;
    }

    /**
     * Gets the Frame Event Publisher
     * @return C_Component
     */
    function _get_frame_event_publisher()
    {
        if (is_null($this->_event_publisher)) {
            $this->_event_publisher = $this->get_registry()->get_utility('I_Frame_Event_Publisher', 'attach_to_post');
        }

        return $this->_event_publisher;
    }

	/**
	 * Registers requires the utilites that this module provides
	 */
	function _register_utilities()
	{
		// This utility provides a controller that renders the
		// Attach to Post interface, used to manage Displayed Galleries
		$this->get_registry()->add_utility(
			'I_Attach_To_Post_Controller',
			'C_Attach_Controller'
		);
	}

	/**
	 * Registers the adapters that this module provides
	 */
	function _register_adapters()
	{
		// Installs the Attach to Post module
		$this->get_registry()->add_adapter(
			'I_Installer', 'A_Attach_To_Post_Installer'
		);

		// Provides AJAX actions for the Attach To Post interface
		$this->get_registry()->add_adapter(
			'I_Ajax_Controller',   'A_Attach_To_Post_Ajax'
		);

		// Applies a post hook to the generate_thumbnail method of the
		// gallery storage component
		$this->get_registry()->add_adapter(
			'I_Gallery_Storage', 'A_Gallery_Storage_Frame_Event'
		);
	}

	function does_request_require_frame_communication()
	{
		return (strpos($_SERVER['REQUEST_URI'], 'attach_to_post') !== FALSE OR (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'attach_to_post') !== FALSE) OR array_key_exists('attach_to_post', $_REQUEST));
	}

<<<<<<< HEAD
	function disable_resource_manager($retval)
	{
		if (isset($_REQUEST[NGG_ATTACH_TO_POST_SLUG])) $retval = FALSE;
		return $retval;
	}
=======
>>>>>>> aedd11f9c43d222f1ceddef3f64c520a14f82793

	function _register_hooks()
	{
        add_action('ngg_routes',                      array(&$this, 'define_routes'), 2);

        // We use two hooks here because we need it to execute for both the post-new.php
        // page and ATP interface
        add_action('plugins_loaded',        array($this, 'fix_ie11'), 1);
        add_action('admin_init',            array($this, 'fix_ie11'), PHP_INT_MAX-1);
        add_action('admin_enqueue_scripts', array($this, 'fix_ie11'), 1);
        add_action('admin_enqueue_scripts', array($this, 'fix_ie11'), PHP_INT_MAX-1);

        add_filter('wpseo_opengraph_image',   array($this, 'hide_preview_image_from_yoast'));
        add_filter('wpseo_twitter_image',     array($this, 'hide_preview_image_from_yoast'));
        add_filter('wpseo_sitemap_urlimages', array($this, 'remove_preview_images_from_yoast_sitemap'), NULL, 2);

        // Emit frame communication events
		if ($this->does_request_require_frame_communication()) {
			add_action('ngg_created_new_gallery',	array(&$this, 'new_gallery_event'));
			add_action('ngg_after_new_images_added',array(&$this, 'images_added_event'));
			add_action('ngg_page_event',			array(&$this, 'nextgen_page_event'));
			add_action('ngg_manage_tags',           array(&$this, 'manage_tags_event'));
		}

		// Admin-only hooks
		if (is_admin()) {
			add_action(
				'admin_enqueue_scripts',
				array(&$this, 'enqueue_static_resources'),
				1
			);

			add_action('admin_init', array(&$this, 'route_insert_gallery_window'));

			add_action('media_buttons', array($this, 'add_media_button'), 15);
			add_action('admin_init', array($this, 'enqueue_tinymce_plugin_css'));
			add_action('admin_print_scripts', array(&$this, 'print_tinymce_placeholder_template'));
		}

		// Frontend-only hooks
		if (!is_admin()) {
		// Add hook to subsitute displayed gallery placeholders
			add_filter('the_content', array(&$this, 'substitute_placeholder_imgs'), PHP_INT_MAX, 1);
		}
	}

	/**
	 * Renders the underscore template used by TinyMCE for IGW placeholders
	 */
	function print_tinymce_placeholder_template()
	{
		readfile(C_Fs::get_instance()->join_paths(
			$this->get_registry()->get_module_dir('photocrati-attach_to_post'),
			'templates',
			'tinymce_placeholder.php'
		));
	}

	/**
	 * Enqueues the CSS needed to style the IGW placeholders
	 */
	function enqueue_tinymce_plugin_css()
	{
		add_editor_style('https://fonts.googleapis.com/css?family=Lato');
		add_editor_style(C_Router::get_instance()->get_static_url('photocrati-attach_to_post#ngg_attach_to_post_tinymce_plugin.css'));
	}

    /**
     * Prevents ATP preview image placeholders from being used as opengraph / twitter metadata
     *
     * @param string $image
     * @return null|string
     */
	function hide_preview_image_from_yoast($image)
    {
        if (strpos($image, NGG_ATTACH_TO_POST_SLUG) !== FALSE)
            return null;
        return $image;
    }

	/**
	 * Removes IGW preview/placeholder images from Yoast's sitemap
	 * @param $images
	 * @param $post_id
	 * @return array
	 */
	function remove_preview_images_from_yoast_sitemap($images, $post_id)
	{
		$retval = array();

		foreach ($images as $image) {
			if (strpos($image['src'], NGG_ATTACH_TO_POST_SLUG) === FALSE) {
				$retval[] = $image;
			}
			else {
				// Lookup images for the displayed gallery
				if (preg_match('/(\d+)$/', $image['src'], $match)) {
					$displayed_gallery_id = $match[1];
					$mapper = C_Displayed_Gallery_Mapper::get_instance();
					$displayed_gallery = $mapper->find($displayed_gallery_id, TRUE);
					if ($displayed_gallery) {
						$gallery_storage = C_Gallery_Storage::get_instance();
						$settings		 = C_NextGen_Settings::get_instance();
						$source_obj = $displayed_gallery->get_source();
						if (in_array('image', $source_obj->returns)) {
							foreach ($displayed_gallery->get_entities() as $image) {
								$named_image_size = $settings->imgAutoResize ? 'full' : 'thumb';

								$sitemap_image = array(
									'src'	=>	$gallery_storage->get_image_url($image, $named_image_size),
									'alt'	=>	$image->alttext,
									'title'	=>	$image->description ? $image->description: $image->alttext
								);
								$retval[] = $sitemap_image;
							}
						}
					}

				}
			}
		}

		return $retval;
	}

	/**
	 * In 2.0.66.X and earlier, ATP placeholder images used a different url than
	 * what 2.0.69 uses. Therefore, we need to convert those
	 * @param string $content
	 * @return string
	 */
	function fix_preview_images($content)
	{
		$content = str_replace(
			site_url('/'.NGG_ATTACH_TO_POST_SLUG.'/preview/id--'),
			admin_url('/?'.NGG_ATTACH_TO_POST_SLUG.'='.NGG_ATTACH_TO_POST_SLUG.'/preview/id--'),
			$content
		);

		$content = str_replace(
			site_url('/index.php/'.NGG_ATTACH_TO_POST_SLUG.'/preview/id--'),
			admin_url('/?'.NGG_ATTACH_TO_POST_SLUG.'='.NGG_ATTACH_TO_POST_SLUG.'/preview/id--'),
			$content
		);

		return $content;
	}
	
	function add_media_button()
	{
        $security  = $this->get_registry()->get_utility('I_Security_Manager');
        $sec_actor = $security->get_current_actor();
        if (in_array(FALSE, array(
            $sec_actor->is_allowed('NextGEN Attach Interface'),
            $sec_actor->is_allowed('NextGEN Use TinyMCE'))))
            return;

		$router = C_Router::get_instance();
		$button_url = $router->get_static_url('photocrati-attach_to_post#atp_button.png');
		$label		= __('Add Gallery', 'nggallery');
		$igw_url    = admin_url('/?'.NGG_ATTACH_TO_POST_SLUG.'=1&KeepThis=true&TB_iframe=true&height=600&width=1000');

		echo sprintf('<a href="%s" data-editor="content" class="button ngg-add-gallery thickbox" id="ngg-media-button" class="button" ><img src="%s" style="padding:0; margin-top:-3px;">%s</a>', $igw_url, $button_url, $label);
	}

	/**
	* Route the IGW requests using wp-admin
	* @throws E_Clean_Exit
	*/
    function route_insert_gallery_window()
    {
        if (isset($_REQUEST[NGG_ATTACH_TO_POST_SLUG])) {
	        $controller = C_Attach_Controller::get_instance();
	        if ($_REQUEST[NGG_ATTACH_TO_POST_SLUG] == 'js') {
		        $controller->display_tab_js_action();
	        }
	        elseif (strpos($_REQUEST[NGG_ATTACH_TO_POST_SLUG], '/preview') !== FALSE) {
		        $controller->preview_action();
	        }
	        else {
		        $controller->index_action();
	        }

            throw new E_Clean_Exit;
        }
    }

	/**
	 * @param C_Router $router
	 */
    function define_routes($router)
    {
        $app = $router->create_app('/'.NGG_ATTACH_TO_POST_SLUG);
        $app->rewrite('/preview/{id}',			'/preview/id--{id}');
        $app->rewrite('/display_tab_js/{id}',	'/display_tab_js/id--{id}');
        $app->route('/preview',			'I_Attach_To_Post_Controller#preview');
        $app->route('/display_tab_js',	'I_Attach_To_Post_Controller#display_tab_js');
        $app->route('/',				'I_Attach_To_Post_Controller#index');
    }

    /**
     * WordPress sets the X-UA-Compatible header to IE=edge. Unfortunately, this causes problems with Plupload,
     * so we have the send this header
     */
    function fix_ie11()
    {
        if ((array_search('attach_to_post', array_keys($_REQUEST)) !== FALSE OR strpos($_SERVER['REQUEST_URI'], NGG_ATTACH_TO_POST_SLUG) !== FALSE OR strpos($_SERVER['REQUEST_URI'], 'wp-admin/post.php') !== FALSE OR strpos($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') !== FALSE)) {
            if (!headers_sent()) {
                header('X-UA-Compatible: IE=EmulateIE10');
            }
        }
    }

	/**
     * Substitutes the gallery placeholder content with the gallery type frontend
     * view, returns a list of static resources that need to be loaded
     * @param string $content
     */
    function substitute_placeholder_imgs($content)
    {
	    $content = $this->fix_preview_images($content);

	    // To match ATP entries we compare the stored url against a generic path; entries MUST have a gallery ID
		if (preg_match_all("#<img.*http(s)?://(.*)?".NGG_ATTACH_TO_POST_SLUG."(=|/)preview(/|&|&amp;)id(=|--)(\\d+).*?>#mi", $content, $matches, PREG_SET_ORDER)) {

            $mapper = C_Displayed_Gallery_Mapper::get_instance();
			foreach ($matches as $match) {
				// Find the displayed gallery
				$displayed_gallery_id = $match[6];
				$displayed_gallery = $mapper->find($displayed_gallery_id, TRUE);

				// Get the content for the displayed gallery
				$retval = '<p>'._('Invalid Displayed Gallery').'</p>';
				if ($displayed_gallery) {
                    $retval = '';
					$renderer = C_Displayed_Gallery_Renderer::get_instance();
                    if (defined('NGG_SHOW_DISPLAYED_GALLERY_ERRORS') && NGG_SHOW_DISPLAYED_GALLERY_ERRORS && $displayed_gallery->is_invalid()) {
                        $retval .= var_export($displayed_gallery->get_errors(), TRUE);
                    }
                    if (self::$substitute_placeholders) $retval .= $renderer->render($displayed_gallery, TRUE);
				}

				$content = str_replace($match[0], $retval, $content);
			}
		}

		return $content;
    }


	/**
	 * Enqueues static resources required by the Attach to Post interface
	 */
	function enqueue_static_resources()
	{
		$router = C_Router::get_instance();

		// Enqueue resources needed at post/page level
		if (preg_match("/\/wp-admin\/(post|post-new)\.php$/", $_SERVER['SCRIPT_NAME'])) {
			$this->_enqueue_tinymce_resources();

			M_Gallery_Display::enqueue_fontawesome();

			wp_register_script(
			    'Base64',
                $router->get_static_url('photocrati-attach_to_post#base64.js'),
                array(),
                NGG_PLUGIN_VERSION
            );

			wp_enqueue_style(
				'ngg_attach_to_post_dialog',
				$router->get_static_url('photocrati-attach_to_post#attach_to_post_dialog.css'),
				FALSE,
				NGG_SCRIPT_VERSION
			);

			wp_enqueue_script(
				'ngg-igw',
				$router->get_static_url('photocrati-attach_to_post#igw.js'),
				array('jquery', 'Base64'),
				NGG_PLUGIN_VERSION
			);
			wp_localize_script('ngg-igw', 'ngg_igw_i18n', array(
				'nextgen_gallery'	=>	__('NextGEN Gallery', 'nggallery'),
				'edit'				=>	__('Click to edit', 'nggallery'),
				'remove'			=>	__('Click to remove', 'nggallery'),
			));
		}

		elseif (isset($_REQUEST['attach_to_post']) OR
		  (isset($_REQUEST['page']) && strpos($_REQUEST['page'], 'nggallery') !== FALSE)) {
<<<<<<< HEAD
			wp_enqueue_script(
			    'iframely',
                $router->get_static_url('photocrati-attach_to_post#iframely.js'),
                array(),
                NGG_SCRIPT_VERSION
            );
			wp_enqueue_style(
			    'iframely',
                $router->get_static_url('photocrati-attach_to_post#iframely.css'),
                array(),
                NGG_SCRIPT_VERSION
            );
			wp_enqueue_script('nextgen_admin_js');
=======
			wp_enqueue_script('iframely', $router->get_static_url('photocrati-attach_to_post#iframely.js'), FALSE, NGG_SCRIPT_VERSION);
			wp_enqueue_style('iframely',  $router->get_static_url('photocrati-attach_to_post#iframely.css'), FALSE, NGG_SCRIPT_VERSION);
>>>>>>> aedd11f9c43d222f1ceddef3f64c520a14f82793
		}
	}

	/**
	 * Enqueues resources needed by the TinyMCE editor
	 */
	function _enqueue_tinymce_resources()
	{
		wp_localize_script(
			'media-editor',
			'nextgen_gallery_attach_to_post_url',
			C_NextGen_Settings::get_instance()->attach_to_post_url
		);

		// Registers our tinymce button and plugin for attaching galleries
        $security   = $this->get_registry()->get_utility('I_Security_Manager');
        $sec_actor  = $security->get_current_actor();
        $checks = array(
            $sec_actor->is_allowed('NextGEN Attach Interface'),
            $sec_actor->is_allowed('NextGEN Use TinyMCE')
        );
        if (!in_array(FALSE, $checks)) {
            if (get_user_option('rich_editing') == 'true') {
                add_filter('mce_buttons', array(&$this, 'add_attach_to_post_button'));
                add_filter('mce_external_plugins', array(&$this, 'add_attach_to_post_tinymce_plugin'));
                add_filter('wp_mce_translation', array($this, 'add_attach_to_post_tinymce_i18n'));
            }
        }
	}

	/**
	 * Adds a TinyMCE button for the Attach To Post plugin
	 * @param array $buttons
	 * @return array
	 */
	function add_attach_to_post_button($buttons)
	{
		array_push(
            $buttons,
            'separator',
            $this->attach_to_post_tinymce_plugin
        );
        return $buttons;
	}

	/**
	 * Adds the Attach To Post TinyMCE plugin
	 * @param array $plugins
	 * @return array
	 * @uses mce_external_plugins filter
	 */
	function add_attach_to_post_tinymce_plugin($plugins)
	{
        $router = C_Router::get_instance();
		wp_enqueue_script('photocrati_ajax');
<<<<<<< HEAD
		$plugins[$this->attach_to_post_tinymce_plugin] = add_query_arg(
			'ver',
			NGG_SCRIPT_VERSION,
			$router->get_static_url('photocrati-attach_to_post#ngg_attach_to_post_tinymce_plugin.js')
		);
=======
		$plugins[$this->attach_to_post_tinymce_plugin] = $router->get_static_url('photocrati-attach_to_post#ngg_attach_to_post_tinymce_plugin.js');
>>>>>>> aedd11f9c43d222f1ceddef3f64c520a14f82793
		return $plugins;
	}

    /**
     * Adds the Attach To Post TinyMCE i18n strings
     * @param $mce_translation
     * @return mixed
     */
    function add_attach_to_post_tinymce_i18n($mce_translation)
    {
        $mce_translation['ngg_attach_to_post.title'] = __('Attach NextGEN Gallery to Post', 'nggallery');
        return $mce_translation;
    }

	/**
	 * Notify frames that a new gallery has been created
	 * @param int $gallery_id
	 */
	function new_gallery_event($gallery_id)
	{
        $gallery = C_Gallery_Mapper::get_instance()->find($gallery_id);
		if ($gallery) {
			$this->_get_frame_event_publisher()->add_event(array(
				'event'		=>	'new_gallery',
				'gallery_id'=>	intval($gallery_id),
				'gallery_title'   =>  $gallery->title
			));
		}
	}

	/**
	 * Notifies a frame that images have been added to a gallery
	 * @param int $gallery_id
	 * @param array $image_ids
	 */
	function images_added_event($gallery_id, $image_ids=array())
	{
        $this->_get_frame_event_publisher()->add_event(array(
			'event'			=>	'images_added',
			'gallery_id'		=>	intval($gallery_id)
		));
	}

    /**
     * Notifies a frame that the tags have changed
     *
     * @param array $tags
     */
    function manage_tags_event($tags = array())
    {
        $this->_get_frame_event_publisher()->add_event(array(
            'event' => 'manage_tags',
            'tags' => $tags
        ));
    }

	/**
	 * Notifies a frame that an action has been performed on a particular
	 * NextGEN page
	 * @param array $event
	 */
	function nextgen_page_event($event)
	{
        $this->_get_frame_event_publisher()->add_event($event);
	}

	/**
	 * @return array
	 */
    function get_type_list()
    {
        return array(
            'A_Attach_To_Post_Ajax' => 'adapter.attach_to_post_ajax.php',
            'C_Attach_To_Post_Installer' => 'class.attach_to_post_installer.php',
            'A_Gallery_Storage_Frame_Event' => 'adapter.gallery_storage_frame_event.php',
            'C_Attach_Controller' => 'class.attach_controller.php',
			'C_Attach_To_Post_Proxy_Controller' => 'class.attach_to_post_proxy_controller.php',
            'Mixin_Attach_To_Post_Display_Tab' => 'mixin.attach_to_post_display_tab.php'
        );
    }
}

class C_Attach_To_Post_Option_Handler
{
	function get_router()
	{
		return C_Router::get_instance();
	}

	function get($key, $default=NULL)
	{
		$retval = $default;

		switch ($key) {
			case 'attach_to_post_url':
				$retval = admin_url('/?'.NGG_ATTACH_TO_POST_SLUG.'=1');
				break;
			case 'gallery_preview_url':
				// TODO: This url will be used in 2.0.69
				if (FALSE) $retval = admin_url('/?'.NGG_ATTACH_TO_POST_SLUG.'='.NGG_ATTACH_TO_POST_SLUG.'/preview');
				else $retval = $this->get_router()->get_url('/'.NGG_ATTACH_TO_POST_SLUG.'/preview', FALSE);
				break;
			case 'attach_to_post_display_tab_js_url':
				$retval = admin_url('/?'.NGG_ATTACH_TO_POST_SLUG.'=js');
				break;
		}

		if (is_ssl() && strpos($retval, 'https') === FALSE) $retval = str_replace('http', 'https', $retval);

		return $retval;
	}
}

class C_Attach_To_Post_Installer
{
	function install()
	{
		// Delete cached values. Needed for 2.0.7 and less
		$settings = C_NextGen_Settings::get_instance();
		$settings->delete('attach_to_post_url');
		$settings->delete('gallery_preview_url');
		$settings->delete('attach_to_post_display_tab_js_url');
	}
}

new M_Attach_To_Post();
