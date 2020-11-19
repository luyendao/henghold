
jQuery(window).ready(function($){
	
	function reorder(){
		$('.slide').each(function(index,el){
				var slideindex = index;
				$(el).find('input').each(function(index,input){
					var name = $(input).attr('name').replace(/[0-9]+/g,slideindex);
					$(input).attr('name',name);
				});

				var upload = $(el).find('img[rel^="META[slides]"]');
				var rel = $(el).find('img[rel^="META[slides]"]').attr('rel').replace(/[0-9]+/,slideindex);
				upload.attr('rel',rel);
		});
	}

	$('.sorting .browse').live('click',function(e){
		e.stopImmediatePropagation();
		console.log('sorting.click');
	});

	$('.slide .browse').wpfiles(function(file){
		$(this).attr('src',file);
	});

	$('.slide .delete').live('click', function(e){
		e.preventDefault();
		// save any open edits
		var editing = $(this).parents('.slide').find('.editing');
		if(editing.length>0){editing.find('button').trigger('click');}

		var slide = $(this).parents('.slide').clone();

		var undo = $('<div class="undo"> Oh Noooooo, I didn\'t mean to do that! <button class="button button-green">Undo It!</button></div>');
		
		$(this).parents('.slide').slideUp(function(){
			undo.hide();
			$(this).replaceWith(undo);
			undo.slideDown();

			//reorder slide indexes;
			reorder();

			undo.find('button').click(function(e){
				e.preventDefault();
				undo.slideUp(function(){
					slide.hide();
					$(this).replaceWith(slide);
					slide.slideDown();
					reorder();
				});
			});
		});

	});

	// Title
	$('.slide-text H1').live('click',function(e){
		if($(this).hasClass('editing'))return false;
		$(this).addClass('editing');
		var dude = $(this);
		
		// get the slide
		var slide = dude.parents('.slide');
		// save any open edits
		var editing = slide.find('.editing');
		if(editing.length>0){editing.find('button').trigger('click');}
		
		var content = dude.text();
		var width = dude.width()-Number(dude.css('padding').replace("px", ""));
		var height = dude.height()-Number(dude.css('padding').replace("px", ""));
		
		dude.html('<input style="color:inherit;font-size:inherit;background-color:transparent;border:none;display:inline-block;width:100%;box-sizing:border-box;margin:0;padding:0;" value="'+content+'" /><div style="text-align:right;margin-top:-3px;"><button class="button" style="width:50px;box-sizing:border-box">done</button></div>');
		dude.find('input')[0].focus();dude.find('input')[0].select();
		dude.find('input').click(function(e){e.stopPropagation();});
		dude.find('input').keypress(function(e){
			if(e.keyCode==13){
				e.preventDefault();
				e.stopPropagation();
				dude.find('button').trigger('click');
				return false;
			}
		});
		dude.find('button').click(function(e){
			e.stopPropagation();
			e.preventDefault();
			dude.text(dude.find('input').val());
			slide.find('input[name*="title"]').val(dude.text());
			console.log(slide);
			dude.removeClass('editing');
		});
	});

	// Description
	$('.slide-text p').live('click',function(e){
		var slide = $(this).parents('.slide');
		if($(this).hasClass('editing'))return false;
		$(this).addClass('editing');
		var dude = $(this);

		// get the slide
		var slide = dude.parents('.slide');
		// save any open edits
		var editing = slide.find('.editing');
		if(editing.length>0){editing.find('button').trigger('click');}

		var content = dude.text();
		var width = dude.width();
		var height = dude.height();
		dude.html('<div style="text-align:right"><textarea style="padding:0;color:inherit;background-color:transparent;border:none;display:block;width:100%;height:'+height+'px">'+content+'</textarea><div style="text-align:right"><button class="button" style="width:50px;box-sizing:border-box">done</button></div></div>');
		
		$(dude.find('textarea')[0]).focus();$(dude.find('textarea')[0]).select();

		dude.find('textarea').click(function(e){e.stopPropagation();});
		dude.find('textarea').keypress(function(e){
			if(e.keyCode==13){
				dude.find('button').trigger('click');
				e.preventDefault();
				e.stopPropagation();
				return false;
			}
		});
		dude.find('button').click(function(e){
			e.stopPropagation();
			e.preventDefault();
			dude.text(dude.find('textarea').val());
			slide.find('input[name*="description"]').val(dude.text());
			dude.removeClass('editing');
		});
	});

	// Button
	$('.slide-text .slide-learn-more span').live('click',function(e){
		var slide = $(this).parents('.slide');
		if($(this).hasClass('editing'))return false;
		$(this).addClass('editing');
		e.preventDefault();
		var dude = $(this);

		// get the slide
		var slide = dude.parents('.slide');
		// save any open edits
		var editing = slide.find('.editing');
		if(editing.length>0){editing.find('button').trigger('click');}

		var text = dude.text();
		var href = dude.attr('href');
		var width = dude.width()-Number(dude.css('padding').replace("px", ""));
		var height = dude.height()-Number(dude.css('padding').replace("px", ""));
		
		dude.html('<input class="button-text" style="color:inherit;font-size:inherit;background-color:transparent;border:none;display:inline-block;width:100%;box-sizing:border-box;margin:0;padding:0;" value="'+text+'" /><div class="button-url" style="margin: 14px 0 -40px 0;"><label style="display:inline-block;box-sizing:border-box;width:13%;margin:0;color:#000;font-weight:normal;">url:</label><input class="button-url" style="font-weight:normal;font-size:12px;font-family:arial;display:inline-block;width:69%;box-sizing:border-box;margin:0;padding:0;" value="'+href+'" /><button class="button" style="width:50px;box-sizing:border-box;">done</button></div></div>');
		
		dude.find('input')[0].focus();
		dude.find('input')[0].select();
		
		dude.find('input').click(function(e){e.stopPropagation()});
		dude.find('input').keypress(function(e){
			if(e.keyCode==13){
				e.preventDefault();
				e.stopPropagation();
				dude.find('button').trigger('click');
				return false;
			}
		});
		dude.find('button').click(function(e){
			e.stopPropagation();
			e.preventDefault();

			dude.attr('href',$(dude.find('input')[1]).val());
			dude.text($(dude.find('input')[0]).val());
			slide.find('input[name*="moreurl"]').val(dude.attr('href'));
			slide.find('input[name*="moretext"]').val(dude.text());
			dude.removeClass('editing');
		});
		return false;
	});
	/*
	$(".slide .content").draggable({
		'stop':function(){
			slide.find('input[name*="left"]').val($(this).position().left);
			slide.find('input[name*="top"]').val($(this).position().top);
		}
	});*/

	$('#AddSlide').click(function(e){
		e.preventDefault();

		var index = $('.slide').length;
		
		var newslide = $(
'					<div id="Slide'+index+'" class="slide-wrapper">'+
'						<div class="slide">'+
'							<div class="slide-content pad">'+						
'								<div class="img">'+
'									<div class="img-inner-box">'+
'										<img class="browse" rel="META[slides]['+index+'][img]" alt="click to select/upload and image" src="'+stylesheetdir+'/img/default-slide-620x430.jpg" />'+

'										<div class="content">'+
'											<div class="slide-text">'+
'												<h1>Title</h1>'+
'												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'+
'												<div class="slide-learn-more"><span class="btn" href="http://'+window.location.hostname+'">Learn More</span></div>'+
'											</div>'+
'										</div>'+
'									</div>'+
'								</div>'+

'								<input type="hidden" name="META[slides]['+index+'][img]" value=""/>'+
'								<input type="hidden" name="META[slides]['+index+'][title]" value="Title" />'+
'								<input type="hidden" name="META[slides]['+index+'][description]" value="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." />'+
'								<input type="hidden" name="META[slides]['+index+'][moreurl]" value="#" />'+
'								<input type="hidden" name="META[slides]['+index+'][moretext]" value="Learn More" />'+
'								<!--input type="hidden" name="META[slides]['+index+'][left]" value="0" /-->'+
'								<!--input type="hidden" name="META[slides]['+index+'][top]" value="0" /-->'+
'							</div>'+
'							<div class="left half text-center"><span class="info">Click the content you want to edit. (i.e. click the background image to select or upload a new one.)</span></div>'+
'							<div class="buttons half text-right"> <button name="delete" class="delete button red">Delete Slide</button> </div>'+
'						</div>'+
'					</div>');
		
		newslide.hide();
		$('.slides').append(newslide);
		newslide.slideDown();

		// make content draggable
		/*
		$('.slides').last().find(".content").draggable({
			'stop':function(){
				$(this).find('input[name*="left"]').val($(this).position().left);
				$(this).find('input[name*="top"]').val($(this).position().top);
			}
		});//*/

	});
	

	// Existing Slides
	$( ".slides" ).sortable({
		stop:function(e,ui){
			// update the index for the slide's fields
			reorder();
		}
	});

	$( ".slides" ).sortable('disable');

	$('.sort-slides-button').click(function(e){
		e.preventDefault();

		$('.slides').toggleClass('sorting');

		if($('.slides').hasClass('sorting')){

			$( '.slides' ).sortable('enable');
			$( '.slides' ).disableSelection();
			$('.sort-slides-button').text('Stop Sorting');

		}else{

			$( '.slides' ).sortable('disable');
			$( '.slides' ).enableSelection();
			$('.sort-slides-button').text('Sort Slides');

		}

	});
	
});