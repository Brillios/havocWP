<?php
/**
 * The template for displaying 500 pages in PWA.
 *
 * @package HavocWP WordPress theme
 *  */

pwa_get_header( 'pwa' );

do_action( 'havoc_do_server_error' );

pwa_get_footer( 'pwa' );
