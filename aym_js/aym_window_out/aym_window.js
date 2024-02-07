function AyM_window(e,t){
	var n=this;
	n.options=jQuery.extend({},AyM_window.prototype.options,t||{});
	n.aym_window=jQuery(n.template);
	n.setContent(e);
	if(n.options.title==null){
		jQuery(".aym_window-titlebox",n.aym_window).remove()
	}else{
		jQuery(".aym_window-title",n.aym_window).append(n.options.title);
		
		if(n.options.buttons.length===0&&!n.options.autoclose){
			if(n.options.closeButton){
				var r=jQuery('<span class="aym_window-closebtn"></span>');
				r.bind("click",function(){n.hide()});
				jQuery(".aym_window-titlebox",this.aym_window).prepend(r)
			}
		}
			
		if(n.options.titleClass!=null)jQuery(".aym_window-titlebox",this.aym_window).addClass(n.options.titleClass)

	}
	if(n.options.contentClass!=null)jQuery(".aym_window-content",n.aym_window).addClass(n.options.contentClass)		
	if(n.options.boxClass!=null)jQuery(".aym_window-box",n.aym_window).addClass(n.options.boxClass)		
	if(n.options.width!=null)jQuery(".aym_window-box",n.aym_window).css("width",n.options.width);
	
	if(n.options.buttons.length>0){
		for(var i=0;i<n.options.buttons.length;i++){
			var s=n.options.buttons[i]["class"]?n.options.buttons[i]["class"]:"";
			var o=jQuery('<div class="btnbox"><button class="btn '+s+'" href="#">'+n.options.buttons[i].label+"</button></div>").data("value",n.options.buttons[i].val);
			o.bind("click",function(){var e=jQuery.data(this,"value");var t=n.options.callback!=null?function(){n.options.callback(e)}:null;n.hide(t)});
			jQuery(".aym_window-actions",this.aym_window).append(o)
		}
	}else{
		jQuery(".aym_window-footbox",this.aym_window).remove()
	}
		
	if(n.options.buttons.length===0&&n.options.title==null&&!n.options.autoclose){
		if(n.options.closeButton){
			var r=jQuery('<span class="aym_window-closebtn"></span>');
			r.bind("click",function(){n.hide()});
			jQuery(".aym_window-content",this.aym_window).prepend(r)
		}
	}


	
	n.modal=n.options.modal?jQuery('<div class="aym_window-modal"></div>').css({opacity:n.options.modalOpacity,width:jQuery(document).width(),height:jQuery(document).height(),"z-index":n.options.zIndex+jQuery(".aym_window").length}).appendTo($('body')):null;
	
	if(n.options.show)n.show();jQuery(window).bind("resize",function(){n.resize()});
	if(n.options.autoclose!=null){setTimeout(function(e){e.hide()},n.options.autoclose,this)}
		return n
	}
	
	AyM_window.prototype={
		options:{
			autoclose:null,
			buttons:[],
			callback:null,
			center:true,
			closeButton:true,
			height:"auto", 
			title:null,
			titleClass:null,
			contentClass:null,
			modal:false,
			modalOpacity:.5,
			padding:"10px",
			show:true,
			unload:true,
			viewport:{top:"0px",left:"0px"},
			width:"300px",
			zIndex:99999
		},
		template:'<div class="aym_window"><div class="aym_window-box aym_effects aym_fadein_up"><div class="aym_window-wrapper"><div class="aym_window-titlebox"><span class="aym_window-title"></span></div><div class="aym_window-content"></div><div class="aym_window-footbox"><div class="aym_window-actions"></div></div></div></div></div>',
		content:"<div></div>",
		visible:false,
		setContent:function(e){
			jQuery(".aym_window-content",this.aym_window).css({padding:this.options.padding,height:this.options.height}).empty().append(e)
		},
			
		viewport:function(){
					return{top:(jQuery(window).height()-this.aym_window.height())/2+jQuery(window).scrollTop()+"px",left:(jQuery(window).width()-this.aym_window.width())/2+jQuery(window).scrollLeft()+"px"}
				},
		show:function(){
				if(this.visible)return;
				if(this.options.modal&&this.modal!=null)this.modal.show();
				this.aym_window.appendTo($('body'));
				if(this.options.center)this.options.viewport=this.viewport(jQuery(".aym_window-box",this.aym_window));
				this.aym_window.css({top:this.options.viewport.top,left:this.options.viewport.left,"z-index":this.options.zIndex+jQuery(".aym_window").length}).show().animate({opacity:1},300);this.visible=true},
		hide:function(e){
			if(!this.visible)return;
			var t=this;
			this.aym_window.animate({opacity:0},300,function(){if(t.options.modal&&t.modal!=null)t.modal.remove();t.aym_window.css({display:"none"}).remove();t.visible=false;if(e)e.call();if(t.options.unload)t.unload()});return this},
		resize:function(){
			if(this.options.modal){
				jQuery(".aym_window-modal").css({width:jQuery(document).width(),height:jQuery(document).height()})}if(this.options.center){this.options.viewport=this.viewport(jQuery(".aym_window-box",this.aym_window));
				this.aym_window.css({top:this.options.viewport.top,left:this.options.viewport.left})
			}
		},
				
		toggle:function(){
			this[this.visible?"hide":"show"]();
			return this
			},
		unload:function(){
			if(this.visible)this.hide();
			jQuery(window).unbind("resize",function(){this.resize()});
			this.aym_window.remove()}
	};
			
	jQuery.extend(AyM_window,{
			alert:function(e,t,n){
				var r=[{id:"ok",label:"OK",val:"OK"}];
				n=jQuery.extend({closeButton:false,buttons:r,callback:function(){}},n||{},{show:true,unload:true,callback:t});
				return new AyM_window(e,n)
			},
				
			ask:function(e,t,n){
				var r=[
				{id:"yes",label:"Yes",val:"Y","class":"btn-success"},
				{id:"no",label:"No",val:"N","class":"btn-danger"}];
				n=jQuery.extend({
					closeButton:false,
					modal:true,
					buttons:r,
					callback:function(){}
				},
							
				n||{},{show:true,unload:true,callback:t});
				return new AyM_window(e,n)
			},
					
			img:function(e,t){
				var n=new Image;
				jQuery(n).load(function(){
					var e={
						width:jQuery(window).width()-50,
						height:jQuery(window).height()-50
					};
								
					var r=this.width>e.width||this.height>e.height?Math.min(e.width/this.width,e.height/this.height):1;
					jQuery(n).css({
						width:this.width*r,
						height:this.height*r
					});
						
					t=jQuery.extend(t||{},{
						show:true,
						unload:true,
						modal:true,
						boxClass:'box-img',
						closeButton:true,
						width:this.width*r,
						height:this.height*r,
						padding:0
			});
							
		new AyM_window(n,t)}).error(
			function(){console.log("Error loading "+e)}).attr("src",e)},
			load:function(e,t){
				t=jQuery.extend(
					t||{},{
						show:true,
						unload:true,
						modal:true,
						width:300,
						height:600,
						padding:0,
						params:{}
				});
	
				var n={
					url:e,
					data:t.params,
					dataType:"html",
					cache:false,
					error:function(e,t,n){console.log(e.responseText)},
					success:function(e){new AyM_window(e,t)}
				};
				

	jQuery.ajax(n)}
});