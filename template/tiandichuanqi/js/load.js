
$(document).ready(function(){
	    setTimeout(function(){$.fn.qqqun()},2000)
		$.fn.scroll_({arrows:false,mouseWheelSpeed: 30,verticalGutter:15});
		setTimeout(function(){
			$('#Introduction .Tab').Tab({lilab:"li",labselect:".change",Tabname:".Tab_nr",labaction:"click",animatename:"scroll_x",animateTime:300,mode:"none"})
			$('#Recharge .Tab').Tab({lilab:"li",labselect:".change",Tabname:".Tab_nr",labaction:"click",animatename:"scroll_x",animateTime:300,mode:"none"})
		},130)
		
		
		
		
		if ($("#PlayBanner").length>0)
		{
				$("#PlayBanner").ZHYslider({
						speed: 1200, 
						space: 6000,
						auto: true, //自动滚动
						affect:'fade',
						ctag: '.Slide_'
				})
					
			
		}
		
		if ($("#ZhiYe").length>0)
		{
			
				$("#ZhiYe").ZHYslider({
						speed: 1200, 
						space: 6000,
						auto: true, //自动滚动
						affect:'scrollx',
						ctag: '.Slide_',
						End:function(self,switch_obj,settings){
							self.find(".ZhiYeTab").on("click","li",function(){
								var index=$(this).index()
								switch_obj.find(settings.stag+':eq('+index+')').trigger(settings.trigger)
							})
						},
						beforeStart:function(self,index){
							self.find(".ZhiYeTab li:eq("+index+")").addClass('change').siblings().removeClass("change")
						}
				})
				
		
		}
	
		
		
		
	$("#PhotoshowGundong").jcarousellite_gundong({btn:1,list:".PicList li","visible":3,"auto":2500,"speed":300})		
	$(".Tab").Tab_()
		$.fn.hovers()
		
		
})

//悬停效果
$.fn.hovers=function(){
	
		
		$(".videos,.ad320x354").hover_animate(
				{
				  aniobj:
				  [
					  [
						  "img",					//应用对象
						  "",//初始CSS
						  "{'opacity':0.7}",		//mouseenter动画CSS
						  "{'opacity':1}",			//mouseleave动画css
						  "300",					//mouseenter 时间
						  "300"						//mouseleave 时间
					  ]
				  ]
				}
				
			)
	
		//装备悬停
		$(".PicList li").hover_animate(
				{
				  aniobj:
				  [
					  [
						  "self",					//应用对象
						  "",//初始CSS
						  "{'top':-10}",		//mouseenter动画CSS
						  "{'top':0}",			//mouseleave动画css
						  "300",					//mouseenter 时间
						  "300"						//mouseleave 时间
					  ]
					  ,[
						  ".photo img",					//应用对象
						  "",//初始CSS
						  "{'opacity':0.7}",		//mouseenter动画CSS
						  "{'opacity':1}",			//mouseleave动画css
						  "300",					//mouseenter 时间
						  "300"						//mouseleave 时间
					  ]
				  ]
				}
				
			)
		$("#menu li").hover_animate(
				{
				  aniobj:
				  [
					  [
						  "em",					//应用对象
						  "{'position':'relative'}",//初始CSS
						  "{'top':'20px'}",		//mouseenter动画CSS
						  "{'top':0}",			//mouseleave动画css
						  "300",					//mouseenter 时间
						  "300"						//mouseleave 时间
					  ],
					  [
						  "span",					//应用对象
						  "{'position':'relative'}",//初始CSS
						  "{'top':'-20px'}",		//mouseenter动画CSS
						  "{'top':0}",			//mouseleave动画css
						  "300",					//mouseenter 时间
						  "300"						//mouseleave 时间
					  ]
				  ]
				}
				
			)		
		$("#download ul li:even").GameHover("#f6d888",1,0,1);
		$("#download ul li:odd").GameHover("#fff",1,0,1);
		$("#quickLink .TextList li").GameHover("#b22338",1,0,1);
		$(".btn_backtop").bind("click",function(){
			$("html,body").animate({scrollTop:0},1000)	
			return false;
		})
		
		$("#Floatingbar").on("click",".btn_",function(){
				var float_obj=$("#Floatingbar")
				var btn=$(this);
				var text=btn.text();
				if (text=="收起")
				{
					btn.text("展开")	
					float_obj.stop(true,false).animate({"right":"-193px"},200)
				}
				else
				{
					btn.text("收起")	
					float_obj.stop(true,false).animate({"right":"0"},200)
				}
			
		})
	
}

