/*
 * When document was load, check if jcProjectItem is defined and generate in 
 * every item a progressbar with the count of the Item-ID
 * author: 		Stefan Jacomeit <stefan@jacomeit.com>
 * license:		GPLv2
 * copyright:	2011 Jacomeit.com
 */
jQuery(document).ready(function($){
	$.widget('ui.progeffects',$.extend({},$.ui.progressbar.prototype,{
	    options:{value:0,max:100,duration:250},
	    refreshed:0,
	    _init:function(){
	        $.ui.progressbar.prototype._init.call(this);
	    },
	    _refreshValue:function(){  
	        var value=this.value();
	        var percentage= this._percentage();
	        var time=new Date().getTime();
	        var duration=this.options.duration;
	        var max=this.options.max;
	        if(this.oldValue !== value){
	            this.oldValue=value;
	            this._trigger('change');
	        }
	        if(time - this.refreshed < duration && value < max){return;}
	        this.refreshed=time;
	        this.valueDiv.toggle(value > this.min).toggleClass('ui-corner-right',value===this.options.max).stop().animate({width:percentage.toFixed(0)+'%'},duration);
	        this.element.attr('aria-valuenow',value);
	    }
	}));
	$('.jcProjectItem').each(function(){
		var obj=$(this);
		var id=parseInt(obj.attr('id'));
		var update=function(){
			var value=obj.progeffects('value');
			var max=id;
			if (value < max){
				obj.progeffects('value',value+1);
				setTimeout(update,10);
			}
		};
		obj.progeffects().children('.ui-progressbar-value').html('<span>'+id.toPrecision(3)+'%</span>');
		update();
	});
});
