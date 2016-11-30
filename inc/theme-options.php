<?php

class OKFNThemeOptions {

  private $theme_options;

  public function __construct() {
    add_action('admin_menu', array($this, 'theme_options_add_plugin_page'));
    add_action('admin_init', array($this, 'theme_options_page_init'));
  }

  public function theme_options_add_plugin_page() {
    add_theme_page(
            __('Theme Options', 'okfnwp'), // page_title
            __('Theme Options', 'okfnwp'), // menu_title
            'manage_options', // capability
            'theme-options', // menu_slug
            array($this, 'theme_options_create_admin_page') // function
    );
  }

  public function theme_options_create_admin_page() {
    $this->theme_options = get_option('theme_options_option_name');
    ?>

    <div class="wrap">
      <h2><?php _e('Theme Options', 'okfnwp'); ?></h2>
      <p><?php _e('Available options for the Open Knowledge International WordPress theme', 'okfnwp'); ?></p>
      <?php settings_errors(); ?>

      <form method="POST" action="options.php">
        <?php
        settings_fields('theme_options_option_group');
        do_settings_sections('theme-options-admin');
        submit_button();
        ?>
      </form>
    </div>
    <?php
  }

  public function theme_options_page_init() {

    register_setting(
            'theme_options_option_group', // option_group
            'theme_options_option_name', // option_name
            array($this, 'theme_options_sanitize') // sanitize_callback
    );
//        add_settings_section(
//            'theme_options_setting_section_mailing', // id
//            __('Mailing List', 'okfnwp'), // title
//            array($this, 'theme_options_section_mailing'), // callback
//            'theme-options-admin' // page
//        );

    add_settings_section(
            'theme_options_setting_section_social', // id
            __('Social Media', 'okfnwp'), // title
            array($this, 'theme_options_section_social'), // callback
            'theme-options-admin' // page
    );

    add_settings_section(
            'theme_options_setting_section_meta', // id
            __('Meta Information', 'okfnwp'), // title
            array($this, 'theme_options_section_meta'), // callback
            'theme-options-admin' // page
    );

//        add_settings_section(
//            'theme_options_setting_section_wordpress', // id
//            __('WordPress Settings', 'okfnwp'), // title
//            array($this, 'theme_options_section_wordpress'), // callback
//            'theme-options-admin' // page
//        );
//        add_settings_field(
//            "okfnwp_mailinglist_heading", // id
//            __('Mailing List Heading', 'okfnwp'), // title
//            array($this, 'okfnwp_mailinglist_heading_callback'), // callback
//            'theme-options-admin', // page
//            'theme_options_setting_section_mailing' // section
//        );
//
//        add_settings_field(
//            "okfnwp_mailinglist_action", // id
//            __('Mailing URL', 'okfnwp'), // title
//            array($this, 'okfnwp_mailinglist_action_callback'), // callback
//            'theme-options-admin', // page
//            'theme_options_setting_section_mailing' // section
//        );
//
//        add_settings_field(
//            "okfnwp_mailinglist_id", // id
//            __('Mailman List ID', 'okfnwp'), // title
//            array($this, 'okfnwp_mailinglist_id_callback'), // callback
//            'theme-options-admin', // page
//            'theme_options_setting_section_mailing' // section
//        );

    add_settings_field(
            "okfnwp_twitter_id", // id
            __('Twitter Handle', 'okfnwp'), // title
            array($this, 'okfnwp_twitter_id_callback'), // callback
            'theme-options-admin', // page
            'theme_options_setting_section_social' // section
    );

    add_settings_field(
            "okfnwp_fb_id", // id
            __('Facebook Page', 'okfnwp'), // title
            array($this, 'okfnwp_fb_id_callback'), // callback
            'theme-options-admin', // page
            'theme_options_setting_section_social' // section
    );

    add_settings_field(
            "okfnwp_discuss_id", // id
            __('Discuss Page', 'okfnwp'), // title
            array($this, 'okfnwp_discuss_id_callback'), // callback
            'theme-options-admin', // page
            'theme_options_setting_section_social' // section
    );

    add_settings_field(
            "okfnwp_meta", // id
            __('Custom Meta Tags', 'okfnwp'), // title
            array($this, 'okfnwp_meta_callback'), // callback
            'theme-options-admin', // page
            'theme_options_setting_section_meta' // section
    );

//        add_settings_field(
//            "okfnwp_admin_bar", // id
//            __('WordPress toolbar visibility', 'okfnwp'), // title
//            array($this, 'okfnwp_admin_bar_callback'), // callback
//            'theme-options-admin', // page
//            'theme_options_setting_section_wordpress' // section
//        );
  }

