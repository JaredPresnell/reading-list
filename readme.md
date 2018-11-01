this plugin registers a template called "Books" to display a reading list. The reading is made up of the book custom post type, which is also registered in this plugin. 

Currently, this plugin references the sidebar in "page-books.php" via "get_template_part('inc/template-parts/nells', 'sidebar');" which will not work if there is a different theme or if the file structure gets changed.