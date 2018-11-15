<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();
?>

            <div id="tm-main" class="tm-main uk-section uk-section-default" uk-height-viewport="expand: true">
                <div class="uk-container">

                    <?php
                        $grid = ['uk-grid']; $sidebar = $theme->get('sidebar', []);
                        $grid[] = $sidebar['gutter'] ? "uk-grid-{$sidebar['gutter']}" : '';
                        $grid[] = $sidebar['divider'] ? "uk-grid-divider" : '';
                    ?>

                    <div<?= get_attrs(['class' => $grid, 'uk-grid' => true]) ?>>
                        <div class="uk-width-expand@<?= $theme->get('sidebar.breakpoint') ?>">

                            <?php if ($site['breadcrumbs']) : ?>
                            <div class="uk-margin-medium-bottom">
                                <?= get_section('breadcrumbs') ?>
                            </div>
                            <?php endif ?>
							
							<?php
// Container
$attrs_container = [];

if ($theme->get('post.content_width')) {
    $attrs_container['class'][] = 'uk-container uk-container-small';
}

if (have_posts()) :

    while (have_posts()) : the_post();

        get_template_part('templates/post/content', get_post_format());

        if ($attrs_container) :
            printf('<div%s>', get_attrs($attrs_container));
        endif;

        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

        if ($attrs_container) :
            echo '</div>';
        endif;

    endwhile;

endif;

get_footer();
