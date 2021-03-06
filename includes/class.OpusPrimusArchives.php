<?php
/**
 * Opus Primus Archives
 * Site archives for categories, tags, pages, etc.
 *
 * @package     OpusPrimus
 * @since       0.1
 *
 * @author      Opus Primus <in.opus.primus@gmail.com>
 * @copyright   Copyright (c) 2012-2013, Opus Primus
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

class OpusPrimusArchives {
    /** Construct */
    function __construct() {}


    /**
     * Opus Primus Category Archive
     * Displays all of the categories with links to their respective category
     * archive page using `wp_list_categories` and all of its parameters.
     *
     * @link    http://codex.wordpress.org/Function_Reference/wp_list_categories
     * @example categories_archive( array( 'number' => 12 ) );
     * @internal The above example will use the default parameters but limit the output to 12 items
     *
     * @package OpusPrimus
     * @since   0.1
     *
     * @param   array|string $category_args
     *
     * @uses    wp_list_categories
     * @uses    wp_parse_args
     */
    function categories_archive( $category_args = '' ) {
        /** Add empty hook before category archive */
        do_action( 'opus_before_category_archive' );

        /** @var $defaults - set the default parameters */
        $defaults = array(
            'orderby'       => 'name',
            'order'         => 'ASC',
            'hierarchical'  => 0,
            'title_li'      => __( 'All Categories:', 'opusprimus' ),
        );
        $category_args = wp_parse_args( (array) $category_args, $defaults );

        echo '<ul class="archive category list cf">';
            wp_list_categories( $category_args );
        echo '</ul><!-- .archive.category.list -->';

        /** Add empty hook after category archive */
        do_action( 'opus_after_category_archive' );

    } /** End function categories archive */


    /**
     * Opus Primus Archive Cloud
     * Displays a cloud of links to the "post tag" and "category" taxonomies by
     * default; standard `wp_tag_cloud` parameters can be passed to change the
     * output.
     *
     * @link    http://codex.wordpress.org/Function_Reference/wp_tag_cloud
     * @example archive_cloud( array( 'taxonomy' => 'post_tag', 'number' => 10 ) );
     * @Internal The above example shows only the top 10 post tags.
     *
     * @package OpusPrimus
     * @since   0.1
     *
     * @param   string $cloud_args
     * @internal defaults = show post tags and categories, formatted as a list, in a random order
     *
     * @uses    wp_parse_args
     * @uses    wp_tag_cloud
     */
    function archive_cloud( $cloud_args = '' ) {
        /** Add empty hook before archive cloud */
        do_action( 'opus_before_archive_cloud' );

        /** @var $defaults - initial values to be used as parameters */
        $defaults = array(
            'taxonomy'  => array(
                'post_tag',
                'category',
            ),
            'format'    => 'list',
            'order'     => 'RAND',
        );
        $cloud_args = wp_parse_args( (array) $cloud_args, $defaults );

        /** @var $cloud_classes - initialize variable to empty in case no conditions are met */
        $cloud_classes = '';

        /** Top 'number' of displayed tags set */
        if ( isset( $cloud_args['number'] ) && ( 'DESC' == $cloud_args['order'] ) ) {
            $cloud_classes .= 'top-' . $cloud_args['number'];
            $cloud_title = sprintf( __( 'The Top %1$s Tags Cloud:', 'opusprimus' ), $cloud_args['number'] );
        } /** End if - isset */

        /** If a cloud class has been created then make sure to add a space before so it will be properly added to the class list */
        if ( ! empty( $cloud_classes ) ) {
            $cloud_classes = ' ' . $cloud_classes;
        } /** End if not empty */

        /** Default title */
        if ( empty( $cloud_title ) ) {
            $cloud_title = __( 'The Cloud:', 'opusprimus' );
        } /** End if empty */

        if ( isset( $cloud_args['format'] ) && ( 'flat' == $cloud_args['format'] ) ) {
            $cloud_title .= '<br />';
        } /** End if isset */

        /**
         * Output the cloud with a title wrapped in an element with dynamic
         * classes.
         */
        printf( '<ul class="archive cloud list cf%1$s">', $cloud_classes );
            echo '<li><span class="title">' . $cloud_title . '</span>';
                wp_tag_cloud( $cloud_args );
            echo '</li>';
        echo '</ul><!-- .archive.cloud.list -->';

        /** Add empty hook after archive cloud */
        do_action( 'opus_after_archive_cloud' );

    } /** End function archive cloud */


} /** End Class Opus Primus Archives */

/** @var $opus_archives - new instance of class */
$opus_archives = new OpusPrimusArchives();