//加载滚动条
$.fn.scroll_=function(config){
	var scrollobj=$("[data-scroll]")
	if (scrollobj.length==0) return false;
	scrollobj.each(function(index, element) {
			var self=$(this)
			if (self.length==0)  return false;
			
			var h=parseInt(self.attr("data-scroll-height")),
				w=parseInt(self.attr("data-scroll-width")),
				color=self.attr("data-scroll-color");
				self.css({"width":"100%"});
				self.wrap('<div class="container1" style="width:'+w+'px"></div>').wrap('<div class="div_scroll"></div>');
				self.parents('.div_scroll').css({height:h}).scroll_absolute(config)	
				self.find("img").load(function(){self.parents('.div_scroll').scroll_absolute(config);})
			
			if (typeof(color)!="undefined")
			{setTimeout(function(){self.parents(".container1").find(".scroll_drag").css({"background":color})},500);}
	});
}
//选项卡切换
		$.fn.Tab=function(config){
			var self=$(this);
			var select_=0;
			var classname=config.labselect.replace(".","")
			if (self.length==0) return false;
			if (self.find(config.lilab).length==0) return false;
			
			
			self.each(function(index, element) {
							
				self=$(this);
						
						if (self.find(config.labselect).length==0) 
						{self.find(config.lilab+":eq(0)").addClass(classname);}
						self.find(config.lilab).each(function(index, element) {
							if (!$(this).is(config.labselect))
							{
								self.siblings(config.Tabname+":eq("+index+")").hide();
							}
						});
						
						self.find(config.lilab).bind(config.labaction+".action",function(){
							
							var index=$(this).index();
							if(self.siblings(config.Tabname+":visible").is(":animated")){ 
							return false;
							
							}

							
							if ($(this).is(config.labselect)) return false;
							var index2=$(this).siblings(config.labselect).index()
							$(this).addClass(classname).siblings().removeClass(classname);
							
							config.animate(index,index2,config.animatename)
							return config.labaction=="click"?   false :  true;
						})
						
						config.animate=function(index,index2,active){
							
							switch (active)
							{
								case "fade":
									self.siblings(config.Tabname+":visible").hide();
									self.siblings(config.Tabname+":eq("+index+")").fadeIn(config.animateTime);
								break;
								case "scroll_x":
									self.parent().css({"position":"relative","overflow":"hidden"});
									var selfs=self.siblings(config.Tabname+":visible")
									var dr="100%",dr2="100%"
									if (index2>index)
									{
										dr="100%";
										dr2="-100%"
									}
									else
									{
										dr="-100%";
										dr2="100%"
									}
									var top=selfs.position().top
									
									
									if (config.mode=="delay")		
									{
									//当前渐隐
									selfs
									.css({"position":"relative","width":"100%"})
									.stop(true,false)
									.animate({"left":dr,"opacity":0},config.animateTime,
												function(){
													 $(this).css({"position":"static","left":"auto","opacity":1,"display":"none"}
												)}
											)
									setTimeout(function(){
												self.siblings(config.Tabname+":eq("+index+")").css({"position":"relative","left":dr2,"display":"block","opacity":0})
												.stop(true,false)
												.animate({"left":0,"opacity":1},config.animateTime
												,function(){
														$(this).css({"top":0,"position":"static"})	
														
												})
									},config.animateTime)		
								
									}
									
									else
									{
										
											selfs
											.css({"position":"absolute","width":"100%","left":selfs.position().left,"top":selfs.position().top})
											.stop(true,false)
											.animate({"left":dr,"opacity":0},config.animateTime,
												function(){
													 $(this).css({"position":"relative","top":"auto","left":"auto","opacity":1,"display":"none"}
												)}
											)
									
									
												self.siblings(config.Tabname+":eq("+index+")").css({"position":"relative","left":dr2,"display":"block","opacity":0})
												.stop(true,false)
												.animate({"left":0,"opacity":1},config.animateTime
												,function(){
														$(this).css({"top":0,"position":"relative"})	
														
												})
									}
								break;
								
								
								case "none":
									self.siblings(config.Tabname+":visible").hide();
									self.siblings(config.Tabname+":eq("+index+")").show();
								break;	
								
							}
							
							
						}


            });

		}
