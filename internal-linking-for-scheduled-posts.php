<?php

/*
Plugin Name: Internal Linking for Scheduled Posts
Description: Add scheudled posts to the internal linking dialog in the WordPress editor.
Version: 1.01
Author: Evan Solomon
Author URI: http://evansolomon.me
*/

/**
 * Copyright (c) 2012 Evan Solomon.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */


function es_internal_linking_for_scheduled_posts( $query ) {
	// Make sure this is a requent for internal linking
	if ( ! isset( $_POST ) || ! isset( $_POST['action'] ) || 'wp-link-ajax' != $_POST['action'] )
		return false;

	// Add scheduled posts to the query if it's not there yet
	$post_status = (array) $query->query_vars['post_status'];
	if ( ! in_array( 'future', $post_status ) )
		$post_status[] = 'future';

	$query->set( 'post_status', $post_status );
}
add_action( 'pre_get_posts', 'es_internal_linking_for_scheduled_posts' );
