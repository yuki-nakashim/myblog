<?php get_header(); ?>

    <main class="mycontainer">
        <div class="alignwide">
            <div class="myposthead">
                <h1>最新情報</h1>
                <p>RECENT</p>
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

            <div class="myposthead">
                <h1>カテゴリー</h1>
                <p>CATEGORY</p>
            </div>

            <div class="mypostlist">
                <?php
                    $terms = get_terms('category');
                    foreach($terms as $term):
                ?>
                <article class="article-category">
                    <a class="daily-link" href="<?php echo get_term_link($term); ?>">
                        <div class="category-image">
                            <?php 
                                $image_id = get_field('category_image', $term->taxonomy. '_'. $term->term_id);
                                echo wp_get_attachment_image($image_id, 'category');
                            ?>
                        </div>

                        <div class="category-body">
                            <h2 class="daily-title"><?php echo $term->name; ?></h2>
                            <p class="daily-excerpt"><?php echo $term->description; ?></p>
                        </div>
                    </a>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>