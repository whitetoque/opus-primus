<?php
/**
 * Comments Template
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
 *
 * @todo Review general commentary look and feel ... make more unique to OP
 */

/** Call the global variables needed */
global $wp_query, $opus_navigation; ?>

<!-- Show the comments -->
<!-- Inspired by http://digwp.com/2010/02/separate-comments-pingbacks-trackbacks/ -->
<div class="comments-wrapper">
    <?php if ( have_comments() ) { ?>

        <h2 id="all-comments">
            <?php comments_number( __( 'No Responses', 'opusprimus' ), __( 'One Response', 'opusprimus' ), __( '% Responses', 'opusprimus' ) ); ?>
        </h2><!-- #all-comments -->

        <?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
            <h3 id="comments">
                <?php printf( __( '%1$s Comments', 'opusprimus' ), count( $wp_query->comments_by_type['comment'] ) ); ?>
            </h3><!-- #comments -->
            <ul class="comments-list">
                <?php wp_list_comments( 'type=comment' ); ?>
            </ul><!-- comments-list -->
            <?php $opus_navigation->comments_navigation();
        } /** End if - comments by type - comment */

        if ( ! empty( $comments_by_type['pingback'] ) ) { ?>
            <h3 id="pingbacks">
                <?php printf(
                _n(
                    __( '%1$s Pingback', 'opusprimus' ),
                    __( '%1$s Pingbacks', 'opusprimus' ),
                    count( $wp_query->comments_by_type['pingback'] ) ),
                count( $wp_query->comments_by_type['pingback'] )
                ); ?>
            </h3><!-- #pingbacks -->
            <ul class="pingbacks-list">
                <?php wp_list_comments( 'type=pingback' ); ?>
            </ul><!-- pingbacks-list -->
            <?php $opus_navigation->comments_navigation();
        } /** End if - comments by type - pingback */

        if ( ! empty( $comments_by_type['trackback'] ) ) { ?>
            <h3 id="trackbacks">
                <?php printf(
                _n(
                    __( '%1$s Trackback', 'opusprimus' ),
                    __( '%1$s Trackbacks', 'opusprimus' ),
                    count( $wp_query->comments_by_type['trackback'] ) ),
                count( $wp_query->comments_by_type['trackback'] )
                ); ?>
            </h3><!-- #trackbacks -->
            <ul class="trackbacks-list">
                <?php wp_list_comments( 'type=trackback' ); ?>
            </ul><!-- trackbacks-list -->
            <?php $opus_navigation->comments_navigation();
        } /** End if - comments by type - trackback */

    } /** End if - have comments */

    comment_form(); ?>

</div><!-- .comments-wrapper -->