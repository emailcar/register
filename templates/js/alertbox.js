
	var alertBox={
		d:{
			background:'.alertBox-background',
			contentWrap:'.alertBox-Wrap',
			closeBtn:'.alertBox-close',
			loadBg:'.alertBox-load-bg',
			startFn:null,
			endFn:null
		},
		load:function(settings){
			var that=this;
			var settings=$.extend({
				close:true,
				time:null
			},settings)
			var s=that.d;
			if(s.startFn!==null){
				s.startFn();
			}
			var $loadBg=$(s.loadBg);		
			if($loadBg.size()===0){			
				var sBackgroundName=s.loadBg.slice(1);
				$('body').append('<div class='+sBackgroundName+'><img class="loading" src="http://www.emailcar.net/images/ico/loading.gif" /></div');
			}
			var sTop=$(document).scrollTop()+(($(window).height()-$(s.loadBg).find('.loading').height())/2)						
			$(s.loadBg).height($(document).height()).fadeTo('slow',0.8)
			$(s.loadBg).find('.loading').css({
				'top':sTop
			})		
			if(settings.time){
				settings.close==false;
				setTimeout(function(){
					$(s.loadBg).fadeOut('slow');
				},settings.time)
			}
			if(settings.close){
				$(s.loadBg).one('click',function(){
					$(this).fadeOut('slow');
				})
			}		
		},
		loadClose:function(){
			var that=this;
			$(that.d.loadBg).fadeOut('slow');			
		},
		open:function(content,settings){
			var that=this;
			var s=$.extend(that.d,settings);
			if(s.startFn!==null){
				s.startFn();
			}
			var $background=$(s.background);		
			if($background.size()===0){			
				var sBackgroundName=s.background.slice(1);
				$('body').append('<div class='+sBackgroundName+'></div');
			}
			$(s.background).height($(document).height()).fadeTo('slow',0.8)
			var $contentWrap=$(s.contentWrap);
			if($contentWrap.size()===0){
				var sContentWrapName=s.contentWrap.slice(1);
				var sCloseBtnName=s.closeBtn.slice(1);
				$('body').append('<div class="'+sContentWrapName+'"><div class="inner"><div class="hd"><div class="'+sCloseBtnName+'"></div></div><div class="bd"></div></div></div');
			}		
			$(s.contentWrap).fadeIn('slow')
			$(s.contentWrap+' .bd').show();
			var sType=typeof content;
			switch(sType){
				case 'string':
				$(s.contentWrap+" .bd").html(content)
				break;
				case 'object':
				content.clone(true).appendTo($(s.contentWrap+" .bd"))			
				break;
			}
			$(s.contentWrap+' '+s.closeBtn).bind('click',function(){
					that.close();
				})
			var sTop=$(document).scrollTop()+(($(window).height()-$(s.contentWrap).height())/2)
			$(s.contentWrap).css({
				'top':sTop
			})
			$(s.background).bind('click',function(event){
				if(event.target.className.indexOf(s.background.slice(1))!==-1){
					that.close();
				}
			})
			$(s.contentWrap).bind('click',function(event){			
				if(event.target.className.indexOf(s.contentWrap.slice(1))!==-1){
					that.close();
				}
			})
			
		},
		close:function(settings){
			var that=this;
			var s=$.extend(that.d,settings);
			if(s.endFn!==null){
				s.endFn()
			}
			$(s.background).hide();
			$(s.contentWrap).hide();
			$(s.contentWrap+' .bd').html('');
			s=that.d;	
		}
	}
