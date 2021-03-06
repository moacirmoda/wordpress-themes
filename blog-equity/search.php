<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<?php
                //Set default variables related to current language when multi-language-framework is not installed
                $top_bar = "top_sidebar";
                $footer_bar = "footer_sidebar";
                $column1 = "column-1";
                $column3 = "column-3";
		$level2 = "level2";

                if(is_plugin_active('multi-language-framework/multi-language-framework.php')) {
                        $top_bar .= $current_language;
                        $footer_bar .= $current_language;
                        $column1 .= $current_language;
                        $column3 .= $current_language;
                }

                if ($top_sidebar == true){
        ?>
                <div class="top_sidebar">
			<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                        <?php dynamic_sidebar( $top_bar ); ?>
                </div>
        <?php
                }
        ?>
	<section id="primary" class="site-content">
		<div class="c1">
                        <?php dynamic_sidebar( $level2 ); ?>
                </div>
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>



			<?php /* Start the Loop */

			while ( have_posts() ) : the_post();

                                /* Include the post format-specific template for the content. If you want to
                                 * this in a child theme then include a file called called content-___.php
                                 * (where ___ is the post format) and that will be used instead.
                                 */
                                //get_template_part( 'content', get_post_format() );
                        ?>
                                <header class="entry-header">
                                        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<div class="meta-block">
<?php
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
        if ( '' != $tag_list ) {                $utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>.', 'twentyeleven' );
        } elseif ( '' != $categories_list ) {                $utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>.', 'twentyeleven' );
        } else {                $utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>.', 'twentyeleven' );
        }

        printf(
                $utility_text,
                $categories_list,
                $tag_list,
                esc_url( get_permalink() ),
                the_title_attribute( 'echo=0' ),
                get_the_author(),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
        );
?>
</div>


                                        <?php the_excerpt(); ?>
                                </header>
                                <hr />
                        <?php
                        endwhile; ?>

			<?php if(function_exists('wp_paginate')) {
                                 wp_paginate();
                        }
                        else {
                                twentytwelve_content_nav( 'nav-below' );
                        }
                        ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
		<div class="c3">
                        <?php dynamic_sidebar( $column3 ); ?>
                </div>
                <div class="spacer"></div>
	</section><!-- #primary -->
<?php
        if ($footer_sidebar == true){
        ?>
        <div class="footer_sidebar">
                <?php dynamic_sidebar( $footer_bar ); ?>
		<?php wp_nav_menu(array('theme_location' => 'bottom')); ?>
        </div>
        <div class="spacer"></div>
        <?php
        }
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
