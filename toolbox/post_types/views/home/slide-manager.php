<?php
if(isset($slider->background)){
	$slider_bg = $slider->background;
}else{
	$slider_bg = get_stylesheet_directory_uri().'/img/slide.jpg';
}
$template = '
					<div class="item {{hiddenclass}}">
						<h2>{{title}}</h2>
						<div class="slide-wrapper" style="background:url('.$slider_bg.')">
							<div class="slide">
								<div class="slide-buffer">
							
									<div class="slide-photo">
										<input type="hidden" name="META[slides][{{index}}][img]" value="{{imgsrc}}" />
										<img class="browse" rel="META[slides][{{index}}][img]" src="{{imgsrc}}" />
										
										<div class="videolink" style="display:none">
											<div class="videolink-pad">
												YouTube Video ID:<input type="textarea" class="autoheight" name="META[slides][{{index}}][videolink]" value="{{videolink}}" />
												<span>If this is an image only, please leave the YouTube video ID blank</span>
											</div>
										</div>										
									</div>
																
									<div class="slide-info">
										<h1><textarea class="autoheight header setheading" name="META[slides][{{index}}][title]">{{title}}</textarea></h1>
										<p><textarea class="autoheight description" name="META[slides][{{index}}][description]">{{description}}</textarea></p>
	
										<span class="btn-wrapper">
											<span class="btn" href="#" title="Learn More">
												<span><textarea class="autoheight more-text" name="META[slides][{{index}}][moretxt]" style="width:125px">{{moretxt}}</textarea></span>
											</span>
											
											<div class="editlink" style="display:none">
												<div class="editlink-pad">
													url:<input type="textarea" class="autoheight" name="META[slides][{{index}}][morelink]" value="{{morelink}}" />
													<input type="checkbox" name="META[slides][{{index}}][moretarget]" {{moretarget}} /> new window
												</div>
											</div>
	
										</span>
									</div>
									
								</div>
							</div>
						</div>
						<div class="actions">
							<button class="delete button red">delete</button> <input class="hide" type="checkbox" name="META[slides][{{index}}][hide]" {{hide}} /> :hide this slide
						</div>
					</div>
 ';
?>
<div class="meta-box">
	<div class="whole">
		<div class="pad">
				
				<div class="slide-top-options pad" style="overflow:hidden;">
					<div class="half left text-left">
						<button class="button blue sort-slides-button">Sort Slides</button>
					</div>
					<div class="half left text-right">
						<label for="SlideOption_Interval">Delay:</label> <input id="SlideOption_Interval" style="width:25px;text-align:center" type="text" name="META[slider][interval]" value="<?=isset($slider->interval) ? $slider->interval : 5?>"> seconds
					</div>
				</div>
				
				<div class="slide-top-options2 pad" style="overflow:hidden;">
					<div class="full left text-left">
						<input id="SlideOption_Background" style="width:auto;text-align:center" type="hidden" name="META[slider][background]" value="<?=isset($slider->background) ? $slider->background : get_stylesheet_directory_uri().'/img/slide.jpg';?>"> 
						<button class="browse button blue" rel="META[slider][background]">Change Slider Image Background</button>						
					</div>
				</div>

				<div id="SlideTemplate" style="display:none">
					<?=$template?>
				</div>

				<div class="slides" id="PageSlides" style="relative">
<?php 
foreach($slides as $index=>$slide):
?>
					<div id="Slide<?=$index?>">
						<?=$this->simplate->render($template,array(
							'index'=>$index,
							'title'=>$slide->title,
							'description'=>$slide->description,
							'moretxt'=>$slide->moretxt,
							'morelink'=>$slide->morelink,
							'videolink'=>$slide->videolink,
							'moretarget'=>$slide->moretarget ? 'checked' : '',
							'imgsrc'=>$slide->img,
							'hide'=>$slide->hide ? 'checked' : '',
							'hiddenclass'=>$slide->hide ? 'hidden' : ''
						),false)?>
					</div>
