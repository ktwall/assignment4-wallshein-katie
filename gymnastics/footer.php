    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php
                        if(has_nav_menu('footer-left')){ ?>
                            <nav class="footer-menu">
                                <?php
                                    wp_nav_menu(array(
                                'theme_location' => 'footer-left'
                            ));
                        ?>
                        </nav>
                    <?php }else{
                        echo "<p>Please select a main menu through the dashboard</p.";
                    } ?>
                </div>

                <div class="col-md-4">
                <?php
                        if(has_nav_menu('footer-middle')){ ?>
                            <nav class="footer-menu">
                                <?php
                                    wp_nav_menu(array(
                                'theme_location' => 'footer-middle'
                            ));
                        ?>
                        </nav>
                    <?php }else{
                        echo "<p>Please select a main menu through the dashboard</p.";
                    } ?>
                </div>

                <div class="col-md-4">
                    <?php
                        dynamic_sidebar('right-footer-widget');
                    ?>
                    </div>
                </div>
        </div>
    </footer>
    <?php wp_footer(); ?> 
    </body>
</html>
