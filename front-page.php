<?php get_header(); ?>

<main <?php post_class('mycontainer'); ?>>
    <?php the_content(); ?>

    <div class="alignwide">
        <div class="myposthead">
            <h1>最新情報</h1>
            <p>RECENT</p>
        </div>

        <div class="mypostlist">
            <?php $myposts = get_posts(array('posts_per_page' => '6')); ?>

            <?php if($myposts): foreach($myposts as $post): setup_postdata($post); ?>

                <article>
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>

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

                <?php endforeach; wp_reset_postdata(); endif; ?>
            </div>
        </div>
     </div>
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>