//选项卡滑动
	$.fn.Tab_=function(){
		var obj=$(this),times=300,delaytime=null
		if (obj.length==0) return false;
		obj.each(function(index, element) {
			var tab_obj=$(this)
			var li=tab_obj.find("li.change");
			if (li.length>0)
			{
				tab_obj.find("li:last-child").after("<span class='lines'></span>")
				obj.css("position","relative");
				var width	=	li.outerWidth();
				var lileft	=	li.position().left+parseInt(li.css("margin-left"))
				var lineobj	=	tab_obj.find(".lines")
				lineobj.css({"width":width,"left":lileft});
				
				tab_obj.find("li").bind("mouseenter",function(){
						clearTimeout(delaytime)
						var width	=	$(this).outerWidth();
						var left=$(this).position().left+parseInt($(this).css("margin-left"))
						lineobj.stop(true,false).animate({"width":width,"left":left},times)
				}).bind("mouseleave",function(){
					var self=$(this)
					delaytime=setTimeout(function(){
						if (!self.is(".change"))
						{
						var changeobj=self.siblings(".change")
						var left=changeobj.css("position","static").position().left+parseInt(changeobj.css("margin-left"));
						var width=changeobj.outerWidth()
						 lineobj.stop(true,false).animate({"width":width,"left":left},times)
						}
						
						
					},200)
				})
			}
		});	
	}
//滚动
		$.fn.jcarousellite_gundong=function(options ){
			var self=$(this);
			if (self.length==0) return false;
			var items=options.list,config;
			if (self.find(items).length<=options.visible) 
			{
				var width=self.find(options.list).parent().outerWidth()
				self.css({"margin":"0 auto","width":width})
			return false;	
			}
			else
			{
				var liobj=self.find(options.list)
				var width=liobj.outerWidth()
				var margin=parseInt(liobj.css("margin-left"))+parseInt(liobj.css("margin-right"));
				width+=margin
				self.css({"margin":"0 auto","width":width*options.visible})
			}
			self.css("overflow","visible");
			
			if (self.find(items).is("div"))
			{
				self.find(items).wrap("<li></li>");
				self.find(items).parent().wrapAll("<ul class='templist'></ul>");		
				items=".templist li"
			}
			self.find(items).parent().wrapAll('<div class="jCarouselLite"></div>').parent().wrapAll('<div class="gundong"></div>');
			
			
			if (options.btn!=0)
			{
				self.find(".gundong").append('<span class="clear"></span><a href="javascript:;"  class="move_right"><span></span></a><a href="javascript:;" class="move_left disabled" ><span></span></a>')
			}
			
			self.find(".gundong").each(function(index){
				
				config={
							btnPrev: $(this).find(".move_left:eq("+index+")"),
							btnNext: $(this).find(".move_right:eq("+index+")"),
							visible:1,
							auto: 2500 ,
							speed: 300
						}	
				if (options.btn==0)		
				{
					$.extend(config, {btnPrev:null,btnNext:null});							
				}
				$.extend(config, options);
				$(this).find(".jCarouselLite:eq("+index+")").jCarouselLite(config);	
			})
		}
