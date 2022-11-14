<?php
    /*
        Template Name: Hero Image
        Template Post Type: page
    */ 

    get_header();

    if(have_posts()){
        while(have_posts()){
            the_post(); ?> 

            <div class="hero-container">
                <div class="hero-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>

                <div class="hero-title container">
                    <h2><?php the_title(); ?></h2>

                </div>
            </div>

            <divi class="container">
                <div class="row">
                    <main class="col-md-9">
                        <section>
                            <?php the_content(); ?> 
                        </section>
                    </main>

                    <aside class="col-md-3">
                        <?php get_sidebar(); ?> 
                    </aside>
                </div>
            </divi>
        <?php } //end while
    } //end of if 

get_footer(); ?> 