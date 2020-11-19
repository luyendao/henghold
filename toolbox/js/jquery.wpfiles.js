/*
 	jquery.wpfiles
	
	This plugin give smart developers power to use wordpress's built in file handling and upload in their meta_box interfaces

*/

(function($){
	$.fn.wpfiles = function(callback){
		this.live('click',function(e) {
			e.preventDefault();

			var send_attachment_bkp = wp.media.editor.send.attachment;
			var field = $('input[name="'+$(this).attr('rel')+'"]');
			var image = $(this);

			wp.media.editor.send.attachment = function(props, attachment) {

				var path = attachment.url.replace(location.protocol+'//'+location.hostname,'');

				image.attr('src', path);
				field.attr('value', path);
				callback(path);
				return null;
			}

			wp.media.editor.open();

			return false;
		});
	}
})(jQuery);