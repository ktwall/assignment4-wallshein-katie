<?php get_header(); ?>

<main class="container">

    <?php   
        if(have_posts()){
            while(have_posts()){
                the_post(); ?> 

                <div class="single-employee">
                    <h2><?php the_title(); ?></a></h2>
                    <div class="row">
                        <div class="col-md-2 employee-headshot">
                            <?php 
                                the_post_thumbnail('thumb'); 
                            ?> 
                        </div>

                        <div class="text-container col-md-9">
                            <?php the_content(); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</main>
<?php get_footer(); ?>