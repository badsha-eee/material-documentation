<?php
/**
 * The Template for displaying a full width page.
 *
 * Template Name: Modular
 *
 * @package dokan
 */
get_header();
?>


<div class="home-banner">
	<h1><?php echo $options = get_option( 'home_page_title'), ('Welcome to Sekander Docs Theme'); ?></h1>
	<p><?php echo $options = get_option( 'home_page_desc'), ('Reset these texts from wp-admin -> Settings -> Reading' ); ?></p>
	<?php get_search_form( ); ?>
</div>

<div class="box-wrap">
<?php
	$categories = get_terms( 'category', array(
	    'hide_empty' => false,
	    'orderby'    => 'name',
	    'parent'     => 0,
	    'hierarchical' => false
	) );
	if ( $categories ) {
	    foreach ( $categories as $category ) {
	        include 'template-parts/loop-category.php';
	    }
	}
?>
</div>

<?php get_footer(); ?>