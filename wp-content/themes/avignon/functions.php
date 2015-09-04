<?php

define( 'AVIGNON_VERSION', 1.0 );

define( 'AVIGNON_APPLY_FORM_ID', 2 );
define( 'AVIGNON_RECOMMENDATION_FORM_ID', 3 );
define( 'AVIGNON_HEALTH_EVALUATION_UPLOAD_FORM_ID', 3 );

define( 'AVIGNON_RECOMMENDATION_PAGE_ID', 305 );
define( 'AVIGNON_HEALTH_EVALUATION_PAGE_ID', 310 );
define( 'AVIGNON_HEALTH_EVALUATION_UPLOAD_PAGE_ID', 312 );

/*-----------------------------------------------------------------------------------*/
/* General
/*-----------------------------------------------------------------------------------*/
// Theme support
add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'widgets') );
add_theme_support( 'post-thumbnails', array( 'post', 'teachers', 'page', 'board-members' ));

// Feed
add_theme_support( 'automatic-feed-links' );
function remove_comments_rss( $for_comments ){ return; }
add_filter('post_comments_feed_link', 'remove_comments_rss');

// Admin bar
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar(false);
}

/*-----------------------------------------------------------------------------------*/
/* Hide Wordpress version and stuff for security, hide login errors
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');

add_filter('login_errors', create_function('$a', "return null;"));

function remove_comment_author_class( $classes ) {
	foreach( $classes as $key => $class ){
		if(strstr($class, "comment-author-")){ unset( $classes[$key] ); }
	}
	return $classes;
}
add_filter( 'comment_class' , 'remove_comment_author_class' );

/*-----------------------------------------------------------------------------------*/
/* Menus
/*-----------------------------------------------------------------------------------*/
register_nav_menus(
	array(
        'primary' => 'Primary Menu',
        'secondary-study' => 'Secondary Menu - Study',
        'secondary-live' => 'Secondary Menu - Live'
    )
);

// Cleanup WP Menu html
function css_attributes_filter($var) {
     return is_array($var) ? array_intersect($var, array('current-menu-item', 'current_page_parent', 'hasSubmenu')) : '';
}
add_filter('nav_menu_css_class', 'css_attributes_filter', 100, 1);
add_filter('page_css_class', 'css_attributes_filter', 100, 1);

