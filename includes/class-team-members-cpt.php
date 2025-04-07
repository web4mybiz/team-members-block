<?php
/**
 * @package Team_Members_Block
 */

defined( 'ABSPATH' ) || exit;

class Team_Members_CPT {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_team_member_cpt' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_team_member_meta_boxes' ) );
		add_action( 'save_post_team_member', array( $this, 'save_team_member_meta' ), 10, 2 );
		add_filter( 'post_type_labels_team_member', array( $this, 'update_team_member_labels' ) );
	}


	/**
	 * Register the custom post type
	 */
	public function register_team_member_cpt() {
		if ( post_type_exists( 'team_member' ) ) {
			return;
		}

		$labels = array(
			'name'           => __( 'Team Members', 'team-members' ),
			'singular_name'  => __( 'Team Member', 'team-members' ),
			'add_new'        => __( 'Add New', 'team-members' ),
			'add_new_item'   => __( 'Add New Team Member', 'team-members' ),
			'edit_item'      => __( 'Edit Team Member', 'team-members' ),
			'new_item'       => __( 'New Team Member', 'team-members' ),
			'view_item'      => __( 'View Team Member', 'team-members' ),
			'all_items'      => __( 'All Team Members', 'team-members' ),
			'menu_name'      => __( 'Team Members', 'team-members' ),
			'name_admin_bar' => __( 'Team Member', 'team-members' ),
		);

		$args = array(
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-groups',
		);

		register_post_type( 'team_member', $args );
	}

	/**
	 * Add meta boxes
	 */
	public function add_team_member_meta_boxes() {
		add_meta_box(
			'team_member_details',
			__( 'Team Member Details', 'team-members' ),
			array( $this, 'render_team_member_meta_box' ),
			'team_member',
			'normal',
			'default'
		);
	}

	/**
	 * Render meta box content
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function render_team_member_meta_box( $post ) {
		wp_nonce_field( 'save_team_member_meta', 'team_member_nonce' );

		$fields = array(
			'designation' => get_post_meta( $post->ID, '_team_designation', true ),
			'joined_date' => get_post_meta( $post->ID, '_team_joined_date', true ),
			'linkedin'    => get_post_meta( $post->ID, '_team_linkedin', true ),
			'twitter'     => get_post_meta( $post->ID, '_team_twitter', true ),
		);

		?>
		<p><label><?php esc_html_e( 'Designation:', 'team-members' ); ?><br>
			<input type="text" name="team_designation" value="<?php echo esc_attr( $fields['designation'] ); ?>" class="widefat"></label></p>
		<p><label><?php esc_html_e( 'Joined Date:', 'team-members' ); ?><br>
			<input type="date" name="team_joined_date" value="<?php echo esc_attr( $fields['joined_date'] ); ?>" class="widefat"></label></p>
		<p><label><?php esc_html_e( 'LinkedIn URL:', 'team-members' ); ?><br>
			<input type="url" name="team_linkedin" value="<?php echo esc_attr( $fields['linkedin'] ); ?>" class="widefat"></label></p>
		<p><label><?php esc_html_e( 'Twitter URL:', 'team-members' ); ?><br>
			<input type="url" name="team_twitter" value="<?php echo esc_attr( $fields['twitter'] ); ?>" class="widefat"></label></p>
		<?php
	}

	/**
	 * Save meta box fields
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	public function save_team_member_meta( $post_id, $post ) {
		// Security checks.
		if ( ! isset( $_POST['team_member_nonce'] ) || ! wp_verify_nonce( $_POST['team_member_nonce'], 'save_team_member_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( $post->post_type !== 'team_member' ) {
			return;
		}

		// Capability check.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Sanitize and save each field.
		$meta_fields = array(
			'_team_title'       => isset( $_POST['team_title'] ) ? sanitize_text_field( $_POST['team_title'] ) : '',
			'_team_designation' => isset( $_POST['team_designation'] ) ? sanitize_text_field( $_POST['team_designation'] ) : '',
			'_team_joined_date' => isset( $_POST['team_joined_date'] ) ? sanitize_text_field( $_POST['team_joined_date'] ) : '',
			'_team_linkedin'    => isset( $_POST['team_linkedin'] ) ? esc_url_raw( $_POST['team_linkedin'] ) : '',
			'_team_twitter'     => isset( $_POST['team_twitter'] ) ? esc_url_raw( $_POST['team_twitter'] ) : '',
		);

		foreach ( $meta_fields as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	/**
	 * Customize featured image label to "Team Member Photo".
	 *
	 * @param object $labels Post type labels.
	 * @return object
	 */
	public function update_team_member_labels( $labels ) {
		$labels->featured_image        = __( 'Team Member Photo', 'team-members' );
		$labels->set_featured_image    = __( 'Set Team Member Photo', 'team-members' );
		$labels->remove_featured_image = __( 'Remove Team Member Photo', 'team-members' );
		$labels->use_featured_image    = __( 'Use as Team Member Photo', 'team-members' );
		return $labels;
	}
}

new Team_Members_CPT();