$.fn.hover_animate=function(obj){
	var time_delay=null,runlist=[],runlist_end	=[],create_var=[],set_var=[],self=$(this)
		if (self.length==0) return false;
		if (obj.aniobj.length==0) return false;
		if (obj.set_class=="" || typeof (obj.set_class)=="undefined") {$.extend(obj,{set_class:"hover"});	}
		if (typeof(obj.delaytime)!="number" || typeof(obj.delaytime)=="undefined"){$.extend(obj,{delaytime:100});	}
		var fn={
			csschange:function(val){
				if (val==""){return '';}
				if (val.indexOf("{")<0 || val.indexOf("}")<0 )
				{
					val=$.trim(val)
					var last_fh=val.lastIndexOf(';')
					if (last_fh+1==val.length)
					{
						val=val.substring(0,last_fh);
						val='{\''+val.replace(/\:/g,"':'").replace(/\;/g,"','")+'\'}';
					}
					else
					{   val='{\''+val.replace(/\:/g,"':'").replace(/\;/g,"','")+'\'}';	}
				}
				return $.trim(val);
			}	
		}
		$.each(obj.aniobj,function(index,val){
			if (val.length<6) return false;
			var setobj			=	val[0],
				setobj_			=	setobj.replace(/\.|\ |\>/g,""),
				animate_css		=	fn.csschange(val[1]),
				animate_start	=	fn.csschange(val[2]),
				animate_end		=	fn.csschange(val[3]),
				animate_easing	=	val[4],
				animate_easing2	=	val[5],
				run				=	'',
				run_end			=	''
				
				if (setobj=="") return false;
				create_var.push('var _'+setobj_+'')
				setobj=="self" ? set_var.push('_'+setobj_+'=[self]'): set_var.push('_'+setobj_+'=[self].find("'+setobj+'")')
				if (animate_css=="" && animate_start=="") return false;
				if (animate_css!="" && animate_start!="")
				{run='_'+setobj_+'.css('+animate_css+').stop(true,false).animate('+animate_start+','+animate_easing+')'}		
				else if (animate_css=="" && animate_start!="")
				{run='_'+setobj_+'.stop(true,false).animate('+animate_start+','+animate_easing+')'}
				else if (animate_css!="" && animate_start=="")
				{run='_'+setobj_+'.css('+animate_css+')'}
				
				runlist.push(run)
				if (animate_end!="")
				{	
					run_end='_'+setobj_+'.animate('+animate_end+','+animate_easing2+')'
					runlist_end.push(run_end)
				}
				
		})
		var selfobj=null;
		self.unbind(".s")
		$.each(create_var,function(index,val){eval(val);})
		self.bind("mouseenter.s",function(){
			selfobj=$(this)
			$.each(set_var,function(index,val){eval(val.replace("[self]","selfobj"));})
			clearTimeout(time_delay)	
			time_delay=setTimeout(function(){
					if(!selfobj.is(":animated"))
					{
						selfobj.addClass(obj.set_class);
						$.each(runlist,function(index,val){eval(val)})	;
					}
			},obj.delaytime)
		})
		.bind("mouseleave.s",function(){
			clearTimeout(time_delay)	
			if (selfobj.is("."+obj.set_class))
			{		
				$.each(runlist_end,function(index,val){eval(val);})	
				selfobj.removeClass(obj.set_class);
			}
		})
}	


//弹窗口
function show(file,width,height)
{	
	$("#window").empty().remove();
	$("body").append('<div id="window"><div id="float_window"><iframe src="'+file+'" style="width:'+width+';height:'+height+';background-color:transparent;overflow:hidden;" scrolling="no" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="100%" height="100%"></iframe><span class="closewindow"></span></div></div>')
	$("#window").css("height",$(window).height()).show()
	$("#float_window").css({"width":width,"height":height,"margin-left":"-"+parseInt(width/2)+"px","margin-top":"-"+parseInt(height/2)+"px"})
	$(".closewindow").unbind("click");
	$(".closewindow").bind("click",function(){$("#window").empty().remove();})
}