// Add a class to li if has subMenu
function sub_menu( $sorted_menu_items, $args ) {
    $last_top = 0;

    foreach( $sorted_menu_items as $key => $obj ){
        if( 0 == $obj->menu_item_parent ){
            $last_top = $key;
        }else{
            $sorted_menu_items[$last_top]->classes['dropdown'] = 'hasSubmenu';
        }
    }
    return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'sub_menu', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Sidebars
/*-----------------------------------------------------------------------------------*/
function avignon_register_sidebars() {
	register_sidebar(array(
		'id' => 'footer-social',
		'name' => 'Footer - Social',
		'description' => 'Set here your social networks for the footer',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> ''
	));
    register_sidebar(array(
        'id' => 'footer-contact',
        'name' => 'Footer - Contact',
        'description' => 'Set here your contact informations for the footer',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        'empty_title'=> ''
    ));
    register_sidebar(array(
        'id' => 'footer-bottom',
        'name' => 'Footer - Bottom',
        'description' => 'Set here your legal informations for the bottom of the footer',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        'empty_title'=> ''
    ));
}
add_action( 'widgets_init', 'avignon_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Custom widgets
/*-----------------------------------------------------------------------------------*/
// widget social
class Social_Widget extends WP_Widget{
    function Social_Widget() {
        parent::__construct(false, 'Avignon - Social Networks');
    }
    function form($instance){
        $youtube = esc_attr($instance['youtube']);
        $facebook = esc_attr($instance['facebook']);
        $twitter = esc_attr($instance['twitter']);
        ?>      <h4>Social networks links</h4>
                <p><label for="<?php echo $this->get_field_id('youtube'); ?>">Youtube link :</label> <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook link :</label> <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter link:</label> <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" /></p>
        <?php
    }
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    function widget($args, $instance){ ?>
        <ul id='social-footer'>
            <?php if ($instance['youtube'] != '') { ?>
                <li><a href="<?php echo $instance['youtube']; ?>" title="Institut d'Avignon on Youtube" target="_blank"><span class="icon-youtube"></span></a></li><!--
            --><?php } if ($instance['facebook'] != '') { ?><!--
                --><li><a href="<?php echo $instance['facebook']; ?>" title="Institut d'Avignon on Facebook" target="_blank"><span class="icon-facebook"></span></a></li><!--
           --><?php } if ($instance['twitter'] != '') { ?><!--
                --><li><a href="<?php echo $instance['twitter']; ?>" title="Institut d'Avignon on Twitter" target="_blank"><span class="icon-twitter"></span></a></li>
            <?php } ?>
        </ul>

        <?php
    }
}
register_widget('Social_Widget');

// widget address
class Address_Widget extends WP_Widget{
    function Address_Widget() {
        parent::__construct(false, 'Avignon - Address');
    }
    function form($instance){
        $title1 = esc_attr($instance['title1']);
        $title2 = esc_attr($instance['title2']);
        $content1 = esc_attr($instance['content1']);
        $content2 = esc_attr($instance['content2']);
        $content3 = esc_attr($instance['content3']);
        ?>      <h4>Title</h4>
                <p><label for="<?php echo $this->get_field_id('title1'); ?>">First line :</label> <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" value="<?php echo $title1; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('title2'); ?>">Second line :</label> <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo $title2; ?>" /></p>

                <h4>Content</h4>
                <p><label for="<?php echo $this->get_field_id('content1'); ?>">First line :</label> <input class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content1'); ?>" value="<?php echo $content1; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('content2'); ?>">Second line :</label> <input class="widefat" id="<?php echo $this->get_field_id('content2'); ?>" name="<?php echo $this->get_field_name('content2'); ?>" value="<?php echo $content2; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('content3'); ?>">Third line :</label> <input class="widefat" id="<?php echo $this->get_field_id('content3'); ?>" name="<?php echo $this->get_field_name('content3'); ?>" value="<?php echo $content3; ?>" /></p>
        <?php
    }
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    function widget($args, $instance){ ?>
        <div class='adress'>
            <p class='adress-title'>
                <?php
                    if($instance['title1'] != ''){
                        echo $instance['title1'] . '<br/>';
                    }
                    if($instance['title2'] != ''){
                        echo $instance['title2'];
                    }
                ?>
            </p>

            <p class='adress-content'>
                <?php
                    if($instance['content1'] != ''){
                        echo $instance['content1'] . '<br/>';
                    }
                    if($instance['content2'] != ''){
                        echo $instance['content2'] . '<br/>';
                    }
                    if($instance['content3'] != ''){
                        echo $instance['content3'];
                    }
                ?>
            </p>
        </div><!--

        --><?php
    }
}
register_widget('Address_Widget');

// widget contact
class Contact_Widget extends WP_Widget{
    function Contact_Widget() {
        parent::__construct(false, 'Avignon - Contact');
    }
    function form($instance){
        $phone = esc_attr($instance['phone']);
        $fax = esc_attr($instance['fax']);
        $mail = esc_attr($instance['mail']);
        ?>      <h4>Your contact informations</h4>
                <p><label for="<?php echo $this->get_field_id('phone'); ?>">Phone number :</label> <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $phone; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('fax'); ?>">Fax number :</label> <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $fax; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('mail'); ?>">Email address :</label> <input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" value="<?php echo $mail; ?>" /></p>
        <?php
    }
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    function widget($args, $instance){ ?><!--
        --><div class="contact-content">
            <ul>
                <?php if($instance['phone'] != ''){ ?>
                    <li>Phone: <?php echo $instance['phone']; ?></li>
                <?php } if($instance['fax'] != ''){ ?>
                    <li>FAX: <?php echo $instance['fax']; ?></li>
                <?php } if($instance['mail'] != ''){ ?>
                    <li class="email"><a href="mailto:<?php echo $instance['mail']; ?>"><span class="icon-mail"></span><span class="txt-btn"><?php echo $instance['mail']; ?></span></a></li>
                <?php } ?>
            </ul>
        </div>

        <?php
    }
}
register_widget('Contact_Widget');

// widget legal
class Legal_Widget extends WP_Widget{
    function Legal_Widget() {
        parent::__construct(false, 'Avignon - Legal informations');
    }
    function form($instance){
        $text = esc_attr($instance['text']);
        $legals = esc_attr($instance['legals']);
        $sitemap = esc_attr($instance['sitemap']);
        ?>      <h4>Your legal informations</h4>
                <p><label for="<?php echo $this->get_field_id('text'); ?>">Text :</label> <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" value="<?php echo $text; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('legals'); ?>">Legal informations page url :</label> <input class="widefat" id="<?php echo $this->get_field_id('legals'); ?>" name="<?php echo $this->get_field_name('legals'); ?>" value="<?php echo $legals; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('sitemap'); ?>">Sitemap page url :</label> <input class="widefat" id="<?php echo $this->get_field_id('sitemap'); ?>" name="<?php echo $this->get_field_name('sitemap'); ?>" value="<?php echo $sitemap; ?>" /></p>
        <?php
    }
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    function widget($args, $instance){ ?>
        <div id="copy"><?php if($instance['text'] != ''){ echo $instance['text']; } ?> &copy; - <?php echo date('Y'); ?> - <?php if($instance['legals'] != ''){ ?><a href="<?php echo $instance['legals']; ?>">Legals</a> -<?php } ?> <?php if($instance['sitemap'] != ''){ ?><a href="<?php echo $instance['sitemap']; ?>">Sitemap</a><?php } ?></div>
        <?php
    }
}
register_widget('Legal_Widget');

// widget logo footer
class Logo_Widget extends WP_Widget{
    function Logo_Widget() {
        parent::__construct(false, 'Avignon - Bryn Mawr logo');
    }
    function form($instance){
        $link = esc_attr($instance['link']);
        $img = esc_attr($instance['img']);
        $text = esc_attr($instance['text']);
        ?>
                <p><label for="<?php echo $this->get_field_id('link'); ?>">Link :</label> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $link; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('img'); ?>">Logo url :</label> <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" value="<?php echo $img; ?>" /></p>
                <p><label for="<?php echo $this->get_field_id('text'); ?>">Alternative text for the picture :</label> <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" value="<?php echo $text; ?>" /></p>
        <?php
    }
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    function widget($args, $instance){ ?>
        <?php if($instance['link'] != '' && $instance['img'] != ''){ ?>
            <a href="<?php echo $instance['link']; ?>" id="logo-bryn-mawr" target='_blank'><img src="<?php echo $instance['img']; ?>" <?php if($instance['text'] != ''){ ?> alt="<?php echo $instance['text']; ?>"<?php } ?> ></a>
        <?php }
    }
}
register_widget('Logo_Widget');

/*-----------------------------------------------------------------------------------*/
/* Custom Post Types
/*-----------------------------------------------------------------------------------*/
function create_taxonomy(){
  register_taxonomy('types', array(), array(
    'hierarchical' => true,
    'label' => 'Types',
    'singular_label' => 'Type',
    'rewrite' => array('slug' => 'study/curriculum')
  ));
  register_taxonomy('board-category', array(), array(
    'hierarchical' => true,
    'label' => 'Board Categories',
    'singular_label' => 'Board Category'
  ));
}
add_action( 'init', 'create_taxonomy' );

function create_post_type(){
    register_post_type('applicant', array(
        'label'          => 'Applicants',
        'singular_label' => 'Applicant',
        'public'         => false,
        'show_ui'        => true,
        'menu_icon'      => 'dashicons-portfolio',
        'supports'       => array( 'title' )
    ));
    register_post_type('teachers', array(
        'label' => 'Teachers',
        'singular_label' => 'Teacher',
        'public' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'rewrite' => array('slug' => 'study/faculty'),
        'supports' => array( 'title', 'thumbnail', 'editor' )
    ));
    register_post_type('courses', array(
        'label' => 'Courses',
        'singular_label' => 'Course',
        'public' => true,
        'menu_icon' => 'dashicons-book-alt',
        'rewrite' => array('slug' => 'study/curriculum'),
        'supports' => array( 'title', 'editor' ),
        'taxonomies' => array('types')
    ));
    register_post_type('events', array(
        'label' => 'Events',
        'singular_label' => 'Event',
        'public' => true,
        'publicly_queryable' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array( 'title', 'thumbnail' )
    ));
    register_post_type('activities', array(
        'label' => 'Activities',
        'singular_label' => 'Activity',
        'public' => true,
        'publicly_queryable' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array( 'title', 'thumbnail' )
    ));
    register_post_type('board-members', array(
        'label' => 'Advisory Board members',
        'singular_label' => 'Advisory Board member',
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => 'study/advisory-board'),
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'taxonomies' => array('board-category')
    ));
}
add_action( 'init', 'create_post_type' );

// Add our custom permastructures for courses
function add_courses_permastructure() {
    global $wp_rewrite;
    add_permastruct( 'courses', 'study/curriculum/%types%/%courses%', false );
}
add_action( 'wp_loaded', 'add_courses_permastructure' );

// Make sure that all links on the site, include the related texonomy terms
function courses_permalinks( $permalink, $post ) {
    if($post->post_type !== 'courses') return $permalink;

    $terms = get_the_terms( $post->ID, 'types' );

    if(!$terms) return str_replace( '%types%/', '', $permalink );

    $post_terms = array();
    foreach($terms as $term) $post_terms[] = $term->slug;

    return str_replace( '%types%', implode( ',', $post_terms ) , $permalink );
}
add_filter( 'post_type_link', 'courses_permalinks', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Custom Column
/*-----------------------------------------------------------------------------------*/
/**
 * Ajoute les colonnes personnalisées au Custom Post applicant :
 * - Références
 *
 * @param  array $columns
 * @return array
 */
function avignon_add_applicant_column( $columns )
{
    return array(
        'cb'         => $columns['cb'],
        'title'      => $columns['title'],
        'status'     => __( 'Status', 'avignon' ),
        'references' => __( 'References', 'avignon' ),
        'date'       => $columns['date']
    );
}
add_filter( 'manage_applicant_posts_columns', 'avignon_add_applicant_column' );

function avignon_content_applicant_column( $column, $post_id )
{
    switch ($column) {
        case 'references':
            for ( $reference = 1; $reference <= 2; $reference++ ) {
                $first_name = get_field( 'reference_' . $reference . '_first_name', $post_id );
                $last_name  = get_field( 'reference_' . $reference . '_last_name', $post_id );
                $status  = get_field( 'reference_' . $reference . '_ok', $post_id );
                $class = ( $status ) ? 'yes' : 'no';
                $color = ( $status ) ? 'green' : 'red';
                echo sprintf( '<p><span class="dashicons dashicons-%s" style="color:%s"></span> %s %s</p>', $class, $color, $first_name, $last_name );
            }
            break;
        case 'status':
            the_field( 'applicant_status', $post_id );
            break;
    }
}
add_action( 'manage_applicant_posts_custom_column', 'avignon_content_applicant_column', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Add thumbnail sizes
/*-----------------------------------------------------------------------------------*/
function avignon_thumbnail_sizes() {
    add_image_size( 'teacher-thumb', 220, 220, true );
    add_image_size( 'teacher-small-thumb', 60, 60, true );
}
add_action( 'after_setup_theme', 'avignon_thumbnail_sizes' );

/*-----------------------------------------------------------------------------------*/
/* Admin
/*-----------------------------------------------------------------------------------*/
// Remove default link around images
function imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if($image_set !== 'none'){ update_option('image_default_link_type', 'none'); }
}
add_action('admin_init', 'imagelink_setup', 10);

// New button wysiwyg
if(!function_exists('avignon_button')){
    function avignon_button( $buttons ) {
        array_unshift( $buttons, 'styleselect' );
        return $buttons;
    }
}
add_filter( 'mce_buttons_2', 'avignon_button' );

if(!function_exists('avignon_mce_before_init')){
    function avignon_mce_before_init( $styles ) {
        $style_formats = array (
            array(
                'title' => 'Button',
                'selector' => 'a',
                'classes' => 'btn'
            ),
            array(
                'title' => 'Small Button',
                'selector' => 'a',
                'classes' => 'btn-arrow'
            ),
        );

        $styles['style_formats'] = json_encode( $style_formats );

        $styles['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
        $styles['textcolor_map'] = '[' . "'000000', 'Black', '979797', 'Grey', '932712', 'Red'" . ']';
        return $styles;
    }
}
add_filter( 'tiny_mce_before_init', 'avignon_mce_before_init' );

if(!function_exists('avignon_init_editor_styles')){
    add_action( 'after_setup_theme', 'avignon_init_editor_styles' );
    function avignon_init_editor_styles() {
        add_editor_style();
    }
}

// Custom posts in the dashboard
function add_right_now_custom_post() {
    $args = array(
        '_builtin' => false
    );
    $output = 'objects';
    $operator = 'and';
    $post_types = get_post_types($args , $output , $operator);
    foreach($post_types as $post_type){
        $cpt_name = $post_type->name;
        if($cpt_name != 'acf'){
            $num_posts = wp_count_posts($post_type->name);
            $num = number_format_i18n($num_posts->publish);
            $text = _n($post_type->labels->name, $post_type->labels->name , intval($num_posts->publish));
            echo '<li class="'. $cpt_name .'-count"><tr><a class="'.$cpt_name.'" href="edit.php?post_type='.$cpt_name.'"><td></td>' . $num . ' <td>' . $text . '</td></a></tr></li>';
        }
    }
}
add_action('dashboard_glance_items', 'add_right_now_custom_post');

/*-----------------------------------------------------------------------------------*/
/* Calendar - Generate .ics file (events and activities)
/*-----------------------------------------------------------------------------------*/
include_once( get_template_directory() . '/functions/ics.php' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function avignon_scripts()  {
		// header
		wp_enqueue_style( 'avignon-style', get_template_directory_uri() . '/css/style.css', array(), AVIGNON_VERSION );
		wp_enqueue_script( 'avignon-modernizr', get_template_directory_uri() . '/js/modernizr-min.js', array(), null);

		// footer
	    wp_deregister_script('jquery');
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', array(), null );

        wp_enqueue_script( 'avignon-ismobile', get_template_directory_uri() . '/js/isMobile.min.js', array(), null, true );

        wp_enqueue_script( 'avignon-tween', get_template_directory_uri() . '/js/TweenMax.min.js', array(), null, true );
        if(is_front_page())
            wp_enqueue_script( 'avignon-scrollreveal', get_template_directory_uri() . '/js/scrollReveal.min.js', array(), null, true );
        wp_enqueue_script( 'avignon-imgliquid', get_template_directory_uri() . '/js/imgLiquid.min.js', array(), null, true );


        wp_enqueue_script( 'avignon', get_template_directory_uri() . '/js/script.js', array(), AVIGNON_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'avignon_scripts' );

/*-----------------------------------------------------------------------------------*/
/* FORMULAIRE GRAVITY FORMS
/*-----------------------------------------------------------------------------------*/
/*
 * Navigation multipage.
 */
include_once( get_template_directory() . '/functions/gf-multipage-navigation.php' );
new GWMultipageNavigation(array('activate_on_last_page' => false));

/**
 * Génère automatiquement un jeton d'authentification pour le formulaire d'application.
 *
 * On utilise ensuite ce jeton pour le lien vers le formulaire de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_default_token( $value = '' )
{
    $bytes = openssl_random_pseudo_bytes( 32 );
    $hex   = bin2hex( $bytes );
    return $hex;
}
add_filter( 'gform_field_value_default_token', 'avignon_field_value_default_token' );

/**
 * Remplit automatiquement le champ avec le prénom de l'applicant dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_applicant_first_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'first_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_applicant_first_name', 'avignon_field_value_applicant_first_name' );

/**
 * Remplit automatiquement le champ avec le nom de l'applicant dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_applicant_last_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'last_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_applicant_last_name', 'avignon_field_value_applicant_last_name' );

/**
 * Remplit automatiquement le champ avec le prénom du référent dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_first_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] &&
         isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'reference_' . $_GET['reference'] . '_first_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_reference_first_name', 'avignon_field_value_reference_first_name' );

/**
 * Remplit automatiquement le champ avec le nom du référent dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_last_name( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] &&
         isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'reference_' . $_GET['reference'] . '_last_name', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_reference_last_name', 'avignon_field_value_reference_last_name' );

/**
 * Remplit automatiquement le champ avec l'email du référent dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_email( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] &&
         isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $applicants = get_posts( array(
            'post_type'  => 'applicant',
            'meta_key'   => 'token',
            'meta_value' => $_GET['token']
        ) );

        if ( count( $applicants ) > 0 ) {
            $applicant = array_shift( $applicants );
            $value = get_field( 'reference_' . $_GET['reference'] . '_email', $applicant->ID );
        }
    }
    return $value;
}
add_filter( 'gform_field_value_reference_email', 'avignon_field_value_reference_email' );

/**
 * Remplit automatiquement le champ avec le jeton dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_parameter_token( $value = '' )
{
    if ( isset( $_GET['token'] ) && $_GET['token'] ) {
        $value = $_GET['token'];
    }
    return $value;
}
add_filter( 'gform_field_value_parameter_token', 'avignon_field_value_parameter_token' );

/**
 * Remplit automatiquement le champ avec le numéro de référence dans le formulaire
 * de recommendation.
 *
 * @param  string $value
 * @return string
 */
function avignon_field_value_reference_number( $value = '' )
{
    if ( isset( $_GET['reference'] ) && $_GET['reference'] ) {
        $value = $_GET['reference'];
    }
    return $value;
}
add_filter( 'gform_field_value_reference_number', 'avignon_field_value_reference_number' );

/**
 * Vérifie si l'email de l'applicant n'est pas déjà enregistré dans la base de données.
 *
 * @param  array $result
 * @param  string $value
 * @return array
 */
function avignon_validate_email_applicant( $result, $value = '' )
{
    $applicants = get_posts( array(
        'post_type'  => 'applicant',
        'meta_key'   => 'email',
        'meta_value' => $value
    ) );

    if ( count( $applicants ) > 0 ) {
        $result['is_valid'] = false;
        $result['message'] = 'This email address is already used on an application';
    }

    return $result;
}
add_action( 'gform_field_validation_' . AVIGNON_APPLY_FORM_ID . '_9',  'avignon_validate_email_applicant', 10, 2 );
add_action( 'gform_field_validation_' . AVIGNON_APPLY_FORM_ID . '_10', 'avignon_validate_email_applicant', 10, 2 );

/**
 * Soumission du formulaire d'inscription.
 * - Création du dossier
 * - Sauvegarde des informations avec ACF
 * - Envoi de l'email de confirmation d'inscription
 *
 * @param  Array $entry
 * @return void
 */
function avignon_apply_form_submitted( $entry )
{
    $data = array(
        'first_name'               => ucwords( $entry[3] ),
        'last_name'                => mb_strtoupper( $entry[4] ),
        'birthday'                 => $entry[5],
        'ss_number'                => $entry[6],
        'citizenship'              => $entry[7],
        'passport'                 => $entry[8],
        'email'                    => $entry[9],
        'email2'                   => $entry[10],
        'phone'                    => $entry[11],
        'mobile'                   => $entry[12],
        'photo'                    => $entry[13],
        'canal'                    => $entry[14],
        'address'                  => $entry[17],
        'address2'                 => $entry[18],
        'city'                     => $entry[19],
        'zip_code'                 => $entry[20],
        'state'                    => $entry[21],
        'country'                  => $entry[22],
        'status'                   => $entry[25],
        'secondary_school'         => $entry[26],
        'university'               => $entry[27],
        'year_graduating'          => $entry[28],
        'major_subject'            => $entry[29],
        'previous_foreign_travel'  => $entry[30],
        'reasons'                  => $entry[31],
        'prize'                    => $entry[32],
        'plan_after'               => $entry[33],
        'emergency_first_name'     => ucwords( $entry[37] ),
        'emergency_last_name'      => mb_strtoupper( $entry[38] ),
        'emergency_relationship'   => $entry[39],
        'emergency_phone'          => $entry[40],
        'emergency_address'        => $entry[41],
        'emergency_address2'       => $entry[42],
        'emergency_city'           => $entry[43],
        'emergency_zip_code'       => $entry[44],
        'emergency_state'          => $entry[45],
        'emergency_country'        => $entry[46],
        'reference_1_first_name'   => ucwords( $entry[51] ),
        'reference_1_last_name'    => mb_strtoupper( $entry[52] ),
        'reference_1_affilitation' => $entry[53],
        'reference_1_email'        => $entry[54],
        'reference_2_first_name'   => ucwords( $entry[56] ),
        'reference_2_last_name'    => mb_strtoupper( $entry[57] ),
        'reference_2_affilitation' => $entry[58],
        'reference_2_email'        => $entry[59],
        'signature_first_name'     => ucwords( $entry[66] ),
        'signature_last_name'      => mb_strtoupper( $entry[67] ),
        'signature_date'           => $entry[68],
        'token'                    => $entry[69]
    );

    $acf_mapping = array(
        'applicant_status'         => 'field_55e86af1e004f',
        'applicant_reason'         => 'field_55e86b22e0050',
        'first_name'               => 'field_55e5afddbfc2f',
        'last_name'                => 'field_55e5afeabfc30',
        'birthday'                 => 'field_55e5aff3bfc31',
        'ss_number'                => 'field_55e5affbbfc32',
        'citizenship'              => 'field_55e5b002bfc33',
        'passport'                 => 'field_55e5b009bfc34',
        'email'                    => 'field_55e5b016bfc35',
        'email2'                   => 'field_55e5b01dbfc36',
        'phone'                    => 'field_55e5b026bfc37',
        'mobile'                   => 'field_55e5b02fbfc38',
        'photo'                    => 'field_55e5b039bfc39',
        'canal'                    => 'field_55e5b05bbfc3a',
        'address'                  => 'field_55e5b069bfc3b',
        'address2'                 => 'field_55e5b073bfc3c',
        'city'                     => 'field_55e5b07ebfc3d',
        'zip_code'                 => 'field_55e5b082bfc3e',
        'state'                    => 'field_55e5b0adbfc3f',
        'country'                  => 'field_55e5b0b8bfc40',
        'status'                   => 'field_55e5b0e4bfc43',
        'secondary_school'         => 'field_55e5b0ebbfc44',
        'university'               => 'field_55e5b0f6bfc45',
        'year_graduating'          => 'field_55e5b100bfc46',
        'major_subject'            => 'field_55e5b104bfc47',
        'previous_foreign_travel'  => 'field_55e5b10fbfc48',
        'reasons'                  => 'field_55e5b11abfc49',
        'prize'                    => 'field_55e5b12cbfc4a',
        'plan_after'               => 'field_55e5b13abfc4b',
        'emergency_first_name'     => 'field_55e5b14fbfc4d',
        'emergency_last_name'      => 'field_55e5b15cbfc4e',
        'emergency_relationship'   => 'field_55e5b164bfc4f',
        'emergency_phone'          => 'field_55e5b176bfc50',
        'emergency_address'        => 'field_55e5b17dbfc51',
        'emergency_address2'       => 'field_55e5b187bfc52',
        'emergency_city'           => 'field_55e5b191bfc53',
        'emergency_zip_code'       => 'field_55e5b19cbfc54',
        'emergency_state'          => 'field_55e5b1acbfc55',
        'emergency_country'        => 'field_55e5b1bcbfc57',
        'reference_1_first_name'   => 'field_55e5b1f4bfc5a',
        'reference_1_last_name'    => 'field_55e5b204bfc5b',
        'reference_1_affilitation' => 'field_55e5b20bbfc5c',
        'reference_1_email'        => 'field_55e5b214bfc5d',
        'reference_2_first_name'   => 'field_55e5b237bfc5f',
        'reference_2_last_name'    => 'field_55e5b245bfc60',
        'reference_2_affilitation' => 'field_55e5b24cbfc61',
        'reference_2_email'        => 'field_55e5b259bfc62',
        'signature_first_name'     => 'field_55e5b270bfc64',
        'signature_last_name'      => 'field_55e5b278bfc65',
        'signature_date'           => 'field_55e5b282bfc66',
        'token'                    => 'field_55e5d3339416b',
    );

    // On ajoute un nouveau post dans les "applicant"
    $post_id = wp_insert_post(array(
        'post_title'  => sprintf('%s %s', $data['first_name'], $data['last_name']),
        'post_type'   => 'applicant',
        'post_status' => 'publish'
    ), true );

    // On ajoute les méta-données
    if ( ! is_wp_error( $post_id ) ) {
        foreach ( $data as $key => $value ) {
            update_field( $acf_mapping[$key], $value, $post_id );
        }
    }

    update_field( $acf_mapping['applicant_status'], 'submitted', $post_id );

    // On envoi l'email de confirmation
    ob_start();
    include get_stylesheet_directory() . '/email/apply.php';
    $message = ob_get_clean();

    wp_mail( $data['email'], __( 'Application submitted!', 'avignon' ), $message, array(
        'Content-Type: text/html; charset=UTF-8'
    ) );

    // On envoi l'email de références
    for ( $reference = 1 ; $reference <= 2 ; $reference++ ) {
        ob_start();
        include get_stylesheet_directory() . '/email/reference.php';
        $message = ob_get_clean();

        wp_mail( $data['reference_' . $reference . '_email'], sprintf( __( 'Your recommendation for %s %s', 'avignon' ), $data['first_name'], $data['last_name'] ), $message, array(
            'Content-Type: text/html; charset=UTF-8'
        ) );
    }
}
add_action( 'gform_after_submission_' . AVIGNON_APPLY_FORM_ID, 'avignon_apply_form_submitted' );

/**
 * Soumission du formulaire de recommendation :
 * - Sauvegarde des données dans l'applicant
 *
 * @param  array $entry
 * @return void
 */
function avignon_recommendation_form_submitted( $entry )
{
    $data = array(
        'first_name'           => $entry[5],
        'last_name'            => $entry[6],
        'affiliation'          => $entry[7],
        'email'                => $entry[8],
        'address'              => $entry[10],
        'address2'             => $entry[11],
        'zip_code'             => $entry[12],
        'city'                 => $entry[13],
        'state'                => $entry[14],
        'country'              => $entry[15],
        'phone'                => $entry[16],
        'recommendation'       => $entry[18],
        'signature_first_name' => $entry[20],
        'signature_last_name'  => $entry[21],
        'signature_email'      => $entry[22],
        'signature_date'       => $entry[23]
    );

    $acf_mapping = array(
        'reference_1_ok'                        => 'field_55e85a97e6ca0',
        'reference_1_data_first_name'           => 'field_55e85a68e6c9c',
        'reference_1_data_last_name'            => 'field_55e85a7fe6c9d',
        'reference_1_data_affiliation'          => 'field_55e85a87e6c9e',
        'reference_1_data_email'                => 'field_55e85a8fe6c9f',
        'reference_1_data_address'              => 'field_55e85ac7e6ca1',
        'reference_1_data_address2'             => 'field_55e85ad4e6ca2',
        'reference_1_data_zip_code'             => 'field_55e85ae6e6ca3',
        'reference_1_data_city'                 => 'field_55e85af0e6ca4',
        'reference_1_data_state'                => 'field_55e85afae6ca5',
        'reference_1_data_country'              => 'field_55e85b01e6ca6',
        'reference_1_data_phone'                => 'field_55e85b0be6ca7',
        'reference_1_data_recommendation'       => 'field_55e85b15e6ca8',
        'reference_1_data_signature_first_name' => 'field_55e85b2de6caa',
        'reference_1_data_signature_last_name'  => 'field_55e85b38e6cab',
        'reference_1_data_signature_email'      => 'field_55e85b1fe6ca9',
        'reference_1_data_signature_date'       => 'field_55e85b40e6cac',
        'reference_2_ok'                        => 'field_55e85b5e8afa6',
        'reference_2_data_first_name'           => 'field_55e85b718afa7',
        'reference_2_data_last_name'            => 'field_55e85b7f8afa8',
        'reference_2_data_affiliation'          => 'field_55e85b888afa9',
        'reference_2_data_email'                => 'field_55e85b948afaa',
        'reference_2_data_address'              => 'field_55e85b9f8afab',
        'reference_2_data_address2'             => 'field_55e85ba98afac',
        'reference_2_data_zip_code'             => 'field_55e85bb58afad',
        'reference_2_data_city'                 => 'field_55e85bbe8afae',
        'reference_2_data_state'                => 'field_55e85bc78afaf',
        'reference_2_data_country'              => 'field_55e85bd28afb0',
        'reference_2_data_phone'                => 'field_55e85bdc8afb1',
        'reference_2_data_recommendation'       => 'field_55e85be58afb2',
        'reference_2_data_signature_first_name' => 'field_55e85c048afb4',
        'reference_2_data_signature_last_name'  => 'field_55e85c0f8afb5',
        'reference_2_data_signature_email'      => 'field_55e85bf68afb3',
        'reference_2_data_signature_date'       => 'field_55e85c188afb6',
    );

    $token = $entry[24];
    $reference_number = $entry[25];

    // On retrouve la pré-inscription correspondante à partir du jeton
    $applicants = get_posts( array(
        'post_type'  => 'applicant',
        'meta_key'   => 'token',
        'meta_value' => $token
    ) );
    if ( count( $applicants ) > 0 ) {
        $applicant =  array_shift( $applicants );
    } else {
        return;
    }

    // Sauvegarde des données
    update_field( $acf_mapping['reference_' . $reference_number . '_ok'], true, $applicant->ID );
    foreach ( $data as $key => $value ) {
        $input = sprintf( 'reference_%s_data_%s', $reference_number, $key );
        update_field( $acf_mapping[$input] , $value, $applicant->ID );
    }
}
add_action( 'gform_after_submission_' . AVIGNON_RECOMMENDATION_FORM_ID, 'avignon_recommendation_form_submitted' );

/**
 * Soumission du formulaire d'upload de l'évaluation médicale.
 *
 * @param  array $entry
 * @return void
 */
function avignon_health_evaluation_submitted( $entry )
{
    $data = array(
        'health_form' => $entry[1],
    );

    $token = $entry[2];

    // On récupère le dossier à partir du jeton
    $applicants = get_posts( array(
        'post_type'  => 'applicant',
        'meta_key'   => 'token',
        'meta_value' => $token
    ) );
    if ( count( $applicants ) > 0 ) {
        $applicant =  array_shift( $applicants );
    } else {
        return;
    }

    // Sauvegarde du formulaire dans le dossier
    update_field( 'healt_form', $data['healt_form'], $applicant->ID );

    // Passage du dossier en "completed"
    update_field( 'applicant_status', 'completed', $applicant->ID );

    // Envoi de l'email de confirmation
    ob_start();
    include get_stylesheet_directory() . '/email/completed.php';
    $message = ob_get_clean();

    wp_mail( get_field( 'email', $applicant->ID ), __( 'You are officially enrolled', 'avignon' ), $message, array(
        'Content-Type: text/html; charset=UTF-8'
    ) );

}
add_action( 'gform_after_submission_' . AVIGNON_HEALTH_EVALUATION_UPLOAD_FORM_ID, 'avignon_health_evaluation_submitted' );

/**
 * Vérification lors de la modification d'un dossier si le status à changé :
 *
 * - Accepté : on envoi l'email d'acceptation
 * - Refusé : on envoi l'email de refus avec le motif.
 *
 * @param  int $post_id
 * @return void
 */
function avignon_applicant_updated( $post_id )
{
    $prev_status = get_field( 'applicant_status' );
    $next_status = $_POST['fields']['field_55e86af1e004f'];

    if ( $prev_status != $next_status ) {
        switch ( $next_status ) {
            case 'accepted':
                // Envoi de l'email d'acceptation
                ob_start();
                include get_stylesheet_directory() . '/email/accepted.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email' ), __( 'You are admitted', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
            case 'refused':
                // Envoi de l'email de refus
                $refused_reasons = $_POST['fields']['field_55e86b22e0050'];
                ob_start();
                include get_stylesheet_directory() . '/email/refused.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email' ), __( 'Your application has been rejected', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
            case 'completed':
                ob_start();
                include get_stylesheet_directory() . '/email/completed.php';
                $message = ob_get_clean();

                wp_mail( get_field( 'email' ), __( 'You are officially enrolled', 'avignon' ), $message, array(
                    'Content-Type: text/html; charset=UTF-8'
                ) );
                break;
        }
    }
}
add_action( 'acf/save_post', 'avignon_applicant_updated', 1 );

