/*
 * Fabtabulous! Simple tabs using Prototype
 * http://tetlaw.id.au/view/blog/fabtabulous-simple-tabs-using-prototype/
 * Andrew Tetlaw
 * version 2 2008-08-10
 * http://creativecommons.org/licenses/by-sa/2.5/
 */
var Fabtabs = Class.create({
	initialize : function(element,options) {
		var parent = this.element = $(element);
		this.options = Object.extend({
		  hover: true,
		  remotehover: false,
		  anchorpolicy: 'allow-initial' // 'protect', 'allow', 'allow initial', 'disable'
		}, options || {});
		this.menu = this.element.select('a');
		this.hrefs = this.menu.map(function(elm){
		  return elm.href.match(/#(\w.+)/) ? RegExp.$1 : null;
		}).compact();
		this.on(this.getInitialTab());
		var onLocal = function(event) {
		  if(this.options.anchorpolicy !== 'allow'){ event.stop(); }
  		var elm = event.findElement("a");
  		this.activate(elm);
  		if(this.options.anchorpolicy === 'protect') { window.location.hash = '.'+this.tabID(elm); }
  	};
  	var onRemote = function(event) {
  	  if(this.options.anchorpolicy !== 'allow'){ event.stop(); }
	    var trig = event.findElement("a");
    	this.activate(this.tabID(trig));
    	if(this.options.anchorpolicy === 'protect') { window.location.hash = '.'+this.tabID(elm); }
	  }
		this.element.observe('click', onLocal.bindAsEventListener(this));
		if(this.options.hover) {
		  this.menu.each(function(elm){elm.observe('mouseover', onLocal.bindAsEventListener(this))}.bind(this));
		}
		var triggers = [];
		this.hrefs.each(function(id){
		  $$('a[href="#' + id + '"]').reject(function(elm){
		    return elm.descendantOf(parent)
		  }).each(function(trig){
		    triggers.push(trig);
		  });
		})
		triggers.each(function(elm){
		  elm.observe('click', onRemote.bindAsEventListener(this));
		  if(this.options.remotehover) {
  		  elm.observe('mouseover', onRemote.bindAsEventListener(this));
  		}
		}.bind(this));
	},
	activate: function(elm) {
	  if(typeof elm == 'string') {
	    elm = this.element.select('a[href="#'+ elm +'"]')[0];
	  }
	  this.on(elm);
		this.menu.without(elm).each(this.off.bind(this));
	},
	off: function(elm) {
		$(elm).removeClassName('active-tab');
		$(this.tabID(elm)).removeClassName('active-tab-body');
	},
	on: function(elm) {
		$(elm).addClassName('active-tab');
		$(this.tabID(elm)).addClassName('active-tab-body');
	},
	tabID: function(elm) {
		return elm.href.match(this.re)[1];
	},
	getInitialTab: function() {
		if(this.options.anchorpolicy !== 'disable' && document.location.href.match(this.re)) {
		  var hash = RegExp.$1;
		  if(hash.substring(0,1) == "."){
		    hash = hash.substring(1);
		  }
		  return this.element.select('a[href="#'+ hash +'"]')[0];
		} else {
		  return this.menu.first();
		}
	},
	re: /#(\.?\w.+)/
});

document.observe("dom:loaded", function(){ new Fabtabs('tabs'); });