<?php endforeach;
?>
				</div>
				<div class="slide-bottom-options pad" style="overflow:hidden;">

					<div class="half left text-left">
						<button class="sort-slides-button button blue">Sort Slides</button>
					</div>

					<div class="half left text-right">
						<button id="AddSlide" class="button green"> Add Slide </button>
					</div>

				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(window).ready(function($){
		
		$('#post').submit(function(){
			$('#SlideTemplate').find('textarea,input,select').attr('disabled',true);
		});

		// size slide content areas
		$('.slides textarea.autoheight').each(function(index,el){
			$(el).css({'height':1});
			$(el).css({'height':$(this)[0].scrollHeight});
		});

		$('.slides .setheading').live('keyup',function(){
			$(this).parents('.item').find('h2').text($(this).val());
		});

		function reorder(){
			if($('.slides .item').length == 0)return;
			$('.slides .item').each(function(index,el){
				var slideindex = index;

				$(el).find('input, textarea, select').each(function(index,input){
					var name = $(input).attr('name').replace(/[0-9]+/g,slideindex);
					$(input).attr('name',name);
				});

				var upload = $(el).find('img[rel^="META[slides]"]');
				var rel = $(el).find('img[rel^="META[slides]"]').attr('rel').replace(/[0-9]+/,slideindex);
				upload.attr('rel',rel);
			});
		}

		$('.slides .item .browse').wpfiles(function(file){
			$(this).attr('src',file);
		});
		
		$('.slide-top-options2 .browse').wpfiles(function(file){
			$('.slide-wrapper').css('background','url('+file+')');
		});	

		$('.slides .item .actions .delete').live('click',function(e){
			e.preventDefault();
			// save any open edits
			$(this).parents('.item').find('textarea').each(function(){
				$(this).text($(this).val());
			});

			var slide = $(this).parents('.item').clone();
			console.log(slide);
			var undo = $('<div class="undo"> Oh Noooooo, I didn\'t mean to do that! <button class="button button-green">Undo It!</button></div>');
			
			$(this).parents('.item').slideUp(function(){
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

		$('.slides .item .actions .hide').live('click',function(e){
			if($(this).attr('checked')) {
				$(this).parents('.item').addClass('hidden');
			}else{
				$(this).parents('.item').removeClass('hidden');
			}
		});

		$('.slides .item .btn').live('mouseenter',function(){
			$($(this).parent()[0]).find('.editlink').clearQueue();
			var edit = $($(this).parent()[0]).find('.editlink');
			edit.fadeIn();
			var inside = edit.find('> div').css('width',1);
			inside.animate({'width':inside[0].scrollWidth});

		});
		
		$('.slides .item .btn-wrapper').live('mouseenter',function(){
			$(this).find('.editlink').clearQueue();
		});

		$('.slides .item .btn-wrapper').live('mouseleave',function(){
			$(this).find('.editlink').delay(500).fadeOut();
		});
		
		$('.slides .item .slide-photo').live('mouseenter',function(){
			$(this).find('.videolink').clearQueue();
			var edit = $(this).find('.videolink');
			edit.fadeIn();
			var inside = edit.find('> div').css('width',1);
			inside.animate({'width':inside[0].scrollWidth});

		});
		
		$('.slides .item .slide-photo').live('mouseenter',function(){
			$(this).find('.videolink').clearQueue();
		});

		$('.slides .item .slide-photo').live('mouseleave',function(){
			$(this).find('.videolink').delay(500).fadeOut();
		});		

		// Title
		$('.slides textarea.autoheight').live('keyup',function(e){
			$(this).css({'height':1});
			$(this).css({'height':$(this)[0].scrollHeight});
		});

		$('#AddSlide').click(function(e){
			e.preventDefault();

			var index = $('.slide').length;
			var template = $('#SlideTemplate').html();

			var defaults = {
				'index'			: index,
				'title'    		: 'New Slide '+index,
				'description'   : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'moretxt'   	: 'Learn More',
				'morelink' 		: '#'+index,
				'moretarget'	: '',
				'hide'			: '',
				'siteurl' 		: '<?=site_url()?>/',
				'imgsrc' 		: '<?=$defaultimg?>',
				'videolink' 	: '',
				'hideclass'		: ''
			};

			for(x in defaults)template = template.replace(new RegExp('\{\{'+x+'\}\}','ig'),defaults[x]);

			var newslide = $(template);
			
			newslide.hide();
			$('.slides').append(newslide);
			newslide.slideDown();

			newslide.find('textarea').each(function(index,el){
				$(el).css({'height':el.scrollHeight});
			});

			$('.slides').last().find(".positionable").draggable({
				'stop':function(){
					$(this).find('input[name*="left"]').val($(this).position().left);
					$(this).find('input[name*="top"]').val($(this).position().top);
				}
			});
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
				$( '.slides textarea.autoheight').each(function(index,el){$(el).css({'height':el.scrollHeight});});

			}

		});
		
		
	});
</script>