<?php

/**
 * Custom template tags
 *
 * @package OKFNWP
 */
function paging_nav() {
    global $wp_query, $wp_rewrite;

    // Don't print empty markup if there's only one page.
    if ($wp_query->max_num_pages < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'format' => $format,
        'total' => $wp_query->max_num_pages,
        'current' => $paged,
        'mid_size' => 1,
        'add_args' => array_map('urlencode', $query_args),
        'prev_text' => __('&larr; Previous', 'okfnwp'),
        'next_text' => __('Next &rarr;', 'okfnwp'),
    ));

    if ($links) :
        ?>
        <nav class="blog-pagination" role="navigation">
          <?php echo $links; ?>
        </nav><!-- .blog-pagination -->
        <?php
    endif;
}

function breadcrumbs() {

    // Don't show breadcrumbs on the Home page
    if (is_home()):
        return;
    endif;

    global $post;
    echo '<ul class="breadcrumb">';

    echo '<li><a href="' . home_url() . '">Home</a></li>';

    // Temporarily disable this link in the breadcrumbs
    //if (!is_page() && !is_404()) :
    //    echo '<li><a href="' . get_permalink(get_option('page_for_posts')) . '">' . __('Blog', 'okfn') . '</a></li>';
    //endif;

    if (is_404()) :
        echo '<li>' . __('Page not found', 'okfnwp') . '</li>';
    endif;

    if (is_category() || is_single()) :
        $category = get_the_category();
        $category = $category[0];
        echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
    endif;

    if (is_single()) :
        echo '<li>' . get_the_title() . '</li>';
    endif;

    if (is_page()) :
        if ($post->post_parent) :
            $anc = get_post_ancestors($post->ID);
            $title = get_the_title();
            foreach ($anc as $ancestor) :
                $output = '<li><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            endforeach;
            echo $output;
            echo '<li>' . $title . '</li>';
        else :
            echo '<li>' . get_the_title() . '</li>';
        endif;
    endif;

    if (is_tag()) :
        echo '<li>' . single_tag_title("", false) . '</li>';

    elseif (is_day()) :
        echo '<li>Archive for ' . get_the_time('F jS Y') . '</li>';

    elseif (is_month()) :
        echo '<li>Archive for ' . get_the_time('F Y') . '</li>';

    elseif (is_year()) :
        echo '<li>Archive for ' . get_the_time('Y') . '</li>';

    elseif (is_author()) :
        echo '<li>Author Archive</li>';

    elseif (get_query_var('paged') && !empty(get_query_var('paged'))) :
        echo '<li>Blog Archives</li>';

    elseif (is_search()) :
        echo '<li>Search Results</li>';
    endif;

    echo '</ul>';
}
