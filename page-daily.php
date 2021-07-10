<?php get_header(); ?>

    <main class="mycontainer">
        <div class="alignwide">
            <div class="myposthead">
                <h1>日誌</h1>
                <p>DAILY LIFE</p>
            </div>

            <div class="mypostlist">
                <?php
                    $terms = get_terms('event');
                    foreach($terms as $term):
                ?>
                <article class="article-daily">
                    <a class="daily-link" href="<?php echo get_term_link($term); ?>">
                        <div class="daily-image">
                            <?php 
                                $image_id = get_field('event_image', $term->taxonomy. '_'. $term->term_id);
                                echo wp_get_attachment_image($image_id, 'daily_life');
                            ?>
                        </div>

                        <div class="daily-body">
                            <h2 class="daily-title"><?php echo $term->name; ?></h2>
                            <p class="daily-excerpt"><?php echo $term->description; ?></p>
                        </div>
                    </a>
                </article>
                <?php endforeach; ?>
            </div>

            <div class="myposthead">
                <h2 class="daily-sub-title">最新情報</h2>
                <p>RECENT</p>
            </div>

            <div class="mypostlist">
                <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $posts = new WP_Query(array(
                        'post_status' => 'publish',
                        'post_type' => 'daily_life',
                        'paged' => $paged,
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC')
                    );

                    if(have_posts()): while($posts->have_posts()): $posts->the_post();
                ?>

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
                <?php endwhile; endif; wp_reset_query(); ?>
            </div>

            <?php wp_pagenavi(array('query' => $posts)); ?>
        </div>
    </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>