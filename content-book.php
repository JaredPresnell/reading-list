<?php

/*
@package nells
*/

?>
<?php
	//$meta = get_post_meta(get_the_ID());
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
		<div class="entry-meta">
		</div>
		
	</header>
	
	<div class="entry-content">
		<div class="row">
			<div class="book_cover_container col-md-3 col-lg-2 col-sm-4 col-5">
			<!-- <figure> -->
				<a class="amazon" href="<?php echo $post->amazon; ?>"><img class="book_cover" src="<?php echo $post->book_cover; ?>"></a>
			<!-- </figure> -->
			</div>	
			<div class="col-md-9 col-lg-10 col-sm-8 col-7" css="height:100%">
				<?php 
					the_title('<h1 class="book_title">', '</h1>');
				?>
				<?php
					if(strpos($post->book_author, ',') !==false)
					{
						$book_authors = explode(',', $post->book_author, -1);
					}
					else $book_authors = array($post->book_author);

					if(strpos($post->author_link, ',') !==false)
					{
						$author_links = explode(',', $post->author_link);
					}
					else $author_links = array($post->author_link);
					echo '<p class="book_author"> - By ';
					$count = count($book_authors);
					if($count > 2)
					{
						for($i=0; $i<count($book_authors); $i++)
						{ 	
							if($i==$count-1) {
								echo ' <a href="' . $author_links[$i].'">' . $book_authors[$i]	 . '</a>.</p>';
							}
							elseif($i == $count-2){
								echo ' <a href="' . $author_links[$i].'">' . $book_authors[$i] . '</a> and ';
							}
							else{
								echo ' <a href="' . $author_links[$i].'">' . $book_authors[$i] . '</a>, ';
							}
						}
					}
					else{
						for($i=0; $i<count($book_authors); $i++)
						{ 	
							if($i==count($book_authors)-1) {
								echo ' <a href="' . $author_links[$i].'">' . $book_authors[$i]	 . '</a>.</p>';
							}
							else {
								echo ' <a href="' . $author_links[$i].'">' . $book_authors[$i] . '</a> and ';
							}
						}
					}
					
				?>
				<p class="book_info">Date Read: <?php echo $post->date_read; ?>. My rating for this book: <strong><?php echo $post->rating; ?></strong>/10</p>
				<div class="book_excerpt d-sm-none d-none d-md-block d-lg-block d-xl-block">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="book_excerpt_mobile col-s-12 d-block d-sm-block d-md-none d-lg-none d-xl-none">
					<?php the_content(); ?>
			</div>
			
		</div> <!-- row -->		
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
	</footer>
	
</article>