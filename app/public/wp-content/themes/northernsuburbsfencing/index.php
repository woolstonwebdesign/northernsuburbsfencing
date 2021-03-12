<?php
get_header();
	if (have_posts()):
        while(have_posts()): the_post();
            if (is_front_page()):
                get_template_part('template-parts/content-home');
            else:
                echo '<main class="site-main" role="main">';
                get_template_part('template-parts/content', 'page');
                echo '</main>';
            endif;
        endwhile;
    endif;

    get_footer();
?>