//悬停效果
	$.fn.GameHover=function(bordercolors,width,margin,jiaocuo){
		var time_delay=null;
		var self=$(this)
		if (self.length==0) return false;
		
		var writehtml="<span class='line_top'></span><span class='line_right'></span><span class='line_bom'></span><span class='line_left'></span>"
		self.each(function(index, element) {
            $(this).append(writehtml)
			var line_top=$(this).find(".line_top");
			var line_right=$(this).find(".line_right");
			var line_bom=$(this).find(".line_bom");
			var line_left=$(this).find(".line_left");
			var bordercolor=bordercolors
			if (jiaocuo==1)
			{
				jiaocuo=margin;
			}
			else
			{
				jiaocuo=0;
			}
			line_top.css({"position":"absolute","left":jiaocuo,"top":margin,"height":width+"px",width:0,"overflow":"hidden","line-height":0,"font-size":0,"background":bordercolor});
			line_right.css({"position":"absolute","right":margin,"top":jiaocuo,"width":width+"px",height:0,"overflow":"hidden","line-height":0,"font-size":0,"background":bordercolor});
			line_bom.css({"position":"absolute","right":jiaocuo,"bottom":margin,"height":width+"px",width:0,"overflow":"hidden","line-height":0,"font-size":0,"background":bordercolor});
			line_left.css({"position":"absolute","left":margin,"bottom":jiaocuo,"width":width+"px",height:0,"overflow":"hidden","line-height":0,"font-size":0,"background":bordercolor});
        });
		
	
		var line_top,line_right,line_bom,line_left,txt_right;
		self.bind('mouseenter',function(){
					var selfs=$(this);
					line_top=selfs.find(".line_top");
					line_right=selfs.find(".line_right");
					line_bom=selfs.find(".line_bom");
					line_left=selfs.find(".line_left");
					txt_right=selfs.find(".txt_right")
					
					time_delay=setTimeout(function(){
								if(!selfs.is(":animated"))
								{
									
									selfs.addClass("star_animate");
									var easing={ duration:500,easing:'easeInOutCirc' };
									line_top.stop(true,false).animate({"width":"100%"}, easing);
									line_bom.stop(true,false).animate({"width":"100%"}, easing);
									line_right.stop(true,false).animate({"height":"100%"}, easing);
									line_left.stop(true,false).animate({"height":"100%"}, easing);
									txt_right.stop(true,false).animate({"left":"250"}, 500);
								}
						
					},100)
				
			}).bind('mouseleave',function(){
				    clearTimeout(time_delay)	
							var selfs=$(this);
							if (selfs.is(".star_animate"))
							{		
									selfs.removeClass("star_animate");
								
									var easing={ duration:800,easing:'easeInOutCirc' };
									line_top.stop(true,false).animate({"width":"0%"}, easing);
									line_bom.stop(true,false).animate({"width":"0%"}, easing);
									line_right.stop(true,false).animate({"height":"0%"}, easing);
									line_left.stop(true,false).animate({"height":"0%"}, easing);
									txt_right.stop(true,false).animate({"left":"10"}, 500);
							}
			})	
	
		
		
	}




	
jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});




