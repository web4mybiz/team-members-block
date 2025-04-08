<?php
/**
 * Server-side rendering for the Team Member Search block.
 *
 * @param array $attributes Block attributes.
 * @param string $content Block content.
 * @return string Rendered HTML.
 */

if ( ! empty( $attributes['title'] ) ) {
	// Output the title, safely escaped.
	echo '<h2>' . esc_html( $attributes['title'] ) . '</h2>';
}
?>

<div class="members-search-input">
	<input type="text">
	<div class="results"></div>
</div>
