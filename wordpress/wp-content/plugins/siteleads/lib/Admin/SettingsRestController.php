<?php

namespace SiteLeads\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * REST controller for the SiteLeads settings post type.
 *
 * The post type is exposed over REST because the admin app reads and writes it
 * through @wordpress/core-data, and it is registered with `read` mapped to
 * `edit_theme_options`. Core never enforces that on reads: the published-post
 * shortcut in WP_REST_Posts_Controller::check_read_permission() returns early
 * before the capability is consulted, so /wp-json/wp/v2/siteleads-settings served
 * the whole plugin configuration — AI chatbot API key included — to anyone.
 *
 * This controller applies the capability the post type declares to every read.
 * Writes already went through it, since core does check the edit capabilities.
 * The admin app only ever requests `context=edit`, which already required the
 * capability, so nothing in the plugin loses access.
 */
class SettingsRestController extends \WP_REST_Posts_Controller {

	/**
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return true|\WP_Error
	 */
	public function get_items_permissions_check( $request ) {
		$error = $this->checkReadCapability();

		return $error ? $error : parent::get_items_permissions_check( $request );
	}

	/**
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return true|\WP_Error
	 */
	public function get_item_permissions_check( $request ) {
		$error = $this->checkReadCapability();

		return $error ? $error : parent::get_item_permissions_check( $request );
	}

	/**
	 * Also guards the per-post filtering get_items() does internally, so a
	 * collection response can never fall back to the published-post shortcut.
	 *
	 * @param \WP_Post $post Post object.
	 *
	 * @return bool
	 */
	public function check_read_permission( $post ) {
		if ( $this->checkReadCapability() ) {
			return false;
		}

		return parent::check_read_permission( $post );
	}

	/**
	 * @return \WP_Error|null Error when the current user may not read the settings.
	 */
	private function checkReadCapability() {
		$post_type = get_post_type_object( $this->post_type );

		if ( $post_type && current_user_can( $post_type->cap->read ) ) {
			return null;
		}

		return new \WP_Error(
			'siteleads_rest_forbidden',
			__( 'Sorry, you are not allowed to access SiteLeads settings.', 'siteleads' ),
			array( 'status' => rest_authorization_required_code() )
		);
	}
}
