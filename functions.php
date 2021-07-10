<?php
    function mytheme_setup() {
        add_theme_support('wp_block_styles');

        add_theme_support('responsive-embeds');

        add_theme_support('editor-styles');

        add_editor_style('editor-style.css');

        add_theme_support('post-thumbnails');

        add_theme_support('align-wide');
        
        register_nav_menus(array('primary' => 'ナビゲーション'));

        add_theme_support('mycols');
    }

    add_action('after_setup_theme', 'mytheme_setup');

    function mytheme_enqueue() {
        wp_enqueue_style('dashicons');

        wp_enqueue_style('mytheme-style', get_stylesheet_uri(),
         array(), filemtime(get_theme_file_path('/css/style.css')));
    }

    add_action('wp_enqueue_scripts', 'mytheme_enqueue');

    function mytheme_widgets() {
        register_sidebar(array(
            'id' => 'sidebar-1', 'name' => 'フッターメニュー',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>'
        ));
    }

    add_action('widgets_init', 'mytheme_widgets');

    function my_enqueue_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('javascript_js', get_template_directory_uri(). '/js/javascript.js', array());
        wp_enqueue_style('my_styles', get_template_directory_uri(). '/css/style.css', array());
	}

    add_action('wp_enqueue_scripts', 'my_enqueue_scripts');
    
    function custom_comment_form($args) {
        $args['comment_notes_before'] = '';
        $args['comment_notes_after'] = '';
        $args['label_submit'] = '送信';
        return $args;
    }

    add_filter('comment_form_defaults', 'custom_comment_form');

    function my_comment_form_remove($arg) {
        $arg['email'] = '';
        $arg['url'] = '';
        return $arg;
    }

    add_filter('comment_form_default_fields', 'my_comment_form_remove');

    add_filter('get_the_archive_title', function($title) {
        if(is_category()) {
            $title = single_cat_title('',false);
        }
        
        elseif(is_tag()) {
            $title = single_tag_title('',false);
        }
        
        elseif(is_tax()) {
            $title = single_term_title('',false);
        } 
        
        elseif(is_post_type_archive()) {
            $title = post_type_archive_title('',false);
        }
        
        elseif(is_date()) {
            $title = get_the_time('Y年n月');
        }
        
        else {

        }

        return $title;
    });

    add_action('pre_get_posts', 'foo_modify_main_queries');
        function foo_modify_main_queries ($query) {
        if (!is_admin() && $query->is_main_query()) {
            if($query->is_home()) {
            $query->set('post_type', array('post','daily_life'));
            }
        }
    }

    add_action('init', 'tmp_member_custom_post_type');

    function tmp_member_custom_post_type() {
        $labels = array(
            'name'                => 'メンバー',
            'singular_name'       => 'メンバー',
            'add_new_item'        => '新しいメンバーを追加',
            'add_new'             => '新規追加',
            'new_item'            => '新しいメンバー',
            'view_item'           => 'メンバーを表示',
            'not_found'           => 'メンバーはありません',
            'not_found_in_trash'  => 'ゴミ箱にメンバーはありません。',
            'search_items'        => 'メンバーを検索',
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'query_var'           => true,
            'rewrite' => array('slug' => 'member', 'with_front' => false),
            'hierarchical'        => false,
            'menu_position'       => 5,
            'has_archive'         => true,
            'yarpp_support'       => true,
            'capability_type'     => 'post',
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'custom-fields'
        ));

        register_post_type('member', $args);
        flush_rewrite_rules(true);
            
        register_taxonomy(
            'daily_life',
            array('member'),
            array(
                'hierarchical' => true,
                'update_count_callback' => '_update_post_term_count',
                'label' => 'カテゴリー',
                'singular_label' => 'カテゴリー',
                'public' => true,
                'show_ui' => true,
        ));
    }