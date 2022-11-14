<?php get_header(); ?>

<div class="container">
    <div class="class row">
        <div class="class col-md-9">
            <h2 class="date-title"><?php  
            if(is_day()){
                echo "Daily Archives: " . get_the_date();
            }elseif(is_month()){
                echo "Monthly Archives: " . get_the_date('F Y');
            }elseif(is_year()){
                echo "Yearly ARchives: " . get_the_date('Y');
            }
            ?> 

            </h2>
            <?php
                    if(have_posts()){
                        while(have_posts()){
                            the_post(); ?>

                            <article class="individual-post">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php
                                    //Display author and publish date links
                                    post_data(); 
                                ?>

                                <div class="image-excerpt-container">
                                    <?php the_post_thumbnail('medium'); ?>
                                    <?php the_excerpt(); ?>
                                </div>
                            </article> 

                        <?php }
                        //End while 

                        //Pagination
                        proPhotographyPagination();
                    }
                ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 