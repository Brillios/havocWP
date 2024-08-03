<?php
/**
 * HavocWP theme strings
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'havocwp_theme_strings' ) ) {

	/**
	 * HavocWP Theme Strings
	 *
	 *  @author Brillios (basilisgav@gmail.com)
	 *  	 *
	 * @param  string  $value  String key.
	 * @param  boolean $echo   Print string.
	 * @return mixed           Return string or nothing.
	 */
	function havocwp_theme_strings( $value, $echo = true ) {

		$havocwp_strings = apply_filters(
			'havocwp_theme_strings',
			array(

				// Headers General.
				'hvc-string-open-menu'                   => apply_filters( 'havoc_wai_open_menu', __( 'View website Menu', 'havocwp' ) ),

				// Vertical Header.
				'hvc-string-vertical-header-toggle'      => apply_filters( 'havoc_wai_vertical_header_toggle', __( 'Toggle the button to expand or collapse the Menu', 'havocwp' ) ),
				'hvc-string-vertical-header-anchor'      => apply_filters( 'havoc_vertical_header_anchor', _x( 'vertical-header-toggle', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Full Screen Header.
				'hvc-string-fullscreen-header-anchor'    => apply_filters( 'havoc_full_screen_anchor', _x( 'header-menu-toggle', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Mobile General.
				'hvc-string-mobile-icon-anchor'          => apply_filters( 'havoc_mobile_icon_anchor', _x( 'mobile-menu-toggle', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),
				'hvc-string-close-mobile-menu'           => apply_filters( 'havoc_wai_close_mobile_menu', __( 'Close mobile menu', 'havocwp' ) ),
				'hvc-string-mh-search-close-anchor'      => apply_filters( 'havoc_mh_search_close_anchor', _x( 'mobile-header-search-close', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Mobile Sidebar Header Style.
				'hvc-string-sidr-close-anchor'           => apply_filters( 'havoc_sidr_close_anchor', _x( 'sidr-menu-close', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Mobile Full Screen Header Style.
				'hvc-string-mobile-fullscreen-anchor'    => apply_filters( 'havoc_mobile_fullscreen_anchor', _x( 'mobile-fullscreen-menu', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Search Forms General.
				'hvc-string-search-form-label'           => apply_filters( 'havoc_wai_search_form_label', __( 'Search this website', 'havocwp' ) ),
				'hvc-string-close-search-form'           => apply_filters( 'havoc_wai_close_search_form', __( 'Close this search form', 'havocwp' ) ),
				'hvc-string-search-field'                => apply_filters( 'havoc_wai_search_field', __( 'Insert search query', 'havocwp' ) ),
				'hvc-string-search-text'                 => apply_filters( 'havoc_search_text', __( 'Search', 'havocwp' ) ),

				// Mobile Search Forms General.
				'hvc-string-mobile-search-text'          => apply_filters( 'havoc_mobile_search_text', __( 'Search', 'havocwp' ) ),
				'hvc-string-mobile-submit-search'        => apply_filters( 'havoc_wai_mobile_search_submit', __( 'Submit search', 'havocwp' ) ),
				'hvc-string-mobile-search-anchor'        => apply_filters( 'havoc_mobile_search_anchor', _x( 'mobile-header-search', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Search Header Replace.
				'hvc-string-header-replace-search-text'  => apply_filters( 'havoc_header_replace_search_text', __( 'Type then hit enter to search...', 'havocwp' ) ),

				// Search Hader Overlay.
				'hvc-string-hs-overlay-close-anchor'     => apply_filters( 'havoc_hs_overlay_close_anchor', _x( 'hsoverlay-close', 'Used for creation of SEO friendly anchor links. Do not use spaces or pound keys.', 'havocwp' ) ),

				// Main.
				'hvc-string-header-skip-link'            => apply_filters( 'havoc_header_skip_link', __( 'Skip to content', 'havocwp' ) ),
				'hvc-string-scroll-top'                  => apply_filters( 'havoc_wai_scroll_top', __( 'Scroll to the top of the page', 'havocwp' ) ),

				'hvc-string-mobile-fs-search-text'       => apply_filters( 'havoc_mobile_fs_search_text', __( 'Type your search', 'havocwp' ) ),

				'hvc-string-search-overlay-search-text'  => apply_filters( 'havoc_search_overlay_search_text', __( 'Type then hit enter to search', 'havocwp' ) ),
				'hvc-string-vertical-header-search-text' => apply_filters( 'havoc_vertical_header_search_text', __( 'Search...', 'havocwp' ) ),
				'hvc-string-medium-header-search-text'   => apply_filters( 'havoc_medium_header_search_text', __( 'Search...', 'havocwp' ) ),

				// Comments.
				'hvc-string-comment-logout-text'         => apply_filters( 'havoc_comment_logout_text', __( 'Log out of this account', 'havocwp' ) ),
				'hvc-string-comment-placeholder'         => apply_filters( 'havoc_comment_placeholder', __( 'Your comment here...', 'havocwp' ) ),
				'hvc-string-comment-profile-edit'        => apply_filters( 'havoc_comment_profile_edit', __( 'Click to edit your profile', 'havocwp' ) ),
				'hvc-string-comment-post-button'         => apply_filters( 'havoc_comment_post_button', __( 'Post Comment', 'havocwp' ) ),
				'hvc-string-comment-name-req'            => apply_filters( 'havoc_comment_name_req', __( 'Name (required)', 'havocwp' ) ),
				'hvc-string-comment-email-req'           => apply_filters( 'havoc_comment_email_req', __( 'Email (required)', 'havocwp' ) ),
				'hvc-string-comment-name'                => apply_filters( 'havoc_comment_name', __( 'Name', 'havocwp' ) ),
				'hvc-string-comment-email'               => apply_filters( 'havoc_comment_email', __( 'Email', 'havocwp' ) ),
				'hvc-string-comment-website'             => apply_filters( 'havoc_comment_website', __( 'Website', 'havocwp' ) ),

				'hvc-string-search-continue-reading'     => apply_filters( 'havoc_search_continue_reading', __( 'Continue Reading', 'havocwp' ) ),
				'hvc-string-post-continue-reading'       => apply_filters( 'havoc_post_continue_reading', __( 'Continue Reading', 'havocwp' ) ),
				'hvc-string-single-related-posts'        => apply_filters( 'havoc_single_related_posts', __( 'You Might Also Like', 'havocwp' ) ),
				'hvc-string-single-next-post'            => apply_filters( 'havoc_single_next_post', __( 'Next Post', 'havocwp' ) ),
				'hvc-string-single-prev-post'            => apply_filters( 'havoc_single_prev_post', __( 'Previous Post', 'havocwp' ) ),
				'hvc-string-single-screen-reader-rm'     => apply_filters( 'havoc_single_screen_reader_rm', __( 'Read more articles', 'havocwp' ) ),
				'hvc-string-author-page'                 => apply_filters( 'havoc_author_page', __( 'Visit author page', 'havocwp' ) ),

				// Woocommerce.
				'hvc-string-woo-quick-view-text'         => apply_filters( 'havoc_woo_quick_view_text', __( 'Quick View', 'havocwp' ) ),
				'hvc-string-woo-quick-view-close'        => apply_filters( 'havoc_woo_quick_view_close', __( 'Close quick preview', 'havocwp' ) ),
				'hvc-string-woo-floating-bar-select-btn' => apply_filters( 'havoc_woo_floating_bar_select_btn', __( 'Select Options', 'havocwp' ) ),
				'hvc-string-woo-floating-bar-selected'   => apply_filters( 'havoc_woo_floating_bar_selected', __( 'Selected:', 'havocwp' ) ),
				'hvc-string-woo-floating-bar-out-stock'  => apply_filters( 'havoc_woo_floating_bar_out_stock', __( 'Out of stock', 'havocwp' ) ),
				'hvc-string-woo-nav-next-product'        => apply_filters( 'havoc_woo_nav_next_text', __( 'Next Product', 'havocwp' ) ),
				'hvc-string-woo-nav-prev-product'        => apply_filters( 'havoc_woo_nav_prev_text', __( 'Previous Product', 'havocwp' ) ),

				// Aria.
				'hvc-string-website-search-icon'         => apply_filters( 'havoc_wai_website_search_icon', __( 'Toggle website search', 'havocwp' ) ),
				'hvc-string-website-search-form'         => apply_filters( 'havoc_wai_website_search_form', __( 'Website search form', 'havocwp' ) ),
				'hvc-string-mobile-search'               => apply_filters( 'havoc_wai_mobile_search', __( 'Search for:', 'havocwp' ) ),
				'hvc-string-fullscreen-submit-search'    => apply_filters( 'havoc_wai_fullscreen_search_submit', __( 'After typing hit enter to submit search query', 'havocwp' ) ),
				'hvc-string-link-post-format'            => apply_filters( 'havoc_wai_link_post_format', __( 'Visit this link', 'havocwp' ) ),
				'hvc-string-new-tab-alert'               => apply_filters( 'havoc_wai_new_tab_alert', __( 'Opens in a new tab', 'havocwp' ) ),
				'hvc-string-read-more'                   => apply_filters( 'havoc_wai_read_more', __( 'Read more about', 'havocwp' ) ),
				'hvc-string-read-more-article'           => apply_filters( 'havoc_wai_read_more_article', __( 'Read more about the article', 'havocwp' ) ),
				'hvc-string-current-read'                => apply_filters( 'havoc_wai_current_read', __( 'You are currently viewing', 'havocwp' ) ),
				'hvc-string-author-img'                  => apply_filters( 'havoc_wai_author_img', __( 'Post author avatar', 'havocwp' ) ),

				// Woo Aria.
				'hvc-string-wai-next-product'            => apply_filters( 'havoc_wai_next_product', __( 'View next product', 'havocwp' ) ),
				'hvc-string-wai-prev-product'            => apply_filters( 'havoc_wai_prev_product', __( 'View previous product', 'havocwp' ) ),

				// Post Header templates.
				'hvc-string-posted-by'                   => apply_filters( 'havoc_posted_by', _x( 'By', 'Prefix for post author name', 'havocwp' ) ),
				'hvc-string-written-by'                  => apply_filters( 'havoc_written_by', _x( 'Written by', 'Prefix for post author name', 'havocwp' ) ),
				'hvc-string-all-posts-by'                => apply_filters( 'havoc_wai_all_posts_by', _x( 'All posts by', 'Aria label prefix for post author link', 'havocwp' ) ),
				'hvc-string-posted-on'                   => apply_filters( 'havoc_posted_on', _x( 'Published', 'Prefix for post published date', 'havocwp' ) ),
				'hvc-string-updated-on'                  => apply_filters( 'havoc_updated_on', _x( 'Updated', 'Prefix for post modified date', 'havocwp' ) ),
				'hvc-string-reading-one'                 => apply_filters( 'havoc_reading_one', _x( 'min read', 'Suffix for post reading time equal to 1', 'havocwp' ) ),
				'hvc-string-reading-more'                => apply_filters( 'havoc_reading_more', _x( 'mins read', 'Suffix for post reading time more than 1', 'havocwp' ) ),
				'hvc-string-posted-in'                   => apply_filters( 'havoc_posted_in', _x( 'Posted in', 'Prefix for categories list', 'havocwp' ) ),
				'hvc-string-tagged-as'                   => apply_filters( 'havoc_tagged_as', _x( 'Tagged as', 'Prefix for tags list', 'havocwp' ) ),
				'hvc-string-wai-updated-on'              => apply_filters( 'havoc_wai_updated_on', _x( 'Updated on', 'Aria label: post modified date', 'havocwp' ) ),
				'hvc-string-wai-published-on'            => apply_filters( 'havoc_wai_published_on', _x( 'Published on', 'Aria label: post published date', 'havocwp' ) ),
				'hvc-string-wai-reading-time'            => apply_filters( 'havoc_wai_reading_time', _x( 'Reading time', 'Aria label: post reading time', 'havocwp' ) ),
				'hvc-string-wai-comments'                => apply_filters( 'havoc_wai_comments', _x( 'Comments', 'Aria label: post comments', 'havocwp' ) ),

			)
		);

		if ( is_rtl() ) {
			// do your stuff.
		}

		$hvc_string = isset( $havocwp_strings[ $value ] ) ? $havocwp_strings[ $value ] : '';

		/**
		 * Print or return strings
		 */
		if ( $echo ) {
			echo $hvc_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped on function usage.
		} else {
			return $hvc_string;
		}
	}
}
