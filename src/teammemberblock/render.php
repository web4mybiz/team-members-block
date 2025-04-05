<?php
/**
 * Display Team Members.
 */

$args = array(
	'post_type'      => 'team_member',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'ASC',
);

$team_query = new WP_Query( $args );

if ( $team_query->have_posts() ) :
	?>
	<div class="team-members">
		<?php
		while ( $team_query->have_posts() ) :
			$team_query->the_post();

			$team_member_id = get_the_ID();

			// Get custom meta fields
			$designation = get_post_meta( $team_member_id, '_team_designation', true );
			$linkedin    = get_post_meta( $team_member_id, '_team_linkedin', true );
			$twitter     = get_post_meta( $team_member_id, '_team_twitter', true );
			?>
			
			<div class="team-member">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="team-photo">
						<?php the_post_thumbnail( 'medium' ); ?>
					</div>
				<?php endif; ?>

				<h3 class="team-name"><?php echo esc_html( get_the_title() ); ?></h3>

				<?php if ( ! empty( $designation ) ) : ?>
					<p class="team-designation"><?php echo esc_html( $designation ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $linkedin ) || ! empty( $twitter ) ) : ?>
					<div class="team-social">
						<?php if ( ! empty( $linkedin ) ) : ?>
							<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer">
								LinkedIn
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $linkedin ) && ! empty( $twitter ) ) : ?>
							<span class="separator"> | </span>
						<?php endif; ?>

						<?php if ( ! empty( $twitter ) ) : ?>
							<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer">
								Twitter
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

		<?php endwhile; ?>
	</div>
	<?php
	wp_reset_postdata();
else :
	?>
	<p><?php esc_html_e( 'No team members found.', 'team-members' ); ?></p>
	<?php
endif;
?>
