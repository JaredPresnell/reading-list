<?php 

add_action('wp_ajax_nopriv_change_sort_recent', 'change_sort_recent');
add_action('wp_ajax_change_sort_recent', 'change_sort_recent');
function change_sort_recent(){
	$wp_query = new WP_Query(
			array(
				'post_type' => 'book',
				'posts_per_page'=> '500',
				'orderby' 	=> 'meta_value',
				'order'		=> 'DESC',
				'meta_key' 	=> 'date_read',
				'meta_type' => 'DATETIME',
			) 
		);
	if( $wp_query->have_posts() ):
		while( $wp_query->have_posts() ): $wp_query->the_post();
			include plugin_dir_path( __FILE__ ) . 'content-book.php';
			//get_template_part('inc/template-parts/content-book');					
		endwhile;
	endif;
	wp_reset_postdata();
	die();
}
add_action('wp_ajax_nopriv_change_sort_author', 'change_sort_author');
add_action('wp_ajax_change_sort_author', 'change_sort_author');
function change_sort_author(){
	$wp_query = new WP_Query(
			array(
				'post_type' =>'book',
				'posts_per_page'=> '500',
				'orderby' 	=> 'meta_value',
				'order'		=> 'ASC',
				'meta_key' 	=> 'book_author_last',
			) 
		);
	if( $wp_query->have_posts() ):
		while( $wp_query->have_posts() ): $wp_query->the_post();
			include plugin_dir_path( __FILE__ ) . 'content-book.php';
		endwhile;
	endif;
	wp_reset_postdata();
	die();
}

add_action('wp_ajax_nopriv_change_sort_rating', 'change_sort_rating');
add_action('wp_ajax_change_sort_rating', 'change_sort_rating');
function change_sort_rating(){
	$wp_query = new WP_Query(
			array(
				'post_type' =>'book',
				'posts_per_page'=> '500',
				'orderby' 	=> 'meta_value',
				'order'		=> 'DESC',
				'meta_key' 	=> 'rating',
				'meta_type'	=> 'NUMERIC'
			) 
		);
	if( $wp_query->have_posts() ):
		while( $wp_query->have_posts() ): $wp_query->the_post();
			include plugin_dir_path( __FILE__ ) . 'content-book.php';
		endwhile;
	endif;
	wp_reset_postdata();
	die();
}