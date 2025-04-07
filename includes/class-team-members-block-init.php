<?php
/**
 * @package Team_Members_Block
 */

defined( 'ABSPATH' ) || exit;

class Team_Members_Block_Init {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_teammemberblock_init' ) );
	}

	/**
	 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
	 * Behind the scenes, it also registers all assets so they can be enqueued
	 * through the block editor in the corresponding context.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	public function create_teammemberblock_init() {
		/**
		 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
		 * based on the registered block metadata.
		 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
		 *
		 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
		 */
		if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
			wp_register_block_types_from_metadata_collection( plugin_dir_path( __FILE__ ) . '../build', plugin_dir_path( __FILE__ ) . '../build/blocks-manifest.php' );

			return;
		}

		/**
		 * Registers the block(s) metadata from the `blocks-manifest.php` file.
		 * Added to WordPress 6.7 to improve the performance of block type registration.
		 *
		 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
		 */
		if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
			wp_register_block_metadata_collection( plugin_dir_path( __FILE__ ) . '../build', plugin_dir_path( __FILE__ ) . '../build/blocks-manifest.php' );
		}
		/**
		 * Registers the block type(s) in the `blocks-manifest.php` file.
		 *
		 * @see https://developer.wordpress.org/reference/functions/register_block_type/
		 */
		$manifest_data = require plugin_dir_path( __FILE__ ) . '../build/blocks-manifest.php';
		foreach ( array_keys( $manifest_data ) as $block_type ) {
			register_block_type( plugin_dir_path( __FILE__ ) . "../build/{$block_type}" );
		}
	}
}
