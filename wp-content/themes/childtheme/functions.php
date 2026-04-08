<?php
/**
 * Odd Jobs Laurier Child theme functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue parent and child styles + Google Fonts
 */
function odd_jobs_laurier_enqueue_styles() {
	wp_enqueue_style(
		'odd-jobs-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'parent-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'odd-jobs-child-style',
		get_stylesheet_uri(),
		array( 'parent-style', 'odd-jobs-google-fonts' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'odd_jobs_laurier_enqueue_styles' );

/**
 * Google Analytics / Google tag placeholder
 * Replace G-XXXXXXXXXX with your real Measurement ID
 */
function odd_jobs_laurier_analytics() {
	?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-XXXXXXXXXX');
	</script>
	<?php
}
add_action( 'wp_head', 'odd_jobs_laurier_analytics' );

/**
 * Homepage split section shortcode
 * Usage:
 * [odd_jobs_split employer_url="/shop" worker_url="/registration"]
 */
function odd_jobs_split_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'employer_url' => home_url( '/shop' ),
			'worker_url'   => home_url( '/registration' ),
		),
		$atts,
		'odd_jobs_split'
	);

	$employer_url = esc_url( $atts['employer_url'] );
	$worker_url   = esc_url( $atts['worker_url'] );

	ob_start();
	?>
	<div class="odd-jobs-split">
		<div class="odd-jobs-card">
			<h2>Hire a Laurier Student</h2>
			<p>Browse available odd jobs and book student help for everyday tasks like moving, cleaning, yard work, and more.</p>
			<a href="<?php echo $employer_url; ?>">Go to Shop</a>
		</div>

		<div class="odd-jobs-card">
			<h2>Become a Worker</h2>
			<p>Apply to offer odd job services by filling out the registration form and sharing why you would be a good fit.</p>
			<a href="<?php echo $worker_url; ?>">Register Now</a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'odd_jobs_split', 'odd_jobs_split_shortcode' );

/**
 * Optional hero shortcode
 * Usage:
 * [odd_jobs_hero]
 */
function odd_jobs_hero_shortcode() {
	ob_start();
	?>
	<div class="odd-jobs-hero">
		<h1>Odd Jobs for Laurier Students</h1>
		<p>
			A student-focused platform that connects Laurier students looking for flexible work
			with people who need help with small everyday jobs.
		</p>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'odd_jobs_hero', 'odd_jobs_hero_shortcode' );