  public function theme_options_sanitize($input) {
    $sanitary_values = array();
//        if (isset($input['okfnwp_mailinglist_heading'])) {
//            $sanitary_values['okfnwp_mailinglist_heading'] = sanitize_text_field($input['okfnwp_mailinglist_heading']);
//        }
//
//        if (isset($input['okfnwp_mailinglist_action'])) {
//            $sanitary_values['okfnwp_mailinglist_action'] = sanitize_text_field($input['okfnwp_mailinglist_action']);
//        }
//
//        if (isset($input['okfnwp_mailinglist_id'])) {
//            $sanitary_values['okfnwp_mailinglist_id'] = sanitize_text_field($input['okfnwp_mailinglist_id']);
//        }

    if (isset($input['okfnwp_twitter_id'])) {
      $sanitary_values['okfnwp_twitter_id'] = sanitize_text_field($input['okfnwp_twitter_id']);
    }

    if (isset($input['okfnwp_fb_id'])) {
      $sanitary_values['okfnwp_fb_id'] = sanitize_text_field($input['okfnwp_fb_id']);
    }

    if (isset($input['okfnwp_discuss_id'])) {
      $sanitary_values['okfnwp_discuss_id'] = sanitize_text_field($input['okfnwp_discuss_id']);
    }

    if (isset($input['okfnwp_meta'])) {
      $sanitary_values['okfnwp_meta'] = esc_textarea($input['okfnwp_meta']);
    }

//        if (isset($input['okfnwp_admin_bar'])) {
//            $sanitary_values['okfnwp_admin_bar'] = $input['okfnwp_admin_bar'];
//        }

    return $sanitary_values;
  }

//    public function theme_options_section_mailing() {
//        
//    }

  public function theme_options_section_social() {
    
  }

  public function theme_options_section_meta() {
    
  }

//    public function theme_options_section_wordpress() {
//        
//    }
//    public function okfnwp_mailinglist_heading_callback() {
//
//        $current_val = $this->theme_options['okfnwp_mailinglist_heading'];
//        $old_val = get_option('okfnwp_mailinglist_heading');
//
//        if (!isset($current_val) && isset($old_val)):
//            $current_val = $old_val;
//        endif;
//
//        printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_mailinglist_heading]" id="okfnwp_mailinglist_heading" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
//    }
//    public function okfnwp_mailinglist_action_callback() {
//        $current_val = $this->theme_options['okfnwp_mailinglist_action'];
//        $old_val = get_option('okfnwp_mailinglist_action');
//
//        if (!isset($current_val) && isset($old_val)):
//            $current_val = $old_val;
//        endif;
//
//        printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_mailinglist_action]" id="okfnwp_mailinglist_action" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
//        _e('<p>URL to which the subscribe form data will be sent. Mailman example: http://lists.okfn.org/mailman/subscribe/XYZ</p>');
//    }
//    public function okfnwp_mailinglist_id_callback() {
//        $current_val = $this->theme_options['okfnwp_mailinglist_id'];
//        $old_val = get_option('okfnwp_mailinglist_id');
//
//        if (!isset($current_val) && isset($old_val)):
//            $current_val = $old_val;
//        endif;
//
//        printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_mailinglist_id]" id="okfnwp_mailinglist_id" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
//        _e('<p>For the list at http://lists.okfn.org/mailman/subscribe/XYZ, this should be XYZ</p>');
//    }


