<?php
/**
 * Template part for displaying post content in page.php
 *
 * @package WordPress
 * @subpackage Higo
 * @since 1.0.0
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

    <header class="entry-header c-article__header">
        <?php the_title( '<h1 class="post-title c-article__title"><span>', '</span></h1>' ); ?>
    </header>

    <div class="entry-content c-article__content">
        <?php

        the_content();

        wp_link_pages();
        ?>
    </div>

    <?php if ( get_edit_post_link() ) : ?>
        <footer calss="entry-footer c-article__footer">
            <?php edit_post_link(); ?>
        </footer>
    <?php endif; ?>

</article>
