<?php
/**
 * Opus Primus Navigation
 * Controls for the navigation between multi-page posts, site pages, and menu
 * navigation structures.
 *
 * @package     OpusPrimus
 * @since       0.1
 *
 * @author      Opus Primus <in.opus.primus@gmail.com>
 * @copyright   Copyright (c) 2012, Opus Primus
 *
 * This file is part of Opus Primus.
 *
 * Opus Primus is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

class OpusPrimusNavigation {
    /** Construct */
    function __construct() {}

    /**
     * === Functions List ( in order of appearance ) ===
     * - Opus Link Pages
     * - Opus Posts Link
     * - Opus Post Link
     * - Opus Primus Primary Menu
     * - Opus Primus Page Menu
     * - Opus Primary Menu
     * - Opus Primus Secondary Menu
     * - Opus Secondary Menu
     * - Opus Primus Search Page Menu
     * - Opus Primus Search Menu
     * - Opus Search Menu
     * - Opus Primus Comments Navigation
     */

    /**
     * Opus Link Pages
     * Outputs the navigation structure to move between multiple pages from the
     * same post. All parameters used by `wp_link_pages` can be passed through
     * the function.
     *
     * @link    http://codex.wordpress.org/Function_Reference/wp_link_pages
     * @example opus_link_pages( array( 'before' => '<p class="navigation link-pages cf">', 'after' => '</p>' ) );
     * @internal The above example will output the `wp_link_pages` output in a
     * wrapper consisting of a `p` tag with `classes`
     *
     * @package OpusPrimus
     * @since   0.1
     *
     * @param   string|array $link_pages_args
     * @param   string $preface - leading word or phrase before display of post page index - MUST set $link_pages_args for this to display.
     *
     * @uses    do_action
     * @uses    wp_link_pages
     */
    function opus_link_pages( $link_pages_args = '', $preface = '' ) {
        /** @var $defaults - initial values */
        $defaults = array(
            'before'    => '<p class="navigation opus-link-pages cf">' . '<span class="opus-link-pages-preface">' . $preface . '</span>',
            'after'     => '</p>',
        );
        $link_pages_args = wp_parse_args( (array) $defaults, $link_pages_args );

        /** Add empty hook before linking pages navigation of a multi-page post */
        do_action( 'opus_before_links_pages' );

        /** Linking pages navigation */
        wp_link_pages( $link_pages_args );

        /** Add empty hook after linking pages navigation of a multi-page post */
        do_action( 'opus_after_link_pages' );

    }

    /**
     * Opus Posts Link
     * Outputs the navigation structure to move between archive pages
     *
     * @package OpusPrimus
     * @since   0.1
     *
     * @uses    do_action
     * @uses    next_posts_link
     * @uses    previous_posts_link
     */
    function opus_posts_link() {
        /** Add empty hook before posts link */
        do_action( 'opus_before_posts_link' );

        /** Posts link navigation */ ?>
        <p class="navigation posts-link cf">
            <span class="right"><?php next_posts_link(); ?></span>
            <span class="left"><?php previous_posts_link(); ?></span>
        </p>

        <?php
        /** Add empty hook after posts link */
        do_action( 'opus_after_posts_link' );

    }

    /**
     * Opus Post Link
     * Outputs the navigation structure to move between posts
     *
     * @package OpusPrimus
     * @since   0.1
     *
     * @uses    do_action
     * @uses    next_posts_link
     * @uses    previous_posts_link
     */
    function opus_post_link() {
        /** Add empty hook before post link */
        do_action( 'opus_before_post_link' );

        /** Post link navigation */ ?>
        <hr class="pre-post-link-navigation" />
        <p class="navigation post-link cf">
            <span class="right"><?php next_post_link(); ?></span>
            <span class="left"><?php previous_post_link(); ?></span>
        </p>

        <?php
        /** Add empty hook after post link */
        do_action( 'opus_after_post_link' );

    }


    /**
     * Opus Primus Comments Navigation
     * Displays a link between pages of comments
     *
     * @package OpusPrimus
     * @since   0.1
     *
     * @uses    do_action
     * @uses    next_comments_link
     * @uses    previous_comments_link
     */
    function comments_navigation() {
        /** Add empty hook before comments link */
        do_action( 'opus_before_comments_link' ); ?>

        <p class="navigation comment-link cf">
            <span class="left"><?php previous_comments_link() ?></span>
            <span class="right"><?php next_comments_link() ?></span>
        </p>

        <?php
        /** Add empty hook after comments link */
        do_action( 'opus_after_comments_link' );
    }


    function image_nav() {
        /** Add empty hook before the image navigation */
        do_action( 'opus_before_image_nav' );

        /** Add navigation links between pictures in the gallery */
        echo '<div class="opus-image-navigation cf">';
            echo previous_image_link( false, '<span class="left">' . __( 'Previous Photo', 'opusprimus' ) . '</span>' );
            echo next_image_link( false, '<span class="right">' . __( 'Next Photo', 'opusprimus' ) . '</span>' );
        echo '</div><!-- .opus-image-navigation -->';

        /** Add empty hook after the image navigation */
        do_action( 'opus_after_image_nav' );

    }
}
$opus_nav = new OpusPrimusNavigation();