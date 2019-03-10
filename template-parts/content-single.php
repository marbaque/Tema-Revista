<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revista-politica
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<?php $get_description = get_post(get_post_thumbnail_id())->post_excerpt; ?>
		<figure class="index-image">
	  	<?php the_post_thumbnail('medium-large'); ?>
			<figcaption><?= $get_description; ?></figcaption>
		</figure>
	<?php endif; ?>

	<div class="post_content">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<div class="entry-meta">
					<?php
					rev_politica_posted_on();
					rev_politica_posted_by();
					rev_politica_entry_footer();
					?>
				</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
				<?php the_content(); ?>
		</div><!-- .entry-content -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
