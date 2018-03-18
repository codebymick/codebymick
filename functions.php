<?php

add_theme_support('post-thumbnails');
add_post_type_support('page', 'excerpt');
/**
 * Add HTML5 theme support.
 */
function wpdocs_after_setup_theme()
{
    add_theme_support('html5', array( 'search-form' ));
}
add_action('after_setup_theme', 'wpdocs_after_setup_theme');

//-register menus
function register_my_menus()
{
    register_nav_menus(
        array(
            'main' => __('TopMenu')
        )
    );
}
add_action('init', 'register_my_menus');

function wpdocs_custom_excerpt_length($length)
{
    return 32;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

// enqueue styles + scripts
function codebymick_enqueue_styles()
{
  wp_enqueue_style('font', 'https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Sue+Ellen+Francisco', array(), null);
  wp_enqueue_style('font2', 'https://fonts.googleapis.com/css?family=Lato:400,700,900', array(), null);
    wp_enqueue_style('core', get_bloginfo('template_url').'/style.css', array(), null, 'screen');
    wp_enqueue_style('mmenu', get_bloginfo('template_url').'/assets/jquery.mmenu.all.css', array(), null, 'screen');
    //wp_enqueue_style('slick', get_bloginfo('template_url').'/assets/slick/slick.css', array(), null, 'screen');
    //wp_enqueue_style('slicktheme', get_bloginfo('template_url').'/assets/slick/slick-theme.css', array(), null, 'screen');
    wp_enqueue_script('jquery');
    wp_enqueue_script('mmenu', get_bloginfo('template_url').'/js/jquery.mmenu.all.js', array('jquery'), false, true);
    //wp_enqueue_script('slick', get_bloginfo('template_url').'/assets/slick/slick.min.js', array('jquery'), false, true);
    wp_enqueue_script('core', get_bloginfo('template_url').'/js/script.js', array('jquery'), false, true);
    wp_enqueue_script('moment', get_bloginfo('template_url').'/js/moment.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'codebymick_enqueue_styles');

//Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more)
{
    global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> [...]</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
// CUSTOM POST TYPES
function samples_custom_post_types()
{

        // cutomer loyalty quotes - Samples
    $labels = array(
            'name'               => _x('Samples', 'post type general name', 'codebymick'),
            'singular_name'      => _x('Sample', 'post type singular name', ''),
            'menu_name'          => _x('Samples', 'admin menu', 'codebymick'),
            'name_admin_bar'     => _x('Samples', 'add new on admin bar', 'codebymick'),
            'add_new'            => _x('New Sample', 'book', 'codebymick'),
            'add_new_item'       => __('New Sample add', 'codebymick'),
            'new_item'           => __('New Sample', 'codebymick'),
            'edit_item'          => __('Sample edit', 'codebymick'),
            'view_item'          => __('Sample view', 'codebymick'),
            'all_items'          => __('All Samples', 'codebymick'),
            'search_items'       => __('Samples search', 'codebymick'),
            'parent_item_colon'  => __('Parent Sample', 'codebymick'),
            'not_found'          => __('No sample found', 'codebymick'),
            'not_found_in_trash' => __('No sampe found', 'codebymick')
        );
    $args = array(
            'labels'             => $labels,
            'description'        => __('All current codebymick Samples', 'codebymick'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'Samples'),
            'capability_type'    => 'page',
            'has_archive'        => false,
            'hierarchical'       => true,
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'page-attributes')
        );
    register_post_type('Samples', $args);
}

add_action('init', 'samples_custom_post_types');
// track users country or basis
  function geo_codeo()
  {
      $client  = @$_SERVER['HTTP_CLIENT_IP'];
      $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
      $remote  = $_SERVER['REMOTE_ADDR'];
      $country  = "Unknown";

      if (filter_var($client, FILTER_VALIDATE_IP)) {
          $ip = $client;
      } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
          $ip = $forward;
      } else {
          $ip = $remote;
      }
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $ip_data_in = curl_exec($ch); // string
      curl_close($ch);

      $ip_data = json_decode($ip_data_in, true);
      $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

      if ($ip_data && $ip_data['geoplugin_countryCode'] != null) {
          $country = $ip_data['geoplugin_countryCode'];
      }

      if ($country != 'DE'){
        $geoCode = get_template_part( 'modules/section', 'private' );
      } else {
        $geoCode = '';
      }

      return $geoCode;
  }


  //custom ZITAT slider for landing page.

function custom_quote_slider() {

	$slider = '<div class="inInner">
        <div class="quoteMark"></div>
        <div class="zit">
          <div class="quote"><img src="'.get_sub_field('bild').'"/><span class="quotation">'.get_sub_field('zitat').'</span></div>
          <div class="author">- '.get_sub_field('autor').' -</div>
        </div>
      </div>';

		return $slider;

}
add_action( 'init', 'custom_quote_slider' );


?>
