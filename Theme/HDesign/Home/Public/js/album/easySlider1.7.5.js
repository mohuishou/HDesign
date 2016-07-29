/*
 * 	Easy Slider 1.7 - jQuery plugin
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/4004/easy-slider-15-the-easiest-jquery-plugin-for-sliding
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 * 	Easy Slider 1.75 - jQuery plugin
 *	updated by Justin Carroll	
 *	http://www.3circlestudio.com/
 *
 *	Added option "allControls" to show both next/previous/first/last and
 *  numeric paging all at once
 *
 */
 
/*
 *	markup example for $("#slider").easySlider();
 *	
 * 	<div id="slider">
 *		<ul>
 *			<li><img src="images/01.jpg" alt="" /></li>
 *			<li><img src="images/02.jpg" alt="" /></li>
 *			<li><img src="images/03.jpg" alt="" /></li>
 *			<li><img src="images/04.jpg" alt="" /></li>
 *			<li><img src="images/05.jpg" alt="" /></li>
 *		</ul>
 *	</div>
 *
 */

(function($) {

	$.fn.easySlider = function(options){
	  
		// default configuration properties
		var defaults = {			
			prevId: 		'prevBtn',
			prevText: 		'Previous',
			nextId: 		'nextBtn',	
			nextText: 		'Next',
			controlsShow:	true,
			controlsBefore:	'',
			controlsAfter:	'',	
			controlsFade:	true,
			firstId: 		'firstBtn',
			firstText: 		'First',
			firstShow:		false,
			lastId: 		'lastBtn',	
			lastText: 		'Last',
			lastShow:		false,				
			vertical:		false,
			speed: 			800,
			auto:			false,
			pause:			2000,
			continuous:		false, 
			numeric: 		false,
			numericId: 		'controls',
			allControls:	true
		}; 
		
		var options = $.extend(defaults, options);  
				
		this.each(function() {
			var obj = $(this); 				
			var s = $("li", obj).length;
			var w = $("li", obj).width()+10; 
			var h = $("li", obj).height(); 
			var clickable = true;
			if ($(window).width() > 970) {
				//obj.width($(window).width()); 
			} else {
				obj.width(970); 
			}
			obj.height(h); 
			obj.css("overflow","hidden");
			var ts = s-1;
			var t = 0;
			var ulw = 0;
			$("ul", obj).css('width',s*w);
			
			var c = 0;
			$("ul li img", obj).each(function() {
				$(this).attr("rel", c);
				c += 1;
			});
			$('.info .right_col p').html($('#slider img[rel=0]').attr('data-content'));
			
			if(options.continuous){
				$("ul", obj).prepend($("ul li:last-child", obj).clone().removeClass('main').css("margin-left","-"+ ($("ul li:last-child", obj).find('img').width()+10) +"px"));
				$("ul", obj).prepend($("ul li:last-child", obj).prev("li").clone().removeClass('main').css("margin-left","-"+ ($("ul li:last-child", obj).find('img').width()+$("ul li:last-child", obj).prev().find('img').width()+20) +"px"));
				$("ul", obj).append($("ul li:nth-child(3)", obj).clone().removeClass('main'));
				$("ul", obj).append($("ul li:nth-child(4)", obj).clone().removeClass('main'));
				$("ul", obj).css('width',(s+1)*w);

				if ($(window).width() > 970) {
					fa = (($(window).width() - 970) / 2)-5;
				} else {
					fa = -5;
				}

				var ulw = 0;
				$("li", obj).each(function(index) {
					ulw += $(this).find('img').width()+10;
				});
				$("ul", obj).css({'width':ulw,'margin-left':fa});
			};				
			
			if(!options.vertical) $("li", obj).css('float','left');
								
			if(options.controlsShow){
				var html = options.controlsBefore;				
				if(options.numeric){
					html += '<ol id="'+ options.numericId +'"></ol>';
				} else if (options.allControls) {
					html += '<ul id="' + options.numericId + '">';
					if(options.firstShow) html += '<li id="'+ options.firstId +'"><a href=\"javascript:void(0);\">'+ options.firstText +'</a></li>';
					if(options.lastShow) html += ' <span id="'+ options.lastId +'"><a href=\"javascript:void(0);\">'+ options.lastText +'</a></li>';
					html += '</ul>';
					html += ' <span id="'+ options.prevId +'"><a href=\"javascript:void(0);\">'+ options.prevText +'</a></span>';
					html += ' <span id="'+ options.nextId +'"><a href=\"javascript:void(0);\">'+ options.nextText +'</a></span>';
				} else {
					html += '<ul id="' + options.numericId + '">';
					if(options.firstShow) html += '<li id="'+ options.firstId +'"><a href=\"javascript:void(0);\">'+ options.firstText +'</a></li>';
					html += ' <li id="'+ options.prevId +'"><a href=\"javascript:void(0);\">'+ options.prevText +'</a></li>';
					html += ' <li id="'+ options.nextId +'"><a href=\"javascript:void(0);\">'+ options.nextText +'</a></li>';
					if(options.lastShow) html += ' <li id="'+ options.lastId +'"><a href=\"javascript:void(0);\">'+ options.lastText +'</a></li>';	
					html += '</ul>';				
				};
				
				html += options.controlsAfter;						
				$(obj).after(html);										
			};
			
			if(options.numeric){									
				for(var i=0;i<s;i++){						
					$(document.createElement("li"))
						.attr('id',options.numericId + (i+1))
						.html('<a rel='+ i +' href=\"javascript:void(0);\">'+ (i+1) +'</a>')
						.appendTo($("#"+ options.numericId))
						.click(function(){							
							animate($("a",$(this)).attr('rel'),true);
						}); 												
				};
			} else if (options.allControls) {
				for(var i=0;i<s;i++){						
					$(document.createElement("li"))
						.attr('id',options.numericId + (i+1))
						.attr('class', 'numeric')
						.html('<a rel='+ i +' href=\"javascript:void(0);\">'+ (i+1) +'</a>')
						.appendTo($("#"+ options.numericId))
						.click(function(){							
							animate($("a",$(this)).attr('rel'),true);
						}); 												
				};
				$("#"+ options.numericId).appendTo('.info .right_col');
				$("#prevBtn").appendTo('#slider .buttons');
				$("#nextBtn").appendTo('#slider .buttons');
				
				$("#prevBtn a").height(h);
				$("#nextBtn a").height(h);
				$("a","#"+options.nextId).click(function(){		
					animate("next",true);
				});
				$("a","#"+options.prevId).click(function(){		
					animate("prev",true);				
				});	
				$("a","#"+options.firstId).click(function(){		
					animate("first",true);
				});				
				$("a","#"+options.lastId).click(function(){		
					animate("last",true);				
				});				
			} else {
				$("a","#"+options.nextId).click(function(){		
					animate("next",true);
				});
				$("a","#"+options.prevId).click(function(){		
					animate("prev",true);				
				});	
				$("a","#"+options.firstId).click(function(){		
					animate("first",true);
				});				
				$("a","#"+options.lastId).click(function(){		
					animate("last",true);				
				});				
			};
			
			function setCurrent(i){
				i = parseInt(i)+1;
				$('li', "#" + options.numericId).removeClass("current");
				$('li#' + options.numericId + i).addClass("current");

				ar = $('#slider img[rel=' + t + ']').width() + 15;
				$("#nextBtn").css({'left':ar})

				$('#slider img[rel=' + (i-1) + ']').animate({opacity: '1.0'}, 300, function() {
					$(this).css('filter', 'none');
				});
			};
			
			function adjust(){
				if(t>ts) t=0;		
				if(t<0) t=ts;	
				if(!options.vertical) {
					var a = 0;
					$("li.main", obj).each(function(index) {
						if (t > index) {
							a += $(this).find('img').width()+10;
						}
					});
					if ($(window).width() > 970) {
						a = (a * -1) + (($(window).width() - 970) / 2) - 5;
					} else {
						a = (a*-1) - 5;
					}
					$("ul",obj).css("margin-left", a);
					$('.info .right_col p').html($('#slider img[rel=' + t + ']').attr('data-content'));
				} else {
					$("ul",obj).css("margin-left",(t*h*-1));
				}
				clickable = true;
				if(options.numeric || options.allControls) setCurrent(t);
			};
			
			function animate(dir,clicked){
				$('.ivideo').hide();
				if (clickable){
					clickable = false;
					var ot = t;
					switch(dir){
						case "next":
							t = (ot>=ts) ? (options.continuous ? parseInt(t)+1 : ts) : parseInt(t)+1;
							break; 
						case "prev":
							t = (t<=0) ? (options.continuous ? t-1 : 0) : t-1;
							break; 
						case "first":
							t = 0;
							break; 
						case "last":
							t = ts;
							break; 
						default:
							t = dir;
							break; 
					};
					var diff = Math.abs(ot-t);
					var speed = diff*options.speed;
					$('#slider li img').animate({opacity: '0.3'}, 300, function() {
						$(this).css('filter', 'alpha(opacity=30)');
					});
					$('#slider li img[rel=' + t + ']').animate({opacity: '1.0'}, 300, function() {
						$(this).css('filter', 'none');
					});
					if(!options.vertical) {
						var a = 0;
						$("li.main", obj).each(function(index) {
							if (t > index) {
								a += $(this).find('img').width()+10;
							}
						});
						
						if (t == -1) {
							a = - $("li:nth-child(2)", obj).width();
						}
						
						if ($(window).width() > 970) {
							a = (a * -1) + (($(window).width() - 970) / 2) - 5;
						} else {
							a = (a*-1) - 5;
						}

						$("ul",obj).animate(
							{ marginLeft: a }, 
							{ queue:false, duration:speed, complete:adjust }
						);				
					} else {
						p = (t*h*-1);
						$("ul",obj).animate(
							{ marginTop: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);					
					};
					
					if(!options.continuous && options.controlsFade){
						if(t==ts){
							$("a","#"+options.nextId).hide();
							$("a","#"+options.lastId).hide();
						} else {
							$("a","#"+options.nextId).show();
							$("a","#"+options.lastId).show();					
						};
						if(t==0){
							$("a","#"+options.prevId).hide();
							$("a","#"+options.firstId).hide();
						} else {
							$("a","#"+options.prevId).show();
							$("a","#"+options.firstId).show();
						};					
					};				
					
					if(clicked) clearTimeout(timeout);
					if(options.auto && dir=="next" && !clicked){;
						timeout = setTimeout(function(){
							animate("next",false);
						},diff*options.speed+options.pause);
					};
			
				};
				
			};
			// init
			var timeout;
			if(options.auto){;
				timeout = setTimeout(function(){
					animate("next",false);
				},options.pause);
			};		
			
			if(options.numeric || options.allControls) setCurrent(0);
		
			if(!options.continuous && options.controlsFade){					
				$("a","#"+options.prevId).hide();
				$("a","#"+options.firstId).hide();				
			};				
			
		});
	  
	};

})(jQuery);