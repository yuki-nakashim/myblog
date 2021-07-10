<?php get_header(); ?>

    <main class="mycontainer">
        <div class="alignwide">

            <div class="myposthead">
                <h1><?php the_archive_title(); ?></h1>
                <?php if(is_category()): ?>
                    <p>CATEGORY ARCHIVE</p>
                <?php elseif(is_month()): ?>
                    <p>MONTHLY ARCHIVE</p>
                <?php endif; ?>
            </div>

            <div class="mypostlist">
                <?php if(have_posts()): while(have_posts()): the_post(); ?>

                <article <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>

                        <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                                <?php echo esc_html(get_the_date()); ?>
                        </time>

                        <?php if(has_post_thumbnail()): ?>
                            <figure>
                                <?php the_post_thumbnail(); ?>
                            </figure>
                        <?php endif; ?>
                    </a>
                </article>
                
                <?php endwhile; endif; ?>
            </div>

            <?php wp_pagenavi(); ?>
        </div>
    </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>