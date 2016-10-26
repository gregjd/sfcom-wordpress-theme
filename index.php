<?php get_header(); ?>
<?php
	$archive_category = false;
	$queried_object = get_queried_object();
	if(get_class($queried_object) == 'WP_Term') {
		$archive_category = $queried_object->name;
	}
?>
	<!-- index.php -->
	<main role="main" class="has-sidebar blog">
		<!-- section -->
		<section>

			<div class="blog-nav">
				<ul>
					<li class="channel <?php if(!$archive_category) print 'active' ?>">
						<a href="/blog/">all</a>
					</li>
					<li class="channel technology <?php if($archive_category == 'Technology') print 'active' ?>">
						<a href="/topics/channels/channel-technology/">technology</a>
					</li>
					<li class="channel policy <?php if($archive_category == 'Policy') print 'active' ?>">
						<a href="/topics/channels/channel-policy/">policy</a>
					</li>
					<li class="channel investigations <?php if($archive_category == 'Investigations') print 'active' ?>">
						<a href="/topics/channels/channel-investigations/">investigations</a>
					</li>
					<li class="channel multimedia <?php if($archive_category == 'Multimedia') print 'active' ?>">
						<a href="/topics/channels/channel-multimedia/">multimedia</a>
					</li>
				</ul>
			</div>

			<?php $has_sticky = false; $done = false;?>
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<?php if(is_sticky($post->ID)): ?>
					<?php $has_sticky = true; ?>
					<div class="spotlight">
						<img class="spotlight-badge" src="/wp-content/themes/sfcom/img/badge_spotlight.png">
						<h3 class="spotlight-title">Spotlight</h3>
				<?php elseif($has_sticky && !$done): ?>
					<?php $done = true; ?>
					</div>
				<?php endif ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>

					<header>

						<!-- post title -->
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h2>
						<!-- /post title -->


	          <div class="meta">
	            <address class="author tip">
	                by <?php the_author_posts_link(); ?>
	            </address>

							<?php $categories = wp_get_post_categories($post->ID, array('fields' => 'names')) ?>

							<?php if($categories && array_intersect(array('Technology', 'Policy', 'Investigations', 'Multimedia'), $categories)) : ?>
		            <ul class="channels">
									<?php if(in_array('Technology', $categories)): ?>
										<li class="channel technology textReplace">
											<a href="/topics/channels/channel-technology/">technology</a>
										</li>
									<?php endif ?>
									<?php if(in_array('Policy', $categories)): ?>
										<li class="channel policy textReplace">
											<a href="/topics/channels/channel-policy/">policy</a>
										</li>
									<?php endif ?>
									<?php if(in_array('Investigations', $categories)): ?>
										<li class="channel investigations textReplace">
											<a href="/topics/channels/channel-investigations/">investigations</a>
										</li>
									<?php endif ?>
									<?php if(in_array('Multimedia', $categories)): ?>
										<li class="channel multimedia textReplace">
											<a href="/topics/channels/channel-multimedia/">multimedia</a>
										</li>
									<?php endif ?>
		            </ul>
		          <?php endif; ?>
	            <time datetime="<?php the_time('c'); ?> " class="published" pubdate="">
	                <?php the_time('F j, Y g:i a'); ?>
	            </time>
		        </div>
	        </header>

			    <div class="postContent">
						<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="splash">
								<?php the_post_thumbnail(array(180,180)); ?>
							</a>
						<?php endif; ?>

		        <div class="entry-summary ">
		           <?php html5wp_excerpt('html5wp_index'); ?>

		            <a class="more" href="<?php the_permalink(); ?>">Continue reading</a>
		        </div>

		        <div class="clear">
			    </div>

					<footer class="summary-footer clear">

			    </footer>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				</article>
				<!-- /article -->

			<?php endif; ?>


			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
