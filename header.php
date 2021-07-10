<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php bloginfo('name'); ?></title>
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Vollkorn:400i" rel="stylesheet"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/208e85060d.js" crossorigin="anonymous"></script>

    <?php if(is_single()): ?>
        <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
        <meta property="og:locate" content="ja_JP">
        <meta property="og:type" content="article">
        <meta property="og:title" content="<?php the_title(); ?>">
        <meta property="og:url" content="<?php the_permalink(); ?>">
        <meta property="og:description" content="<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>">

        <?php if(has_post_thumbnail()): ?>
        <?php $myimg = get_post_thumbnail_id(); ?>
        <meta property="og:image" content="<?php echo esc_url(wp_get_attachment_url($myimg)); ?>">
        <meta property="og:image:width" content="<?php echo esc_attr(wp_get_attachment_metadata($myimg)['width']); ?>">
        <meta property="og:image:height" content="<?php echo esc_attr(wp_get_attachment_metadata($myimg)['height']); ?>">
        <?php endif; ?>

        <meta name="twitter:card" content="summary_large_image">
        <meta property="fb:app_id" content="xxxxxxxxxxxxxxxxxx">
    <?php endif; ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="head">
        <header class="myhead mycontainer">
            <div class="alignwide">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo("name"); ?>
                </a>

                <p>
                    <?php bloginfo('description'); ?>
                </p>
            </div>
        </header>

        <?php if(has_nav_menu('primary')): ?>
            <nav class="mynav">
                <div class="mycontainer">
                    <div class="alignwide">
                        <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                    </div>
                </div>
            </nav>
        <?php endif; ?>
    </div>

    <div
    <?php if(!is_front_page() && current_theme_supports('mycols')): ?>
        class="mycols"
    <?php endif; ?>>
        <div class="mycontent">
    
            <div class="mycontainer">
                <div class="alignwide">
                    <?php if(!is_front_page()): ?>
                        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                            <?php if(function_exists('bcn_display'))
                                bcn_display();
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>