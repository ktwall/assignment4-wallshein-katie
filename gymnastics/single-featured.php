<?php 
    /* Template Name: Featured 
    Template Post Type: Post
    */ 


get_header(); ?>

<main>

    <?php   
        if(have_posts()){
            while(have_posts()){
                the_post(); ?> 

                    <div class="featured-image">
                        <?php
                            the_post_thumbnail('large');
                        ?>
                        <div class="text-overlay container">
                
                            <h2><?php the_title(); ?></h2>
                            <?php
                                the_field('sub-heading');
                            ?>
                           
                        </div>
                    </div>
                    <div class="single-post container">
                        <div class="text-container">


                            <p class="body-content"><?php the_content(); ?></p>
                    </div>
                </div>

                <div class="cta-section">
                    <h2><?php get_field('cta_heading'); ?></h2>
                    <p><?php get_field('cta_text'); ?></p>

                    <button><a href="<?php the_field('cta_url'); ?>"><?php the_field('cta_button'); ?></a></button>
                </div> 

                <?php
                // echo get_the_title();
            }
        }
    ?>
</main>
<aside class="container">
    <?php
        $args = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'order'             => 'DESC',
            'orderby'           => 'date',
            'category_name'     => 'featured-news'
        );

        $query = new WP_Query($args);

        if($query->have_posts()){
            while($query->have_posts()){
                $query->the_post(); ?>

                        <div class="individal-post col-md-4">
                            <div class="featured-image">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                            <div class="text-container">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </div>
            <?php }
        }
    ?> 

</aside>
<?php get_footer(); ?>