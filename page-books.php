<?php
/* Template Name: Books */

/*
@package nells
 */

?>

<?php get_header(); ?>
 
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    	<div class="container">
			<script>
			    (function($){
			        $(window).on("load",function(){
			            $(".nells_sidebar_container").mCustomScrollbar();
			        });
			    })(jQuery);
			</script>
			<div class="nells_container container-fluid">
				<div class="row">
					<?php 
						get_template_part('inc/template-parts/nells', 'sidebar');
					?>	
					<div class="col-md-9 col-12 background_gradient offset-md-3">

						<div class="row">
							<div class="col-xl-10 col-md-12 background_solid"> 
								<div class="books_intro">
									<h1 class="intro_title"><?php the_title();?></h1>
									<p>Hey there! This is a list of books I've read. They are ordered chronologically in the order that I read them, with the most recent books first. You can sort by <a id="js-recent" href="">Recent</a>, <a id="js-best-rated" href="">Best Rated</a>, or <a id="js-author" href="">Author</a>.</p>
									<p>The book cover links to the Amazon page for each book, and you can visit the author's website by clicking on their name. If you know of a book that you think I should read, <a href="https://jaredpresnell.me/contact">Contact Me</a> and let me know!</p>
								</div>
							    <?php

							   	 	$meta_key = "rating";	
									
									$wp_query = new WP_Query(
										array(
											'post_type' =>'book',
											'posts_per_page'=> '500',
											'orderby' 	=> 'meta_value',
											'order'		=> 'DESC',
											'meta_key' 	=> 'date_read',
											'meta_type' => 'DATETIME',
										) 
									);
								?>	
								<div class="books">
									<?php
									if( $wp_query->have_posts() ):
										while( $wp_query->have_posts() ): $wp_query->the_post();
											//get_template_part('inc/template-parts/content-book');	
											include plugin_dir_path( __FILE__ ) . 'content-book.php';
										endwhile;
									endif;
									wp_reset_postdata();
								?>
								</div> <!-- 	 -->
							</div><!-- col-md-10 col-sm-10 -->	
							
						</div> <!-- col-9 -->
					</div> <!-- row -->
				</div><!-- .row -->
					
					
			</div><!-- about_container -->
			  
		</div> <!-- container -->
    </main><!-- .site-main -->

 
</div><!-- .content-area -->
 
<?php get_footer(); ?>