//QQ群
$.fn.qqqun=function(){
	
 
    var type = 1;
    var param = "";
    var sid = 2;
    var rawuin = 617316893;

    var k = "http://qm.qq.com/cgi-bin/qm/qr?k=yzT9uM82V7LelBEEGHIuqnuAa2oFkIfn";
    var qun_type = "0";
    var referer = "";

	var getHost = function(url) { 
	    var regex = /.*\:\/\/([^\/]*).*/;
	    var match = url.match(regex);
	    if(typeof match != "undefined" && null != match)
	        host = match[1];
	    return host;
	}
	
	try{
		referer = getHost(referer);
	}catch(ex){}



    var $ = function(sId){
    	return document.getElementById(sId);
    }
	var getUrlParam = function ( name ,href ,noDecode ) {
		var re = new RegExp( '(?:\\?|#|&)' + name + '=([^&]*)(?:$|&|#)',  'i' ), m = re.exec( href );
		var ret = m ? m[1] : '' ;
		return !noDecode ? decodeURIComponent( ret ) : ret;
	}
    var showErrorTips = function(){
		$("mTitle").innerHTML = "该地址无效";
		$("mText").style.display = "none";
		$("m_container").style.display = "block";
		errorDataReport();
	}

    if(referer != "undefined")
    	referer = encodeURIComponent(referer.split("?")[0]);
    else 
    	referer = 0;

    var errorDataReport = function(){
    	if(qun_type === "0") {
    		reportData(11760, 1);
    	}else if(qun_type === "1"){
    		reportData(11763, 1);
    	}else{
    		reportData(11780, 1);
    	}
    }


	var usa=navigator.userAgent;
	var p;
	var kParam = getUrlParam("k",location.href);
	var REGEXP_IOS_QQ = /(iPad|iPhone|iPod).*? QQ\/([\d\.]+)/;
	var isiOSMQ = REGEXP_IOS_QQ.test(usa);

	//数据上报
	var reportData = function(nvalue,error){
	    var img = new Image();
	    var str = 'http://cgi.pub.qq.com/report/bnl?data='+ (referer || 0) + "," + nvalue + ","+ (error || 0) +"," + p ;
	    img.src = str;
	}
	//add by bizai 广点通广告转换率上报
	var reportGdt = function(qz_gdt){
		var timestamp = +new Date(),
            img = new Image();
        img.src = 'http://c.gdt.qq.com/gdt_trace_a.fcg?client=33&actionid=66&clickid='+ qz_gdt + '&t=' + timestamp;
	}
	var getCookie = function(name) {
        var m = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
        return !m ? "" : decodeURIComponent(m[2]);
    }

    // 产品下掉这个上报了
    // var qz_gdt = getCookie('qz_gdt');
    // if(qz_gdt) reportGdt(qz_gdt);


	var mobile_q_jump = {
		android:"http://mobile.qq.com/3g",
		ios:"itms-apps://itunes.apple.com/cn/app/qq-2011/id444934666?mt=8",
		winphone:"http://www.windowsphone.com/zh-cn/store/app/qq/b45f0a5f-13d8-422b-9be5-c750af531762",
		pc:"http://mobile.qq.com/index.html"
	};
	

	if(typeof type == "undefined") type = 1;

	if(usa.indexOf("Android")>-1){
		p = "android";
	}
	else if(usa.indexOf("iPhone")>-1 || usa.indexOf("iPad")>-1 || usa.indexOf("iPod")>-1){
		p = "ios";
	}
	else if(usa.indexOf("Windows Phone") > -1 || usa.indexOf("WPDesktop") > -1){
		p = "winphone";
	}
	else {
		p = "pc";
	}
	
	if(p == "ios"){
		//防止循环
		if(history.pushState && !isiOSMQ)
			history.pushState({},"t","#");

		
	}
	else if(p == "pc" && qsig != "undefined"){
		window.open(qsig,"_self");
	}
	
	
	if(type == 1){//手Q
		var isSuccess = true;

		//数据上报
		if(qun_type === "0")//单群
			reportData(11760);
		else if(qun_type === "1")//多群
			reportData(11763);
		else //二维码或短链接加群
			reportData(11780);

		var f = document.createElement("iframe");
		f.style.display = "none";
		document.body.appendChild(f);

		f.onload = function(){
			isSuccess = false;
		};
		setTimeout(function(){
			if(p == "ios" && sid == 2){//ios并且为群名片
				if((k == "undefined" || k=="") && !kParam){
					showErrorTips();
					return;
				}
				f.src = "mqqapi://card/show_pslcard?src_type=internal&version=1&uin="+ rawuin +"&card_type=group&source=qrcode";
			}
			else if(p != "pc"){
				var url = window.location.href.split("&");
				kParam = getUrlParam("k",location.href);
			
				if(kParam){
					f.src = "mqqopensdkapi://bizAgent/qm/qr?url=" + encodeURIComponent("http://qm.qq.com/cgi-bin/qm/qr?k=" + kParam);
				}
				else if(k!="undefined" && k!=""){
					f.src = "mqqopensdkapi://bizAgent/qm/qr?url=" + encodeURIComponent(k); 
				}
				else{
					showErrorTips();
					return;
				}

					
			}
			//群
			if(sid == 2 && p != "pc"){
				document.title = "申请加入QQ群";
				document.getElementById("m_container").style.display = "block";
				document.getElementById("update_link").onclick = function(){
					var jumpUrl = mobile_q_jump[p]; 
					if(jumpUrl) window.open(jumpUrl,"_self");
				}
			}

			var now = Date.now();
			//时间判断
			setTimeout( function(){
				if((p == "ios" && !isiOSMQ && Date.now() - now < 2000) || (p == "android" && !isSuccess) || ((p == "winphone" && Date.now() - now < 2000))){
					var jumpUrl = mobile_q_jump[p]; 
					
					errorDataReport();

					if(jumpUrl){
						setTimeout(function(){
							window.open(jumpUrl,"_self");
						},1000);
					}
				}
			} , 1500);
		},1500);
		
	}
	}