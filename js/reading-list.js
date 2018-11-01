jQuery(document).ready( function($){

	$(document).on('click', '#js-recent', function(e){
		e.preventDefault();
		//console.log('recent clicked');
		var ajaxurl = my_ajax_object.ajax_url; // from enqueue.php
		console.log(ajaxurl);
		$.ajax({
			url : my_ajax_object.ajax_url,
			type : 'post',
			data : {
				action : "change_sort_recent"
			}, 
			error : function( response ){
				console.log(response);
			},
			success : function( response ){
				$('.books').html(response);
			}	
		});
	});
	$(document).on('click', '#js-author', function(e){
		e.preventDefault();
		var ajaxurl = my_ajax_object.ajax_url;// from enqueue.php
		$.ajax({
			url : my_ajax_object.ajax_url,
			type : 'post',
			data : {
				action : "change_sort_author"
			}, 
			error : function( response ){
				console.log(response);
			},
			success : function( response ){
				$('.books').html(response);
			}	
		});
	});

	$(document).on('click', '#js-best-rated', function(e){
		e.preventDefault();
		var ajaxurl = my_ajax_object.ajax_url;// from enqueue.php
		$.ajax({
			url : my_ajax_object.ajax_url,
			type : 'post',
			data : {
				action : "change_sort_rating"
			}, 
			error : function( response ){
				console.log(response);
			},
			success : function( response ){
				$('.books').html(response);
			}	
		});
	});
});