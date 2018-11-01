<?php

 function add_books(){
	$args = array(
		'labels' => array(
			'name' => __( 'Books' ),
			'singular_name' => __( 'Book' ),
		),
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
	);
	register_post_type( 'book', $args );
}
add_action( 'init', 'add_books' );

function add_custom_book_fields(){
	add_meta_box( 'book_info', 'Book Info', 'meta_options_callback', 'book' ); 
}
function meta_options_callback(){
    global $post;
    $custom = get_post_custom($post->ID);

    (isset($custom["rating"][0])) ? $rating = $custom["rating"][0] : $rating = "";
    $rating = sanitize_rating($rating);

    (isset($custom["book_author_first"][0])) ? $book_author_first = $custom["book_author_first"][0] : $book_author_first = "";
    (isset($custom["book_author_last"][0])) ? $book_author_last = $custom["book_author_last"][0] : $book_author_last = "";
   	(isset($custom["book_author"][0])) ? $book_author = $custom["book_author"][0] : $book_author = "";
    (isset($custom["author_link"][0])) ? $author_link = $custom["author_link"][0] : $author_link = "";
    (isset($custom["date_read"][0])) ? $date_read = $custom["date_read"][0] : $date_read = "";
    (isset($custom["book_cover"][0])) ? $book_cover = $custom["book_cover"][0] : $book_cover = "";
    (isset($custom["amazon"][0])) ? $amazon = $custom["amazon"][0] : $amazon = "";
	?>
    <label>Rating:</label><input name="rating" value="<?php echo $rating; ?>" /><br>

    <?php 
    	$first_names = explode(',', $book_author_first, -1);
    	$last_names = explode(',', $book_author_last, -1);
    	$author_links = explode(',', $author_link, -1);
    	$book_authors = explode(', ', $book_author, -1);
	?>
		<div class="author_info">
	<?php
		$count = count($first_names);
		$count = ($count<1) ? 1 : $count;
    	for($i=0; $i<=$count-1; $i++)
    	{
    		$authcount = $i+1;

	?>
			<div class="author_form">
					<label>Author:</label><input name="book_author_first_<?php echo $authcount;?>" value="<?php echo (isset($first_names[$i]) ? $first_names[$i] : ""); ?>" size="30"/><input name="book_author_last_<?php echo $authcount;?>" value="<?php echo (isset($last_names[$i]) ? $last_names[$i] : ""); ?>" size="30"/><br>
	    		<label>Author Link:</label><input name="author_link_<?php echo $authcount;?>" value="<?php echo (isset($author_links[$i]) ? $author_links[$i] : ""); ?>" size="50"/><br>
	    	</div>	
	<?php
    	}
    ?>
		</div> <!-- author_info -->

    <button id="add_author">Add another author</button><br>
    <label>Date Read:</label><input name="date_read" type="date" value="<?php echo $date_read; ?>" /><br>
    <label>Amazon Link:</label><input name="amazon" value="<?php echo $amazon; ?>" /><br>
    <input name="book_cover" class="book_cover" type="hidden" value="<?php echo $book_cover; ?>" />
	<input id="upload-button-book" type="button" value="Upload Image" />
	<?php
}		
function sanitize_rating($rating){
	if($rating != ""){
		if(is_numeric($rating) && $rating<=10 && $rating>=0){return $rating;}
		else return "";
    }	
    return "";	
}
function save_custom_meta(){
	global $post;
	// need to concat with commas ', ' because thats how it reads it earlier.
	$store_first_names = "";
	$store_last_names = "";
	$store_links = "";
	$store_authors = "";
	$authcount=5;
	if($authcount > 5) $authcount=5; //does not allow more than 5 authors, set up for ajax or something
	// This for loop basically looks for each thing, if it doesnt find it then it breaks the loop
	// you could probably load in authcount with an ajax function or something, but this way also works

	for($i=1; $i<=$authcount; $i++) 
	{
		$first_name_string = 'book_author_first_' . $i;
		$last_name_string = 'book_author_last_' . $i;
		$link_string = 'author_link_'.$i;
		if(!isset($_POST[$first_name_string]) || !isset($_POST[$last_name_string]) || !isset($_POST[$link_string]) || $_POST[$first_name_string]=="" ||$_POST[$last_name_string]==""){
			break;
		}
		//when these values are read out of the database, it automaticlaly splits the string based on "," and drops the last value, so it is fine (needs) that there is a comma at the end.
		$store_first_names = $store_first_names . $_POST[$first_name_string] . ',';
		$store_last_names = $store_last_names . $_POST[$last_name_string] . ',';
		$store_links = $store_links . $_POST[$link_string] . ',';	
		$store_authors = $store_authors . $_POST[$first_name_string] .' '. $_POST[$last_name_string] . ',';
	}

	if(! isset($post->ID)) {return;}
    update_post_meta($post->ID, "rating", $_POST["rating"]);
    
   
  	update_post_meta($post->ID, "book_author_first", $store_first_names);
    update_post_meta($post->ID, "book_author_last", $store_last_names);
    update_post_meta($post->ID, "author_link", $store_links);
	update_post_meta($post->ID, "book_author", $store_authors);
    
    update_post_meta($post->ID, "date_read", $_POST["date_read"]);
    update_post_meta($post->ID, "book_cover", $_POST["book_cover"]);
    update_post_meta($post->ID, "amazon", $_POST["amazon"]);

}

add_action('admin_init', 'add_custom_book_fields');
add_action('save_post', 'save_custom_meta');	

?>