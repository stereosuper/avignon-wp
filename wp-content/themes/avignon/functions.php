<?php

define( 'AVIGNON_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/* General
/*-----------------------------------------------------------------------------------*/
// Theme support
add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'widgets') );
add_theme_support( 'post-thumbnails' );

// Feed
add_theme_support( 'automatic-feed-links' );
function remove_comments_rss( $for_comments ){ return; }
add_filter('post_comments_feed_link', 'remove_comments_rss');

// Admin bar
//if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar(false);
//}

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
        'secondary-study' => 'Sidebar Menu - Study',
        'secondary-live' => 'Sidebar Menu - Live',
        'secondary-alumni' => 'Sidebar Menu - Alumni',
        'footer-study' => 'Footer Menu - Study',
        'footer-live' => 'Footer Menu - Live'
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
function avignon_register_sidebars(){
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
            the_field( 'application_status', $post_id );
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
    add_image_size( 'gallery-thumb', 290, 215, true );
}
add_action( 'after_setup_theme', 'avignon_thumbnail_sizes' );

function avignon_sizes_admin( $sizes ) {
    return array_merge( $sizes, array(
        'gallery-thumb' => 'Gallery size',
    ) );
}
add_filter( 'image_size_names_choose', 'avignon_sizes_admin' );

/*-----------------------------------------------------------------------------------*/
/* Custom excerpt
/*-----------------------------------------------------------------------------------*/
function custom_wp_trim_excerpt($wpse_excerpt) {
    $raw_excerpt = $wpse_excerpt;

    if( '' == $wpse_excerpt ){
        $wpse_excerpt = get_the_content('');
        $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
        $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
        $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
        $wpse_excerpt = strip_tags($wpse_excerpt, '<em>,<i>,<strong>,<b>');

        $excerpt_length = apply_filters('excerpt_length', 14);
        $tokens = array();
        $excerptOutput = '';
        $count = 0;

        preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

        foreach($tokens[0] as $token){

            if($count >= $excerpt_length /*&& preg_match('/[\,\;\?\.\!]\s*$/uS', $token)*/){ //pour arreter l'extrait a un point ou une virgule, etc
                $excerptOutput .= trim($token);
                break;
            }

            $count++;
            $excerptOutput .= $token;
        }

        $wpse_excerpt = trim(force_balance_tags($excerptOutput));
        $wpse_excerpt .= '...';

        return $wpse_excerpt;

    }
    return apply_filters('custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');

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

// Add Shortcode
function encart_shortcode( $atts , $content = null ){
    extract( shortcode_atts(
        array(
            'align' => '',
            'text' => ''
        ), $atts )
    );

    if($align == 'right'){
        $output = "<div class='encart'><p>".$text."</p><div class='encart-img'>".$content."</div></div>";
    }else{
        $output = "<div class='encart'><div class='encart-img'>".$content."</div><p>".$text."</p></div>";
    }

    return $output;
}
add_shortcode( 'encart', 'encart_shortcode' );

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

// Page d'options
function custom_menu_order( $menu_ord ){
    if(!$menu_ord) return true;
    $menu = 'acf-options';
    $menu_ord = array_diff($menu_ord, array( $menu ));
    array_splice( $menu_ord, 1, 0, array( $menu ) );
    return $menu_ord;
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');

// Remove default WYSIWYG editor in Home
function hide_editor() {
    if(isset($_GET['post']) || isset($_POST['post_ID'])){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    }
    if( !isset( $post_id ) ) return;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if($template_file == 'front-page.php'){
        remove_post_type_support('page', 'editor');
    }
}
add_action( 'admin_init', 'hide_editor' );

// Remove some WP stuff Rudy doesn't need to see on main menu
function remove_menu_items(){
    $current_user = wp_get_current_user();

    if( $current_user->user_login == 'rudy' ){
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit.php?post_type=acf' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'wpseo_dashboard' );
        remove_menu_page( 'WP-Optimize' );
    }
}
add_action('admin_menu', 'remove_menu_items', 99);

// Remove some WP stuff Rudy doesn't need to see on admin bar
function remove_admin_bar_items( $wp_admin_bar ){
    $current_user = wp_get_current_user();

    if( $current_user->user_login == 'rudy' ){
        $wp_admin_bar->remove_node( 'wp-logo' );
        $wp_admin_bar->remove_node( 'comments' );
        $wp_admin_bar->remove_node( 'wpseo-menu' );
    }
}
add_action( 'admin_bar_menu', 'remove_admin_bar_items', 99 );

/*-----------------------------------------------------------------------------------*/
/* Calendar - Generate .ics file (events and activities)
/*-----------------------------------------------------------------------------------*/
include_once( get_template_directory() . '/functions/ics.php' );

/*-----------------------------------------------------------------------------------*/
/* FORMULAIRE GRAVITY FORMS
/*-----------------------------------------------------------------------------------*/
// Main functions
include_once( get_template_directory() . '/functions/gravity.php' );

// Navigation multipage.
include_once( get_template_directory() . '/functions/gf-multipage-navigation.php' );
new GWMultipageNavigation(array('activate_on_last_page' => false));

/*-----------------------------------------------------------------------------------*/
/* Disable fb comments on custom posts
/*-----------------------------------------------------------------------------------*/
function disable_fb_custom( $post_ID, $post ){
    if( $post->post_type == 'post' ){
        return;
    }
    update_post_meta($post_ID, '_disable_fbc', 'on' );
}
add_action( 'save_post', 'disable_fb_custom', 10, 2 );

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
