<?php
get_header();
?>
<main class="site-main" role="main">
<?php
	if (have_posts()):
        while(have_posts()): the_post();
            if (is_front_page()):
                get_template_part('template-parts/content', 'page-header');
                get_template_part('template-parts/content-home');
            else:
                get_template_part('template-parts/content', 'page-header');
                get_template_part('template-parts/content', 'page');
            endif;
        endwhile;
    endif;
?>
</main>
<?php
    get_footer();
?>