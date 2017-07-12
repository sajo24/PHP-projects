$(function(){
	$(document).on('click','.likeListener',function(){
		var type = $(this).data('type');
		var thiss=$(this);
		
		//za liking
		if(type == 'like'){
			var id = $(this).data('id');
			var uip = $(this).data('uip');
			
			if(id != '' && uip !=''){
				$.get("pages/single_blog.php?t=like&p=" + id + "&u=" + uip +"",function(data){
					if( data=='success'){
						thiss.addClass('hidden');
						thiss.siblings().removeClass('hidden');
					}
				});
			}
		}else if(type == 'unlike'){
			var id = $(this).data('id');
			var uip = $(this).data('uip');
			
			if(id != '' && uip !=''){
				$.get("pages/single_blog.php?t=unlike&p=" + id + "&u=" + uip +"",function(data){
					if( data=='success'){
						thiss.addClass('hidden');
						thiss.siblings().removeClass('hidden');
					}
				});
			}
		}
	});
});