  public function okfnwp_twitter_id_callback() {
    $current_val = $this->theme_options['okfnwp_twitter_id'];
    $old_val = get_option('okfnwp_twitter_id');

    if (!isset($current_val) && isset($old_val)):
      $current_val = $old_val;
    endif;

    printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_twitter_id]" id="okfnwp_twitter_id" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
    ?>
    <p><?php _e('Twitter handle to link to. Example: If your handle is @okfn, use okfn'); ?></p>
    <?php
  }

  public function okfnwp_fb_id_callback() {
    $current_val = $this->theme_options['okfnwp_fb_id'];
    $old_val = get_option('okfnwp_fb_id');

    if (!isset($current_val) && isset($old_val)):
      $current_val = $old_val;
    endif;

    printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_fb_id]" id="okfnwp_fb_id" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
    ?>
    <p><?php _e('Facebook page name. If the URL to your page is https://www.facebook.com/OKFNetwork, then use OKFNetwork'); ?></p>
    <?php
  }

  public function okfnwp_discuss_id_callback() {
    $current_val = $this->theme_options['okfnwp_discuss_id'];
    $old_val = get_option('okfnwp_discuss_id');

    if (!isset($current_val) && isset($old_val)):
      $current_val = $old_val;
    endif;

    printf('<input class="regular-text" type="text" name="theme_options_option_name[okfnwp_discuss_id]" id="okfnwp_discuss_id" value="%s">', isset($current_val) ? esc_attr($current_val) : '');
    ?>
    <p><?php _e('Discuss (discuss.okfn.org) page name. If the URL to your page is https://discuss.okfn.org/c/local-groups/okbr, then use c/local-groups/okbr'); ?></p>
    <?php
  }

  public function okfnwp_meta_callback() {
    $current_val = $this->theme_options['okfnwp_meta'];
    $old_val = get_option('okfnwp_meta');

    if (!isset($current_val) && isset($old_val)):
      $current_val = $old_val;
    endif;

    printf('<textarea cols="60" rows="10" class="regular-text" type="text" name="theme_options_option_name[okfnwp_meta]" id="okfnwp_meta">%s</textarea>', isset($current_val) ? esc_attr($current_val) : '');
    ?>
    <p><?php _e('Enter any content you would like added in the &lt;head&gt; section of every page &mdash; useful for meta tags or custom validation codes for social media and analytics services.'); ?></p>
    <?php
  }

//    public function okfnwp_admin_bar_callback() {
//        $current_val = isset($this->theme_options['okfnwp_admin_bar']) ? $this->theme_options['okfnwp_admin_bar'] : false;
//
//        printf('<label for="okfnwp_admin_bar"><input type="checkbox" name="theme_options_option_name[okfnwp_admin_bar]" id="okfnwp_admin_bar" value="1" %s>%s</label>', checked(1, $current_val, false), __(' Show the WordPress Admin toolbar when viewing site', 'okfnwp'));
//    }
}

if (is_admin()):
  $theme_options = new OKFNThemeOptions();    
endif;

/* 
 * Retrieve this value with:
 * $theme_options = get_option( 'theme_options_option_name' ); // Array of All Options
 * $okfnwp_mailinglist_heading = $theme_options['okfnwp_mailinglist_heading']; // okfnwp_mailinglist_heading
 * $okfnwp_mailinglist_action = $theme_options['okfnwp_mailinglist_action']; // okfnwp_mailinglist_action
 * $okfnwp_mailinglist_id = $theme_options['okfnwp_mailinglist_id']; // okfnwp_mailinglist_id
 * $okfnwp_twitter_id = $theme_options['okfnwp_twitter_id']; // okfnwp_twitter_id
 * $okfnwp_fb_id = $theme_options['okfnwp_fb_id']; // okfnwp_fb_id
 * $okfnwp_admin_bar = $theme_options['okfnwp_admin_bar']; // okfnwp_admin_bar
 */
