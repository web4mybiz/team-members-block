<?php
/**
 * Plugin Name:       Team Members Block
 * Description:       A simple block plugin to create and add team members.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Rizwan Iliyas
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       teammemberblock
 *
 * @package Team_Members_Block
 */

defined( 'ABSPATH' ) || exit;

// Include necessary files
require_once plugin_dir_path( __FILE__ ) . 'includes/class-team-members-block-init.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-team-members-cpt.php';

// Initialize the Team Members Block
new Team_Members_Block_Init();
