jQuery(document).ready(function($){   

    $('.video-placeholder').click(function(){
        video = '<iframe width="'+ $(this).width() +'" height="'+ $(this).height() +'" src="'+ $(this).attr('data-video') +'" frameborder="0" allowfullscreen class="player-vid" data-img="'+ $(this).attr('src') +'"></iframe>';
        $(this).hide();
        $(this).parent('.video-wrap').addClass('video');
        $(this).parent('.video-wrap').append(video);
    });     

});

