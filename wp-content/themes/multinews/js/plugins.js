(function(e,t,i){var n={},r=!0,s={},o={speed:800,timeout:5e3,autoScroll:!1,pauseOnHover:!1,effect:"scrollVert3d",perspective:1e3};e.jqBoxSlider=n,n.init=function(e){var i=t.extend({},o,e),r=n.slideAnimator(i.effect);return this.each(function(){var e=t(this),n=e.children(),s=t.extend({},i);e.data("bssettings",s),s.slideAnimator=r,s.slideAnimator.initialize(e,n,s),a(e,s),s.autoScroll&&(s.autointv=setInterval(function(){u(e)},s.timeout+s.speed),s.pauseOnHover&&e.on("hover",d))})},n.playPause=function(){return this.each(function(){d.call(t(this))})},n.showSlide=function(e){return e=parseInt(e,10),this.each(function(){var i=t(this);f(i),u(i,e)})},n.next=function(){return this.each(function(){var e=t(this);u(e)})},n.prev=function(){return this.each(function(){var e=t(this);u(e,null,!0)})},n.registerAnimator=function(e,i){t.each(e.split(","),function(e,t){s[t]=i}),i._cacheOriginalCSS=h,"function"==typeof i.configure&&i.configure(r,v)},n.slideAnimator=function(e){if("object"==typeof s[e])return s[e];throw Error("The slide animator for the "+e+" effect has not been registered")},n.option=function(e,r){return r===i?(this.data("bssettings")||{})[e]:this.each(function(){var s=t(this),o=s.data("bssettings")||{};return o[e]=r,f(s,o),"effect"===e?(o.slideAnimator.destroy(s,o),o.slideAnimator=n.slideAnimator(r),o._slideFilter=null,o.bsfaceindex=0,o.slideAnimator.initialize(s,s.children(),o),i):("function"==typeof o.slideAnimator.reset&&o.slideAnimator.reset(s,o),i)})},n.destroy=function(){return this.each(function(){var e=t(this),i=e.data()||{},n=i.bssettings;n&&"object"==typeof n.slideAnimator&&(n.autointv&&clearInterval(n.autointv),n.slideAnimator.destroy(e,n))})};var a=function(e,i){var n=t();null!=i.next&&(n=n.add(t(i.next).on("click",{reverse:!1},c))),null!=i.prev&&(n=n.add(t(i.prev).on("click",{reverse:!0},c))),null!=i.pause&&(n=n.add(t(i.pause).on("click",l))),n.data("bsbox",e)},c=function(e){var n=t(this).data("bsbox");f(n),u(n,i,e.data.reverse),e.preventDefault()},l=function(e){var i=t(this),n=i.data("bsbox");d.call(n),i.toggleClass("paused"),e.preventDefault()},d=function(e,i,n){var r,s=t(this);n||(n=s.data("bssettings")),r=null!=n.autointv,"function"==typeof n.onplaypause&&n.onplaypause.call(s,r?"pause":"play"),(!r&&!i||(n.autointv=clearInterval(n.autointv),i))&&(n.autointv=setInterval(function(){u(s)},n.timeout+n.speed))},u=function(e,i,n){var r,s,o,a,c=e.data("bssettings"),l=e.children();null!=c._slideFilter&&(l="function"==typeof c._slideFilter?l.filter(function(e){return c._slideFilter.call(l,e,c)}):l.filter(c.slideFilter)),r=c.bsfaceindex||0,s=p(r,l.length,n,i),e.hasClass("jbs-in-motion")||-1===s||(o=l.eq(r),a=l.eq(s),e.addClass("jbs-in-motion"),"function"==typeof c.onbefore&&c.onbefore.call(e,o,a,r,s),t.extend(c,c.slideAnimator.transition(t.extend({$box:e,$slides:l,$currSlide:o,$nextSlide:a,reverse:n,currIndex:r,nextIndex:s},c))),setTimeout(function(){e.removeClass("jbs-in-motion"),"function"==typeof c.onafter&&c.onafter.call(e,o,a,r,s)},c.speed),c.bsfaceindex=s)},f=function(e,t){t||(t=e.data("bssettings")||{}),t.autoScroll&&d.call(e,i,!0,t)},p=function(e,t,i,n){var r=n;return null==r&&(r=i?0>e-1?t-1:e-1:t>e+1?e+1:0),r===e||r>=t||0>r?-1:r},h=function(e,i,n,r){var s=["position","top","left","display","overflow","width","height"].concat(r||[]);n.origCSS||(n.origCSS={}),n.origCSS[i]||(n.origCSS[i]={}),t.each(s,function(t,r){n.origCSS[i][r]=e.css(r)})},v=function(){var e=document.body.style,t="";return"webkitTransition"in e&&(t="-webkit-"),"MozTransition"in e&&(t="-moz-"),r="webkitPerspective"in e||"MozPerspective"in e||"perspective"in e,t}();t.fn.boxSlider=function(e){return"string"==typeof e&&"function"==typeof n[e]?n[e].apply(this,Array.prototype.slice.call(arguments,1)):n.init.apply(this,arguments)}})(window,jQuery||Zepto),function(e){e.jqBoxSlider.registerAnimator("",function(){var e={};return e.configure=function(){},e.initialize=function(){},e.reset=function(){},e.transition=function(){},e.destroy=function(){},e}())}(window,jQuery||Zepto),function(e,t){e.jqBoxSlider.registerAnimator("blindDown,blindLeft",function(){var e={};e.initialize=function(e,r,s){var o,a=t(document.createElement("div")),c=n(r.eq(0)),l=0;for(s.blindCount||(s.blindCount=10),s.blindSpeed=s.speed,s.blindintv=s.speed/s.blindCount,s.speed+=s.blindintv*s.blindCount,s.blindSize=e.width()/s.blindCount,this._cacheOriginalCSS(e,"box",s),this._cacheOriginalCSS(r,"slides",s);s.blindCount>l;++l)o=l*s.blindSize,t(document.createElement("div")).css({position:"absolute",top:"0px",left:o+"px",width:s.blindSize+"px",height:"100%",backgroundImage:"url("+c+")",backgroundPosition:-o+"px 0px"}).appendTo(a);e.css("position","relative"),e.css({height:r.css("height"),overflow:"hidden"}),r.css({zIndex:1,position:"absolute",top:0,left:0}),a.css({position:"absolute",top:"0px",left:"0px",width:"100%",height:"100%",zIndex:2}).appendTo(e),s.$blinds=a,s._slideFilter=i},e.transition=function(e){var i=(e.$box.height(),e.$blinds.children());e.$slides.hide(),e.$nextSlide.show(),i.each(function(i,n){(function(){var s=e.blindintv*i,o=t(n);setTimeout(function(){o.animate(r(e),e.blindSpeed)},s)})()}),setTimeout(function(){i.css(s(e))},e.speed)},e.destroy=function(e,t){t.$blinds.remove(),e.css(t.origCSS.box),e.children().css(t.origCSS.slides),t.speed=t.blindSpeed,delete t.blindCount,delete t.blindSpeed,delete t.blindintv,delete t.$blinds,delete t.blindSize};var i=function(e,t){return this.get(e)!==t.$blinds.get(0)},n=function(e){return e.attr("src")||e.find("img").attr("src")},r=function(e){switch(e.effect){case"blindDown":return{top:"100%"};case"blindLeft":return{width:"0px"}}},s=function(e){var t={backgroundImage:"url("+n(e.$nextSlide)+")"};switch(e.effect){case"blindDown":t.top="0px";break;case"blindLeft":t.width=e.blindSize}return t};return e}())}(window,jQuery||Zepto),function(e,t){e.jqBoxSlider.registerAnimator("carousel3d",function(){var e={},i="";return e.configure=function(e,t){i=t},e.initialize=function(e,n,r){e.css(i+"transform-style","preserve-3d").css(i+"perspective",r.perspective||1e3).css({position:"absolute",top:"0px",left:"0px",width:n.width(),height:n.height()}).parent().css({overflow:"visible",position:"relative"}),n.css({position:"absolute",top:"0px",left:"0px"}),n.each(function(n,r){var s=t(r);s.css(i+"transform","translate3d("+(0===n?0:e.width()/2+50*n)+"px, 0px, "+(0===n?0:.5*-e.height())+"px) rotate3d(0,1,0,"+(0===n?0:-75+5*n)+"deg)")})},e}())}(window,jQuery||Zepto),function(e){e.jqBoxSlider.registerAnimator("fade",function(){var e={};return e.initialize=function(t,i,n){e._cacheOriginalCSS(t,"box",n),e._cacheOriginalCSS(i,"slides",n),-1!=="static inherit".indexOf(t.css("position"))&&t.css("position","relative"),t.css({height:i.eq(0).height(),overflow:"hidden"}),i.css({position:"absolute",top:0,left:0}).filter(":gt(0)").hide()},e.transition=function(e){e.$nextSlide.fadeIn(e.speed),e.$currSlide.fadeOut(e.speed)},e.destroy=function(e,t){e.children().css(t.origCSS.slides),e.css(t.origCSS.box)},e}())}(window,jQuery||Zepto),function(e,t){e.jqBoxSlider.registerAnimator("scrollVert3d,scrollHorz3d",function(){var e={},i=!1,n="";e.configure=function(e,t){i=e,n=t},e.initialize=function(r,s,o){var a=r.parent(),c=a.innerWidth(),l=a.innerHeight(),d={position:"absolute",top:0,left:0};e._cacheOriginalCSS(r,"box",o,[n+"transform",n+"transition",n+"transform-style"]),e._cacheOriginalCSS(s,"slides",o,[n+"transform"]),e._cacheOriginalCSS(a,"viewport",o,[n+"perspective"]),s.css(d),r.css(t.extend(d,{width:c,height:l})),-1!=="static inherit".indexOf(a.css("position"))&&a.css("position","relative"),i?(o.translateZ="scrollVert3d"===o.effect?l/2:c/2,o.bsangle=0,a.css(n+"perspective",o.perspective),a.css("overflow","visible"),r.css(n+"transform-style","preserve-3d"),r.css(n+"transform","translate3d(0, 0, -"+o.translateZ+"px)"),s.eq(0).css(n+"transform","rotate3d(0, 1, 0, 0deg) translate3d(0, 0, "+o.translateZ+"px)"),setTimeout(function(){e.reset(r,o)},10)):s.filter(":gt(0)").hide()},e.reset=function(e,t){var i=t.speed/1e3+"s";e.css(n+"transition",n+"transform "+i)},e.transition=function(e){var t=e.bsangle+(e.reverse?90:-90),s="scrollVert3d"===e.effect;return i?(0===t&&(t=e.reverse?360:-360),e.$currSlide.css("z-index",1),e.$slides.filter(function(t){return e.currIndex!==t}).css(n+"transform","none").css("display","none"),e.$nextSlide.css(n+"transform",r(t,s)+" translate3d(0, 0,"+e.translateZ+"px)").css({display:"block",zIndex:2}),e.$box.css(n+"transform","translate3d(0, 0, -"+e.translateZ+"px) rotate3d("+(s?"1, 0, 0, ":"0, 1, 0, ")+t+"deg)"),360===Math.abs(t)&&(e.$box.css(n+"transform","translate3d(0, 0, -"+e.translateZ+"px)"),t=0),{bsangle:t}):(e.$slides.filter(function(t){return e.currIndex!==t}).hide(),e.$currSlide.fadeOut(e.speed),e.$nextSlide.fadeIn(e.speed),undefined)},e.destroy=function(e,t){var i=e.children(),n=e.parent();t.origCSS&&(e.css(t.origCSS.box),i.css(t.origCSS.slides),n.css(t.origCSS.viewport),delete t.bsangle,delete t.translateZ)};var r=function(e,t){switch(e){case 360:case-360:return"rotate3d(0, 1, 0, 0deg)";case 90:case-270:return"rotate3d("+(t?"1, 0, 0,":"0, 1, 0,")+" -90deg)";case 180:case-180:return"rotate3d("+(t?"1, 0, 0,":"0, 1, 0,")+" 180deg)";case 270:case-90:return"rotate3d("+(t?"1, 0, 0,":"0, 1, 0,")+" 90deg)"}};return e}())}(window,jQuery||Zepto),function(e,t){e.jqBoxSlider.registerAnimator("scrollVert,scrollHorz",function(){var e={};e.initialize=function(t,i,n){var r=t.width(),s=i.eq(0).height();e._cacheOriginalCSS(t,"box",n),e._cacheOriginalCSS(i,"slides",n),-1!=="static inherit".indexOf(t.css("position"))&&t.css("position","relative"),t.css({height:s,overflow:"hidden"}),i.css({position:"absolute",top:0,left:0,width:r,height:s}).filter(":gt(0)").hide()},e.transition=function(e){var n=i(e.$box,"scrollVert"===e.effect,e.reverse);e.$nextSlide.css(t.extend(n.next,{display:"block"})).animate(n.anim,e.speed),e.$currSlide.animate(n.curr,e.speed)},e.destroy=function(e,t){e.children().css(t.origCSS.slides),e.css(t.origCSS.box)};var i=function(e,t,i){var n={curr:{},next:{}};return t?(n.next.top=(i?e.height():-e.height())+"px",n.curr.top=-parseInt(n.next.top,10)+"px",n.anim={top:"0px"}):(n.next.left=(i?-e.width():e.width())+"px",n.curr.left=-parseInt(n.next.left,10)+"px",n.anim={left:"0px"}),n};return e}())}(window,jQuery||Zepto),function(e,t){e.jqBoxSlider.registerAnimator("tile3d,tile",function(){var e={},i=!0,n="";e.configure=function(e,t){i=e,n=t},e.initialize=function(e,n,o){for(var a=o.tileRows||5,c=e.height()/a,l=Math.ceil(e.width()/c),d=r(n.eq(0)),u=t(document.createElement("div")),f=0,p=0,h=0,v=0;a>h;++h)for(p=h*c,v=0;l>v;++v)f=v*c,u.append(s({fromTop:p,fromLeft:v*c,imgURL:d,side:c,supports3d:i&&"tile3d"===o.effect}));-1==="absolute, relative".indexOf(e.css("position"))&&e.css("position","relative"),this._cacheOriginalCSS(e,"box",o),u.css({position:"absolute",top:0,left:0}),n.hide(),e.append(u),o.tileGrid={x:l,y:a},o.$tileWrapper=u,o._slideFilter=function(e,t){return this.get(e)!==t.$tileWrapper.get(0)}},e.transition=function(e){var t,s=e.$tileWrapper.find(".bs-tile"),o=e.rowOffset||100,a=(e.speed-o*(e.tileGrid.y-1))/e.tileGrid.x,c=r(e.$nextSlide),l=e.nextFace||"back",d=".bs-tile-face-"+l,u={},f=0;for("back"===l?(u.nextFace="front",t=180):(u.nextFace="back",t=0),s.find(d).css("background-image","url("+c+")");e.tileGrid.y>f;++f)(function(){var r=rowStart=f*e.tileGrid.x,c=rowStart+e.tileGrid.x,l=f*o,p=0;setTimeout(function(){for(;c>r;++r)(function(){var o=p*a,c=s.eq(r);setTimeout(function(){i&&"tile3d"===e.effect?c.css(n+"transform","rotate3d(0,1,0,"+t+"deg)"):c.find(".bs-tile-face-"+u.nextFace).fadeOut(100,function(){c.find(d).fadeIn(300)})},o)})(),p+=1},l)})();return u},e.destroy=function(e,t){t.$tileWrapper.remove(),e.children().show(),t.origCSS&&(e.css(t.origCSS.box),delete t.tileRows,delete t.rowOffset,delete t.tileGrid,delete t.$tileWrapper,delete t._slideFilter)};var r=function(e){return e.attr("src")||e.find("img").attr("src")},s=function(e){var i=t(document.createElement("div")),r=t(document.createElement("div")),s=t(document.createElement("div")),o=t(document.createElement("div"));return i.css({position:"absolute",top:e.fromTop,left:e.fromLeft,width:e.side,height:e.side}),r.addClass("bs-tile").css({width:e.side,height:e.side}).appendTo(i),o.addClass("bs-tile-face-back"),s.addClass("bs-tile-face-front").css("backgroundImage","url("+e.imgURL+")").add(o).css({width:e.side,height:e.side,backgroundPosition:-e.fromLeft+"px "+-e.fromTop+"px",position:"absolute",top:0,left:0}).appendTo(r),e.supports3d?(i.css(n+"perspective",400),r.css(n+"transform-style","preserve-3d").css(n+"transition",n+"transform .4s"),s.add(o).css(n+"backface-visibility","hidden"),o.css(n+"transform","rotateY(180deg)")):o.css("display","none"),i};return e}())}(window,jQuery||Zepto);
/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {

      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = '&shy;<style>         \
        .fluid-width-video-wrapper {        \
           width: 100%;                     \
           position: relative;              \
           padding: 0;                      \
        }                                   \
                                            \
        .fluid-width-video-wrapper iframe,  \
        .fluid-width-video-wrapper object,  \
        .fluid-width-video-wrapper embed {  \
           position: absolute;              \
           top: 0;                          \
           left: 0;                         \
           width: 100%;                     \
           height: 100%;                    \
        }                                   \
      </style>';

      ref.parentNode.insertBefore(div,ref);

    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})( jQuery );

(function(d){var p={},e,a,h=document,i=window,f=h.documentElement,j=d.expando;d.event.special.inview={add:function(a){p[a.guid+"-"+this[j]]={data:a,$element:d(this)}},remove:function(a){try{delete p[a.guid+"-"+this[j]]}catch(d){}}};d(i).bind("scroll resize",function(){e=a=null});!f.addEventListener&&f.attachEvent&&f.attachEvent("onfocusin",function(){a=null});setInterval(function(){var k=d(),j,n=0;d.each(p,function(a,b){var c=b.data.selector,d=b.$element;k=k.add(c?d.find(c):d)});if(j=k.length){var b;
if(!(b=e)){var g={height:i.innerHeight,width:i.innerWidth};if(!g.height&&((b=h.compatMode)||!d.support.boxModel))b="CSS1Compat"===b?f:h.body,g={height:b.clientHeight,width:b.clientWidth};b=g}e=b;for(a=a||{top:i.pageYOffset||f.scrollTop||h.body.scrollTop,left:i.pageXOffset||f.scrollLeft||h.body.scrollLeft};n<j;n++)if(d.contains(f,k[n])){b=d(k[n]);var l=b.height(),m=b.width(),c=b.offset(),g=b.data("inview");if(!a||!e)break;c.top+l>a.top&&c.top<a.top+e.height&&c.left+m>a.left&&c.left<a.left+e.width?
(m=a.left>c.left?"right":a.left+e.width<c.left+m?"left":"both",l=a.top>c.top?"bottom":a.top+e.height<c.top+l?"top":"both",c=m+"-"+l,(!g||g!==c)&&b.data("inview",c).trigger("inview",[!0,m,l])):g&&b.data("inview",!1).trigger("inview",[!1])}}},250)})(jQuery);
/*!
 * liScroll 1.0
 * Examples and documentation at: 
 * http://www.gcmingati.net/wordpress/wp-content/lab/jquery/newsticker/jq-liscroll/scrollanimate.html
 * 2007-2010 Gian Carlo Mingati
 * Version: 1.0.2.1 (22-APRIL-2011)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires:
 * jQuery v1.2.x or later
 * 
 */
jQuery.fn.liScroll = function(settings) {
		settings = jQuery.extend({
		travelocity: 0.07
		}, settings);		
		return this.each(function(){
				var $strip = jQuery(this);
				$strip.addClass("newsticker")
				var stripWidth = 1;
				$strip.find("li").each(function(i){
				stripWidth += jQuery(this, i).outerWidth(true); // thanks to Michael Haszprunar and Fabien Volpi
				});
				var $mask = $strip.wrap("<div class='mask'></div>");
				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
				var containerWidth = $strip.parent().parent().width();	//a.k.a. 'mask' width 	
				$strip.width(stripWidth);			
				var totalTravel = stripWidth+containerWidth;
				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
				function scrollnews(spazio, tempo){
				$strip.animate({left: '-='+ spazio}, tempo, "linear", function(){$strip.css("left", containerWidth); scrollnews(totalTravel, defTiming);});
				}
				scrollnews(totalTravel, defTiming);				
				$strip.hover(function(){
				jQuery(this).stop();
				},
				function(){
				var offset = jQuery(this).offset();
				var residualSpace = offset.left + stripWidth;
				var residualTime = residualSpace/settings.travelocity;
				scrollnews(residualSpace, residualTime);
				});			
		});	
};

/*----------------------------
    RTL Version
 ----------------------------*/
jQuery.fn.liScrollRight = function(settings) {
		settings = jQuery.extend({
		travelocity: 0.07
		}, settings);		
		return this.each(function(){
				var $strip = jQuery(this);
				$strip.addClass("newsticker")
				var stripWidth = 0;
				var $mask = $strip.wrap("<div class='mask'></div>");
				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
				var containerWidth = $strip.parent().parent().width();	//a.k.a. 'mask' width 	
				$strip.find("li").each(function(i){
				stripWidth += jQuery(this, i).width();
				});
				$strip.width(stripWidth);			
				var totalTravel = stripWidth+containerWidth;
				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
				function scrollnews(spazio, tempo){
				$strip.animate({right: '-='+ spazio}, tempo, "linear", function(){$strip.css("right", containerWidth); scrollnews(totalTravel, defTiming);});
				}
				scrollnews(totalTravel, defTiming);				
				$strip.hover(function(){
				jQuery(this).stop();
				},
				function(){
				var offset = jQuery(this).offset();
				var residualSpace = offset.left + stripWidth;
				var residualTime = residualSpace/settings.travelocity;
				scrollnews(residualSpace, residualTime);
				});			
		});	
};
/**
 * @name Owl Carousel - code name Phenix
 * @author Bartosz Wojciechowski
 * @release 2014
 * Licensed under MIT
 * 
 * @version 2.0.0-beta.1.9
 * @versionNotes Not compatibile with Owl Carousel <2.0.0
 */

/**
 * @name Owl Carousel - code name Phenix
 * @author Bartosz Wojciechowski
 * @release 2014
 * Licensed under MIT
 * 
 * @version 2.0.0-beta.1.9
 * @versionNotes Not compatibile with Owl Carousel <2.0.0
 */

/*

{0,0}
 )_)
 ""

To do:

* Lazy Load Icon
* prevent animationend bubling
* itemsScaleUp 
* Test Zepto

Callback events list:

onInitBefore
onInitAfter
onResponsiveBefore
onResponsiveAfter
onTransitionStart
onTransitionEnd
onTouchStart
onTouchEnd
onChangeState
onLazyLoaded
onVideoPlay
onVideoStop

Custom events list:

next.owl
prev.owl
goTo.owl
jumpTo.owl
addItem.owl
removeItem.owl
refresh.owl
play.owl
stop.owl
stopVideo.owl

*/


;(function ( $, window, document, undefined ) {

  var defaults = {
    items:        3,
    loop:       false,
    center:       false,

    mouseDrag:      true,
    touchDrag:      true,
    pullDrag:       true,
    freeDrag:     false,

    margin:       0,
    stagePadding:   0,

    merge:        false,
    mergeFit:     true,
    autoWidth:      false,
    autoHeight:     false,

    startPosition:    0,
    URLhashListener:  false,

    nav:        false,
    navRewind:      true,
    navText:      ['prev','next'],
    slideBy:      1,
    dots:         true,
    dotsEach:     false,
    dotData:      false,

    lazyLoad:     false,
    lazyContent:    false,

    autoplay:     false,
    autoplayTimeout:  5000,
    autoplayHoverPause: false,

    smartSpeed:     250,
    fluidSpeed:     false,
    autoplaySpeed:    false,
    navSpeed:     false,
    dotsSpeed:      false,
    dragEndSpeed:   false,

    responsive:     {},
    responsiveRefreshRate : 200,
    responsiveBaseElement: window,
    responsiveClass:  false,

    video:        false,
    videoHeight:    false,
    videoWidth:     false,

    animateOut:     false,
    animateIn:      false,

    fallbackEasing:   'swing',

    callbacks:      true,
    info:         false,

    nestedItemSelector: false,
    itemElement:    'div',
    stageElement:   'div',

    navContainer:     false,
    dotsContainer:    false,

    //Classes and Names
    themeClass:     'owl-theme',
    baseClass:      'owl-carousel',
    itemClass:      'owl-item',
    centerClass:    'center',
    activeClass:    'active',
    navContainerClass:  'owl-nav',
    navClass:     ['owl-prev','owl-next'],
    controlsClass:    'owl-controls',
    dotClass:       'owl-dot',
    dotsClass:      'owl-dots',
    autoHeightClass:  'owl-height'

  };

  // Reference to DOM elements
  // Those with $ sign are jQuery objects

  var dom = {
    el:     null, // main element 
    $el:    null, // jQuery main element 
    stage:    null, // stage
    $stage:   null, // jQuery stage
    oStage:   null, // outer stage
    $oStage:  null, // $ outer stage
    $items:   null, // all items, clones and originals included 
    $oItems:  null, // original items
    $cItems:  null, // cloned items only
    $cc:    null,
    $navPrev: null,
    $navNext: null,
    $page:    null,
    $nav:   null,
    $content: null
  };

  /**
   * Variables
   * @since 2.0.0
   */

  // Only for development process

  // Widths

  var width = {
    el:     0,
    stage:    0,
    item:   0,
    prevWindow: 0,
    cloneLast:  0
  };

  // Numbers

  var num = {
    items:        0,
    oItems:       0,
    cItems:       0,
    active:       0,
    merged:       [],
    nav:        [],
    allPages:     0
  };

  // Positions

  var pos = {
    start:    0,
    max:    0,
    maxValue: 0,
    prev:   0,
    current:  0,
    currentAbs: 0,
    currentPage:0,
    stage:    0,
    items:    [],
    lsCurrent:  0
  };

  // Drag/Touches

  var drag = {
    start:    0,
    startX:   0,
    startY:   0,
    current:  0,
    currentX: 0,
    currentY: 0,
    offsetX:  0,
    offsetY:  0,
    distance: null,
    startTime:  0,
    endTime:  0,
    updatedX: 0,
    targetEl: null
  };

  // Speeds

  var speed = {
    onDragEnd:  300,
    nav:    300,
    css2speed:  0

  };

  // States

  var state = {
    isTouch:    false,
    isScrolling:  false,
    isSwiping:    false,
    direction:    false,
    inMotion:   false,
    autoplay:   false,
    lazyContent:  false
  };

  // Event functions references

  var e = {
    _onDragStart: null,
    _onDragMove:  null,
    _onDragEnd:   null,
    _transitionEnd: null,
    _resizer:   null,
    _responsiveCall:null,
    _goToLoop:    null,
    _checkVisibile: null,
    _autoplay:    null,
    _pause:     null,
    _play:      null,
    _stop:      null
  };

  function Owl( element, options ) {

    // add basic Owl information to dom element

    element.owlCarousel = {
      'name':   'Owl Carousel',
      'author': 'Bartosz Wojciechowski',
      'version':  '2.0.0-beta.1.9',
      'released': '14.05.2014'
    };

    // Attach variables to object
    // Only for development process

    this.options =    $.extend( {}, defaults, options);
    this._options =   $.extend( {}, defaults, options);
    this.dom =      $.extend( {}, dom);
    this.width =    $.extend( {}, width);
    this.num =      $.extend( {}, num);
    this.pos =      $.extend( {}, pos);
    this.drag =     $.extend( {}, drag);
    this.speed =    $.extend( {}, speed);
    this.state =    $.extend( {}, state);
    this.e =      $.extend( {}, e);

    this.dom.el =   element;
    this.dom.$el =    $(element);
    this.init();
  }

  /**
   * init
   * @since 2.0.0
   */

  Owl.prototype.init = function(){

    this.fireCallback('onInitBefore');

    //Add base class
    if(!this.dom.$el.hasClass(this.options.baseClass)){
      this.dom.$el.addClass(this.options.baseClass);
    }

    //Add theme class
    if(!this.dom.$el.hasClass(this.options.themeClass)){
      this.dom.$el.addClass(this.options.themeClass);
    }

    //Add theme class
    if(this.options.rtl){
      this.dom.$el.addClass('owl-rtl');
    }

    // Check support
    this.browserSupport();

    // Sort responsive items in array
    this.sortOptions();

    // Update options.items on given size
    this.setResponsiveOptions();

    if(this.options.autoWidth && this.state.imagesLoaded !== true){
      var imgs = this.dom.$el.find('img');
      var nestedSelector = this.options.nestedItemSelector ? '.'+this.options.nestedItemSelector : undefined;
      var width = this.dom.$el.children(nestedSelector).width();

      if(imgs.length && width <= 0){
        this.preloadAutoWidthImages(imgs);
        return false;
      }
    }

    // Get and store window width
    // iOS safari likes to trigger unnecessary resize event
    this.width.prevWindow = this.windowWidth();

    // create stage object
    this.createStage();

    // Append local content 
    this.fetchContent();

    // attach generic events 
    this.eventsCall();

    // attach custom control events
    this.addCustomEvents();

    // attach generic events 
    this.internalEvents();

    this.dom.$el.addClass('owl-loading');
    this.refresh(true);
    this.dom.$el.removeClass('owl-loading').addClass('owl-loaded');
    this.fireCallback('onInitAfter');
  };

  /**
   * sortOptions
   * @desc Sort responsive sizes 
   * @since 2.0.0
   */

  Owl.prototype.sortOptions = function(){

    var resOpt = this.options.responsive;
    this.responsiveSorted = {};
    var keys = [],
    i, j, k;
    for (i in resOpt){
      keys.push(i);
    }

    keys = keys.sort(function (a, b) {return a - b;});

    for (j = 0; j < keys.length; j++){
      k = keys[j];
      this.responsiveSorted[k] = resOpt[k];
    }

  };

  /**
   * setResponsiveOptions
   * @since 2.0.0
   */

  Owl.prototype.setResponsiveOptions = function(){
    if(this.options.responsive === false){return false;}

    var width = this.windowWidth();
    var resOpt = this.options.responsive;
    var i,j,k, minWidth;

    // overwrite non resposnive options
    for(k in this._options){
      if(k !== 'responsive'){
        this.options[k] = this._options[k];
      }
    }

    // find responsive width
    for (i in this.responsiveSorted){
      if(i<= width){
        minWidth = i;
        // set responsive options
        for(j in this.responsiveSorted[minWidth]){
          this.options[j] = this.responsiveSorted[minWidth][j];
        }

      }
    }
    this.num.breakpoint = minWidth;

    // Responsive Class
    if(this.options.responsiveClass){
      this.dom.$el.attr('class',
        function(i, c){
        return c.replace(/\b owl-responsive-\S+/g, '');
      }).addClass('owl-responsive-'+minWidth);
    }


  };

  /**
   * optionsLogic
   * @desc Update option logic if necessery
   * @since 2.0.0
   */

  Owl.prototype.optionsLogic = function(){
    // Toggle Center class
    this.dom.$el.toggleClass('owl-center',this.options.center);

    // Scroll per - 'page' option will scroll per visible items number
    // You can set this to any other number below visible items.
    if(this.options.slideBy && this.options.slideBy === 'page'){
      this.options.slideBy = this.options.items;
    } else if(this.options.slideBy > this.options.items){
      this.options.slideBy = this.options.items;
    }

    // if items number is less than in body
    if(this.options.loop && this.num.oItems < this.options.items){
      this.options.loop = false;
    }

    if(this.num.oItems <= this.options.items && !this.options.center){
      this.options.navRewind = false;
    }

    if(this.options.autoWidth){
      this.options.stagePadding = false;
      this.options.dotsEach = 1;
      this.options.merge = false;
    }
    if(this.state.lazyContent){
      this.options.loop = false;
      this.options.merge = false;
      this.options.dots = false;
      this.options.freeDrag = false;
      this.options.lazyContent = true;
    }

    if((this.options.animateIn || this.options.animateOut) && this.options.items === 1 && this.support3d){
      this.state.animate = true;
    } else {this.state.animate = false;}

  };

  /**
   * createStage
   * @desc Create stage and Outer-stage elements
   * @since 2.0.0
   */

  Owl.prototype.createStage = function(){
    var oStage = document.createElement('div');
    var stage = document.createElement(this.options.stageElement);

    oStage.className = 'owl-stage-outer';
    stage.className = 'owl-stage';

    oStage.appendChild(stage);
    this.dom.el.appendChild(oStage);

    this.dom.oStage = oStage;
    this.dom.$oStage = $(oStage);
    this.dom.stage = stage;
    this.dom.$stage = $(stage);

    oStage = null;
    stage = null;
  };

  /**
   * createItem
   * @desc Create item container
   * @since 2.0.0
   */

  Owl.prototype.createItem = function(){
    var item = document.createElement(this.options.itemElement);
    item.className = this.options.itemClass;
    return item;
  };

  /**
   * fetchContent
   * @since 2.0.0
   */

  Owl.prototype.fetchContent = function(extContent){
    if(extContent){
      this.dom.$content = (extContent instanceof jQuery) ? extContent : $(extContent);
    }
    else if(this.options.nestedItemSelector){
      this.dom.$content= this.dom.$el.find('.'+this.options.nestedItemSelector).not('.owl-stage-outer');
    } 
    else {
      this.dom.$content= this.dom.$el.children().not('.owl-stage-outer');
    }
    // content length
    this.num.oItems = this.dom.$content.length;

    // init Structure
    if(this.num.oItems !== 0){
      this.initStructure();
    }
  };


  /**
   * initStructure
   * @param [refresh] - if refresh and not lazyContent then dont create normal structure
   * @since 2.0.0
   */

  Owl.prototype.initStructure = function(){

    // lazyContent needs at least 3*items 

    if(this.options.lazyContent && this.num.oItems >= this.options.items*3){
      this.state.lazyContent = true;
    } else {
      this.state.lazyContent = false;
    }

    if(this.state.lazyContent){

      // start position
      this.pos.currentAbs = this.options.items;

      //remove lazy content from DOM
      this.dom.$content.remove();

    } else {
      // create normal structure
      this.createNormalStructure();
    }
  };

  /**
   * createNormalStructure
   * @desc Create normal structure for small/mid weight content
   * @since 2.0.0
   */

  Owl.prototype.createNormalStructure = function(){
    for(var i = 0; i < this.num.oItems; i++){
      // fill 'owl-item' with content 
      var item = this.fillItem(this.dom.$content,i);
      // append into stage 
      this.dom.$stage.append(item);
    }
    this.dom.$content = null;
  };

  /**
   * createCustomStructure
   * @since 2.0.0
   */

  Owl.prototype.createCustomStructure = function(howManyItems){
    for(var i = 0; i < howManyItems; i++){
      var emptyItem = this.createItem();
      var item = $(emptyItem);

      this.setData(item,false);
      this.dom.$stage.append(item);
    }
  };

  /**
   * createLazyContentStructure
   * @desc Create lazyContent structure for large content and better mobile experience
   * @since 2.0.0
   */

  Owl.prototype.createLazyContentStructure = function(refresh){
    if(!this.state.lazyContent){return false;}

    // prevent recreate - to do
    if(refresh && this.dom.$stage.children().length === this.options.items*3){
      return false;
    }
    // remove items from stage
    this.dom.$stage.empty();

    // create custom structure
    this.createCustomStructure(3*this.options.items);
  };

  /**
   * fillItem
   * @desc Fill empty item container with provided content
   * @since 2.0.0
   * @param [content] - string/$dom - passed owl-item
   * @param [i] - index in jquery object
   * return $ new object
   */

  Owl.prototype.fillItem = function(content,i){
    var emptyItem = this.createItem();
    var c = content[i] || content;
    // set item data 
    var traversed = this.traversContent(c);
    this.setData(emptyItem,false,traversed);
    return $(emptyItem).append(c);
  };

  /**
   * traversContent
   * @since 2.0.0
   * @param [c] - content
   * return object
   */

  Owl.prototype.traversContent = function(c){
    var $c = $(c), dotValue, hashValue;
    if(this.options.dotData){
      dotValue = $c.find('[data-dot]').andSelf().data('dot');
    }
    // update URL hash
    if(this.options.URLhashListener){
      hashValue = $c.find('[data-hash]').andSelf().data('hash');
    }
    return {
      dot : dotValue || false,
      hash : hashValue  || false
    };
  };


  /**
   * setData
   * @desc Set item jQuery Data 
   * @since 2.0.0
   * @param [item] - dom - passed owl-item
   * @param [cloneObj] - $dom - passed clone item
   */


  Owl.prototype.setData = function(item,cloneObj,traversed){
    var dot,hash;
    if(traversed){
      dot = traversed.dot;
      hash = traversed.hash;
    }
    var itemData = {
      index:    false,
      indexAbs: false,
      posLeft:  false,
      clone:    false,
      active:   false,
      loaded:   false,
      lazyLoad: false,
      current:  false,
      width:    false,
      center:   false,
      page:   false,
      hasVideo: false,
      playVideo:  false,
      dot:    dot,
      hash:   hash
    };

    // copy itemData to cloned item 

    if(cloneObj){
      itemData = $.extend({}, itemData, cloneObj.data('owl-item'));
    }

    $(item).data('owl-item', itemData);
  };

  /**
   * updateLocalContent
   * @since 2.0.0
   */

  Owl.prototype.updateLocalContent = function(){
    this.dom.$oItems = this.dom.$stage.find('.'+this.options.itemClass).filter(function(){
      return $(this).data('owl-item').clone === false;
    });

    this.num.oItems = this.dom.$oItems.length;
    //update index on original items

    for(var k = 0; k<this.num.oItems; k++){
      var item = this.dom.$oItems.eq(k);
      item.data('owl-item').index = k;
    }
  };

  /**
   * checkVideoLinks
   * @desc Check if for any videos links
   * @since 2.0.0
   */

  Owl.prototype.checkVideoLinks = function(){
    if(!this.options.video){return false;}
    var videoEl,item;

    for(var i = 0; i<this.num.items; i++){

      item = this.dom.$items.eq(i);
      if(item.data('owl-item').hasVideo){
        continue;
      }

      videoEl = item.find('.owl-video');
      if(videoEl.length){
        this.state.hasVideos = true;
        this.dom.$items.eq(i).data('owl-item').hasVideo = true;
        videoEl.css('display','none');
        this.getVideoInfo(videoEl,item);
      }
    }
  };

  /**
   * getVideoInfo
   * @desc Get Video ID and Type (YouTube/Vimeo only)
   * @since 2.0.0
   */

  Owl.prototype.getVideoInfo = function(videoEl,item){

    var info, type, id,
      vimeoId = videoEl.data('vimeo-id'),
      youTubeId = videoEl.data('youtube-id'),
      width = videoEl.data('width') || this.options.videoWidth,
      height = videoEl.data('height') || this.options.videoHeight,
      url = videoEl.attr('href');

    if(vimeoId){
      type = 'vimeo';
      id = vimeoId;
    } else if(youTubeId){
      type = 'youtube';
      id = youTubeId;
    } else if(url){
      id = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

      if (id[3].indexOf('youtu') > -1) {
        type = 'youtube';
      } else if (id[3].indexOf('vimeo') > -1) {
        type = 'vimeo';
      }
      id = id[6];
    } else {
      throw new Error('Missing video link.');
    }

    item.data('owl-item').videoType = type;
    item.data('owl-item').videoId = id;
    item.data('owl-item').videoWidth = width;
    item.data('owl-item').videoHeight = height;

    info = {
      type: type,
      id: id
    };

    // Check dimensions
    var dimensions = width && height ? 'style="width:'+width+'px;height:'+height+'px;"' : '';

    // wrap video content into owl-video-wrapper div
    videoEl.wrap('<div class="owl-video-wrapper"'+dimensions+'></div>');

    this.createVideoTn(videoEl,info);
  };

  /**
   * createVideoTn
   * @desc Create Video Thumbnail
   * @since 2.0.0
   */

  Owl.prototype.createVideoTn = function(videoEl,info){

    var tnLink,icon,height;
    var customTn = videoEl.find('img');
    var srcType = 'src';
    var lazyClass = '';
    var that = this;

    if(this.options.lazyLoad){
      srcType = 'data-src';
      lazyClass = 'owl-lazy';
    }

    // Custom thumbnail

    if(customTn.length){
      addThumbnail(customTn.attr(srcType));
      customTn.remove();
      return false;
    }

    function addThumbnail(tnPath){
      icon = '<div class="owl-video-play-icon"></div>';

      if(that.options.lazyLoad){
        tnLink = '<div class="owl-video-tn '+ lazyClass +'" '+ srcType +'="'+ tnPath +'"></div>';
      } else{
        tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + tnPath + ')"></div>';
      }
      videoEl.after(tnLink);
      videoEl.after(icon);
    }

    if(info.type === 'youtube'){
      var path = "http://img.youtube.com/vi/"+ info.id +"/hqdefault.jpg";
      addThumbnail(path);
    } else
    if(info.type === 'vimeo'){
      $.ajax({
        type:'GET',
        url: 'http://vimeo.com/api/v2/video/' + info.id + '.json',
        jsonp: 'callback',
        dataType: 'jsonp',
        success: function(data){
          var path = data[0].thumbnail_large;
          addThumbnail(path);
          if(that.options.loop){
            that.updateItemState();
          }
        }
      });
    }
  };

  /**
   * stopVideo
   * @since 2.0.0
   */

  Owl.prototype.stopVideo = function(){
    this.fireCallback('onVideoStop');
    var item = this.dom.$items.eq(this.state.videoPlayIndex);
    item.find('.owl-video-frame').remove();
    item.removeClass('owl-video-playing');
    this.state.videoPlay = false;
  };

  /**
   * playVideo
   * @since 2.0.0
   */

  Owl.prototype.playVideo = function(ev){
    this.fireCallback('onVideoPlay');

    if(this.state.videoPlay){
      this.stopVideo();
    }
    var videoLink,videoWrap,
      target = $(ev.target || ev.srcElement),
      item = target.closest('.'+this.options.itemClass);

    var videoType = item.data('owl-item').videoType,
      id = item.data('owl-item').videoId,
      width = item.data('owl-item').videoWidth || Math.floor(item.data('owl-item').width - this.options.margin),
      height = item.data('owl-item').videoHeight || this.dom.$stage.height();

    if(videoType === 'youtube'){
      videoLink = "<iframe width=\""+ width +"\" height=\""+ height +"\" src=\"http://www.youtube.com/embed/" + id + "?autoplay=1&v=" + id + "\" frameborder=\"0\" allowfullscreen></iframe>";
    } else if(videoType === 'vimeo'){
      videoLink = '<iframe src="http://player.vimeo.com/video/'+ id +'?autoplay=1" width="'+ width +'" height="'+ height +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

    item.addClass('owl-video-playing');
    this.state.videoPlay = true;
    this.state.videoPlayIndex = item.data('owl-item').indexAbs;

    videoWrap = $('<div style="height:'+ height +'px; width:'+ width +'px" class="owl-video-frame">' + videoLink + '</div>');
    target.after(videoWrap);
  };

  /**
   * loopClone
   * @desc Make a clones for infinity loop
   * @since 2.0.0
   */

  Owl.prototype.loopClone = function(){
    if(!this.options.loop || this.state.lazyContent || this.num.oItems < this.options.items){return false;}

    var firstClone, lastClone, i,
      num =   this.options.items, 
      lastNum = this.num.oItems-1;

    // if neighbour margin then add one more duplicat
    if(this.options.stagePadding && this.options.items === 1){
      num+=1;
    }
    this.num.cItems = num * 2;

    for(i = 0; i < num; i++){
      // Clone item 
      var first =   this.dom.$oItems.eq(i).clone(true,true);
      var last =    this.dom.$oItems.eq(lastNum-i).clone(true,true);
      firstClone =  $(first[0]).addClass('cloned');
      lastClone =   $(last[0]).addClass('cloned');

      // set clone data 
      // Somehow data has reference to same data id in cash 

      this.setData(firstClone[0],first);
      this.setData(lastClone[0],last);

      firstClone.data('owl-item').clone = true;
      lastClone.data('owl-item').clone = true;

      this.dom.$stage.append(firstClone);
      this.dom.$stage.prepend(lastClone);

      firstClone = lastClone = null;
    }

    this.dom.$cItems = this.dom.$stage.find('.'+this.options.itemClass).filter(function(){
      return $(this).data('owl-item').clone === true;
    });
  };

  /**
   * reClone
   * @desc Update Cloned elements
   * @since 2.0.0
   */

  Owl.prototype.reClone = function(){
    // remove cloned items 
    if(this.dom.$cItems !== null){ // && (this.num.oItems !== 0 && this.num.oItems <= this.options.items)){
      this.dom.$cItems.remove();
      this.dom.$cItems = null;
      this.num.cItems = 0;
    }

    if(!this.options.loop){
      return;
    }
    // generete new elements 
    this.loopClone();
  };

  /**
   * calculate
   * @desc Update item index data
   * @since 2.0.0
   */

  Owl.prototype.calculate = function(){

    var i,j,k,dist,posLeft=0,fullWidth=0;

    // element width minus neighbour 
    this.width.el = this.dom.$el.width() - (this.options.stagePadding*2);

    //to check
    this.width.view = this.dom.$el.width();

    // calculate width minus addition margins 
    var elMinusMargin = this.width.el - (this.options.margin * (this.options.items === 1 ? 0 : this.options.items -1));

    // calculate element width and item width 
    this.width.el =   this.width.el + this.options.margin;
    this.width.item =   ((elMinusMargin / this.options.items) + this.options.margin).toFixed(3);

    this.dom.$items =   this.dom.$stage.find('.owl-item');
    this.num.items =  this.dom.$items.length;

    //change to autoWidths
    if(this.options.autoWidth){
      this.dom.$items.css('width','');
    }

    // Set grid array 
    this.pos.items =  [];
    this.num.merged =   [];
    this.num.nav =    [];

    // item distances
    if(this.options.rtl){
      dist = this.options.center ? -((this.width.el)/2) : 0;
    } else {
      dist = this.options.center ? (this.width.el)/2 : 0;
    }

    this.width.mergeStage = 0;

    // Calculate items positions
    for(i = 0; i<this.num.items; i++){

      // check merged items

      if(this.options.merge){
        var mergeNumber = this.dom.$items.eq(i).find('[data-merge]').attr('data-merge') || 1;
        if(this.options.mergeFit && mergeNumber > this.options.items){
          mergeNumber = this.options.items;
        }
        this.num.merged.push(parseInt(mergeNumber));
        this.width.mergeStage += this.width.item * this.num.merged[i];
      } else {
        this.num.merged.push(1);
      }

      // Array based on merged items used by dots and navigation
      if(this.options.loop){
        if(i>=this.num.cItems/2 && i<this.num.cItems/2+this.num.oItems){
          this.num.nav.push(this.num.merged[i]);
        }
      } else {
        this.num.nav.push(this.num.merged[i]);
      }

      var iWidth = this.width.item * this.num.merged[i];

      // autoWidth item size
      if(this.options.autoWidth){
        iWidth = this.dom.$items.eq(i).width() + this.options.margin;
        if(this.options.rtl){
          this.dom.$items[i].style.marginLeft = this.options.margin + 'px';
        } else {
          this.dom.$items[i].style.marginRight = this.options.margin + 'px';
        }

      }
      // push item position into array
      this.pos.items.push(dist);

      // update item data
      this.dom.$items.eq(i).data('owl-item').posLeft = posLeft;
      this.dom.$items.eq(i).data('owl-item').width = iWidth;

      // dist starts from middle of stage if center
      // posLeft always starts from 0
      if(this.options.rtl){
        dist += iWidth;
        posLeft += iWidth;
      } else{
        dist -= iWidth;
        posLeft -= iWidth;
      }

      fullWidth -= Math.abs(iWidth);

      // update position if center
      if(this.options.center){
        this.pos.items[i] = !this.options.rtl ? this.pos.items[i] - (iWidth/2) : this.pos.items[i] + (iWidth/2);
      }
    }

    if(this.options.autoWidth){
      this.width.stage = this.options.center ? Math.abs(fullWidth) : Math.abs(dist);
    } else {
      this.width.stage = Math.abs(fullWidth);
    }

    //update indexAbs on all items 
    var allItems = this.num.oItems + this.num.cItems;

    for(j = 0; j< allItems; j++){
      this.dom.$items.eq(j).data('owl-item').indexAbs = j;
    }

    // Set Min and Max
    this.setMinMax();

    // Recalculate grid 
    this.setSizes();
  };

  /**
   * setMinMax
   * @since 2.0.0
   */

  Owl.prototype.setMinMax = function(){

    // set Min
    var minimum = this.dom.$oItems.eq(0).data('owl-item').indexAbs;
    this.pos.min = 0;
    this.pos.minValue = this.pos.items[minimum];

    // set max position
    if(!this.options.loop){
      this.pos.max = this.num.oItems-1;
    }

    if(this.options.loop){
      this.pos.max = this.num.oItems+this.options.items;
    }

    if(!this.options.loop && !this.options.center){
      this.pos.max = this.num.oItems-this.options.items;
    }

    if(this.options.loop && this.options.center){
      this.pos.max = this.num.oItems+this.options.items;
    }

    //set max value
    this.pos.maxValue = this.pos.items[this.pos.max];

    //Max for autoWidth content 
    if((!this.options.loop && !this.options.center && this.options.autoWidth) || (this.options.merge && !this.options.center) ){
      var revert = this.options.rtl ? 1 : -1;
      for (i = 0; i < this.pos.items.length; i++) {
        if( (this.pos.items[i] * revert) < this.width.stage-this.width.el ){
          this.pos.max = i+1;
        }
      }
      this.pos.maxValue = this.options.rtl ? this.width.stage-this.width.el : -(this.width.stage-this.width.el);
      this.pos.items[this.pos.max] = this.pos.maxValue;
    }

    // Set loop boundries
    if(this.options.center){
      this.pos.loop = this.pos.items[0]-this.pos.items[this.num.oItems];
    } else {
      this.pos.loop = -this.pos.items[this.num.oItems];
    }

    //if is less items
    if(this.num.oItems < this.options.items && !this.options.center){
      this.pos.max = 0;
      this.pos.maxValue = this.pos.items[0];
    }
  };

  /**
   * setSizes
   * @desc Set sizes on elements (from collectData function)
   * @since 2.0.0
   */

  Owl.prototype.setSizes = function(){

    // show neighbours 
    if(this.options.stagePadding !== false){
      this.dom.oStage.style.paddingLeft =   this.options.stagePadding + 'px';
      this.dom.oStage.style.paddingRight =  this.options.stagePadding + 'px';
    }

    // CRAZY FIX!!! Doublecheck this!
    //if(this.width.stagePrev > this.width.stage){
    if(this.options.rtl){
      window.setTimeout(function(){
        this.dom.stage.style.width = this.width.stage + 'px';
      }.bind(this),0);
    } else{
      this.dom.stage.style.width = this.width.stage + 'px';
    }

    for(var i=0; i<this.num.items; i++){

      // Set items width
      if(!this.options.autoWidth){
        this.dom.$items[i].style.width = this.width.item - (this.options.margin) + 'px';
      }
      // add margin
      if(this.options.rtl){
        this.dom.$items[i].style.marginLeft = this.options.margin + 'px';
      } else {
        this.dom.$items[i].style.marginRight = this.options.margin + 'px';
      }

      if(this.num.merged[i] !== 1 && !this.options.autoWidth){
        this.dom.$items[i].style.width = (this.width.item * this.num.merged[i]) - (this.options.margin) + 'px';
      }
    }

    // save prev stage size 
    this.width.stagePrev = this.width.stage;
  };

  /**
   * responsive
   * @desc Responsive function update all data by calling refresh() 
   * @since 2.0.0
   */

  Owl.prototype.responsive = function(){

    if(!this.num.oItems){return false;}
    // If El width hasnt change then stop responsive 
    var elChanged = this.isElWidthChanged();
    if(!elChanged){return false;}

    // if Vimeo Fullscreen mode
    var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;
    if(fullscreenElement){
      if($(fullscreenElement.parentNode).hasClass('owl-video-frame')){
        this.setSpeed(0);
        this.state.isFullScreen = true;
      }
    }

    if(fullscreenElement && this.state.isFullScreen && this.state.videoPlay){
      return false;
    }

    // Comming back from fullscreen
    if(this.state.isFullScreen){
      this.state.isFullScreen = false;
      return false;
    }

    // check full screen mode and window orientation
    if (this.state.videoPlay) {
      if(this.state.orientation !== window.orientation){
        this.state.orientation = window.orientation;
        return false;
      }
    }

    this.fireCallback('onResponsiveBefore');
    this.state.responsive = true;
    this.refresh();
    this.state.responsive = false;
    this.fireCallback('onResponsiveAfter');
  };

  /**
   * refresh
   * @desc Refresh method is basically collection of functions that are responsible for Owl responsive functionality
   * @since 2.0.0
   */

  Owl.prototype.refresh = function(init){

    if(this.state.videoPlay){
      this.stopVideo();
    }

    // Update Options for given width
    this.setResponsiveOptions();

    //set lazy structure
    this.createLazyContentStructure(true);

    // update info about local content
    this.updateLocalContent();

    // udpate options
    this.optionsLogic();

    // if no items then stop 
    if(this.num.oItems === 0){
      if(this.dom.$page !== null){
        this.dom.$page.hide();
      }
      return false;
    }

    // Hide and Show methods helps here to set a proper widths.
    // This prevents Scrollbar to be calculated in stage width
    this.dom.$stage.addClass('owl-refresh');

    // Remove clones and generate new ones
    this.reClone();

    // calculate 
    this.calculate();

    //aaaand show.
    this.dom.$stage.removeClass('owl-refresh');

    // to do
    // lazyContent last position on refresh
    if(this.state.lazyContent){
      this.pos.currentAbs = this.options.items;
    }

    this.initPosition(init);

    // jump to last position 
    if(!this.state.lazyContent && !init){
      this.jumpTo(this.pos.current,false); // fix that 
    }

    //Check for videos ( YouTube and Vimeo currently supported)
    this.checkVideoLinks();

    this.updateItemState();

    // Update controls
    this.rebuildDots();

    this.updateControls();

    // update drag events
    //this.updateEvents();

    // update autoplay
    this.autoplay();

    this.autoHeight();

    this.state.orientation = window.orientation;

    this.watchVisibility();
  };

  /**
   * updateItemState
   * @desc Update information about current state of items (visibile, hidden, active, etc.)
   * @since 2.0.0
   */

  Owl.prototype.updateItemState = function(update){

    if(this.state.lazyContent){
      this.updateLazyContent(update);
    }

    if(this.options.center){
      this.dom.$items.eq(this.pos.currentAbs)
      .addClass(this.options.centerClass)
      .data('owl-item').center = true;
    }
    if(this.options.lazyLoad){
      this.lazyLoad();
    }
  };

  /**
   * updateActiveItems
   * @since 2.0.0
   */


  Owl.prototype.updateActiveItems = function(){
    var i,j,item,ipos,iwidth,wpos,stage,outsideView,foundCurrent;
    // clear states
    for(i = 0; i<this.num.items; i++){
      this.dom.$items.eq(i).data('owl-item').active = false;
      this.dom.$items.eq(i).data('owl-item').current = false;
      this.dom.$items.eq(i).removeClass(this.options.activeClass).removeClass(this.options.centerClass);
    }

    this.num.active = 0;
    stageX = this.pos.stage;
    view = this.options.rtl ? this.width.view : -this.width.view;

    for(j = 0; j<this.num.items; j++){

        item = this.dom.$items.eq(j);
        ipos = item.data('owl-item').posLeft;
        iwidth = item.data('owl-item').width;
        outsideView = this.options.rtl ? ipos + iwidth : ipos - iwidth;

      if( (this.op(ipos,'<=',stageX) && (this.op(ipos,'>',stageX + view))) || 
        (this.op(outsideView,'<',stageX) && this.op(outsideView,'>',stageX + view)) 
        ){

        this.num.active++;

        if(this.options.freeDrag && !foundCurrent){
          foundCurrent = true;
          this.pos.current = item.data('owl-item').index;
          this.pos.currentAbs = item.data('owl-item').indexAbs;
        }

        item.data('owl-item').active = true;
        item.data('owl-item').current = true;
        item.addClass(this.options.activeClass);

        if(!this.options.lazyLoad){
          item.data('owl-item').loaded = true;
        }
        if(this.options.loop && (this.options.lazyLoad || this.options.center)){
          this.updateClonedItemsState(item.data('owl-item').index);
        }
      }
    }
  };

  /**
   * updateClonedItemsState
   * @desc Set current state on sibilings items for lazyLoad and center
   * @since 2.0.0
   */

  Owl.prototype.updateClonedItemsState = function(activeIndex){

    //find cloned center
    var center, $el,i;
    if(this.options.center){
      center = this.dom.$items.eq(this.pos.currentAbs).data('owl-item').index;
    }

    for(i = 0; i<this.num.items; i++){
      $el = this.dom.$items.eq(i);
      if( $el.data('owl-item').index === activeIndex ){
        $el.data('owl-item').current = true;
        if($el.data('owl-item').index === center ){
          $el.addClass(this.options.centerClass);
        }
      }
    }
  };

  /**
   * updateLazyPosition
   * @desc Set current state on sibilings items for lazyLoad and center
   * @since 2.0.0
   */

  Owl.prototype.updateLazyPosition = function(){
    var jumpTo = this.pos.goToLazyContent || 0;

    this.pos.lcMovedBy = Math.abs(this.options.items - this.pos.currentAbs);

    if(this.options.items < this.pos.currentAbs ){
      this.pos.lcCurrent += this.pos.currentAbs - this.options.items;
      this.state.lcDirection = 'right';
    } else if(this.options.items > this.pos.currentAbs ){
      this.pos.lcCurrent -= this.options.items - this.pos.currentAbs;
      this.state.lcDirection = 'left';
    }

    this.pos.lcCurrent = jumpTo !== 0 ? jumpTo : this.pos.lcCurrent;

    if(this.pos.lcCurrent >= this.dom.$content.length){
      this.pos.lcCurrent = this.pos.lcCurrent-this.dom.$content.length;
    } else if(this.pos.lcCurrent < -this.dom.$content.length+1){
      this.pos.lcCurrent = this.pos.lcCurrent+this.dom.$content.length;
    }

    if(this.options.startPosition>0){
      this.pos.lcCurrent = this.options.startPosition;
      this._options.startPosition = this.options.startPosition = 0;
    }

    this.pos.lcCurrentAbs = this.pos.lcCurrent < 0 ? this.pos.lcCurrent+this.dom.$content.length : this.pos.lcCurrent;

  };

  /**
   * updateLazyContent
   * @param [update] - boolean - update call by content manipulations
   * @since 2.0.0
   */

  Owl.prototype.updateLazyContent = function(update){

    if(this.pos.lcCurrent === undefined){
      this.pos.lcCurrent = 0;
      this.pos.current = this.pos.currentAbs = this.options.items;
    }


    if(!update){
      this.updateLazyPosition();
    }
    var i,j,item,contentPos,content,freshItem,freshData;

    this.pos.current = this.pos.currentAbs = this.options.items;
    this.setSpeed(0);

    if(this.state.lcDirection !== false){
      for(i = 0; i<this.pos.lcMovedBy; i++){

        if(this.state.lcDirection === 'right'){
          item = this.dom.$stage.find('.owl-item').eq(0); 
          item.appendTo(this.dom.$stage);
        }
        if(this.state.lcDirection === 'left'){
          item = this.dom.$stage.find('.owl-item').eq(-1);
          item.prependTo(this.dom.$stage);
        }
        item.data('owl-item').active = false;
      }
    }

    // recollect 
    this.dom.$items = this.dom.$stage.find('.owl-item');

    for(j = 0; j<this.num.items; j++){

      // to do
      //this.dom.$items.eq(j).removeClass(this.options.centerClass);

      // get Content 
      contentPos = this.pos.lcCurrent + j - this.options.items;// + this.options.startPosition;

      if(contentPos >= this.dom.$content.length){
        contentPos = contentPos - this.dom.$content.length;
      }
      if(contentPos < -this.dom.$content.length){
        contentPos = contentPos + this.dom.$content.length;
      }

      content = this.dom.$content.eq(contentPos);
      freshItem = this.dom.$items.eq(j);
      freshData = freshItem.data('owl-item');

      if(freshData.active === false || this.pos.goToLazyContent !== 0 || update === true){

        freshItem.empty();
        freshItem.append(content.clone(true,true));
        freshData.active = true;
        freshData.current = true;
        if(!this.options.lazyLoad){
          freshData.loaded = true;
        } else {
          freshData.loaded = false;
        }
      }
    }
    this.animStage(this.pos.items[this.options.items]);
    this.pos.goToLazyContent = 0;

  };

  /**
   * eventsCall
   * @desc Save internal event references and add event based functions like transitionEnd,responsive etc.
   * @since 2.0.0
   */

  Owl.prototype.eventsCall = function(){
    // Save events references 
    this.e._onDragStart = function(e){this.onDragStart(e);    }.bind(this);
    this.e._onDragMove =  function(e){this.onDragMove(e);     }.bind(this);
    this.e._onDragEnd =   function(e){this.onDragEnd(e);      }.bind(this);
    this.e._transitionEnd = function(e){this.transitionEnd(e);    }.bind(this);
    this.e._resizer =   function(){this.responsiveTimer();    }.bind(this);
    this.e._responsiveCall =function(){this.responsive();     }.bind(this);
    this.e._preventClick =  function(e){this.preventClick(e);   }.bind(this);
    this.e._goToHash =    function(){this.goToHash();       }.bind(this);
    this.e._goToPage =    function(e){this.goToPage(e);     }.bind(this);
    this.e._ap =      function(){this.autoplay();       }.bind(this);
    this.e._play =      function(){this.play();         }.bind(this);
    this.e._pause =     function(){this.pause();        }.bind(this);
    this.e._playVideo =   function(e){this.playVideo(e);      }.bind(this);

    this.e._navNext = function(e){
      if($(e.target).hasClass('disabled')){return false;}
      e.preventDefault();
      this.next();        
    }.bind(this);

    this.e._navPrev = function(e){
      if($(e.target).hasClass('disabled')){return false;}
      e.preventDefault();
      this.prev();
    }.bind(this);

  };

  /**
   * responsiveTimer
   * @desc Check Window resize event with 200ms delay / this.options.responsiveRefreshRate
   * @since 2.0.0
   */

  Owl.prototype.responsiveTimer = function(){
    if(this.windowWidth() === this.width.prevWindow){
      return false;
    }
    window.clearInterval(this.e._autoplay);
    window.clearTimeout(this.resizeTimer);
    this.resizeTimer = window.setTimeout(this.e._responsiveCall, this.options.responsiveRefreshRate);
    this.width.prevWindow = this.windowWidth();
  };

  /**
   * internalEvents
   * @desc Checks for touch/mouse drag options and add necessery event handlers.
   * @since 2.0.0
   */

  Owl.prototype.internalEvents = function(){
    var isTouch = isTouchSupport();
    var isTouchIE = isTouchSupportIE();

    if(isTouch && !isTouchIE){
      this.dragType = ['touchstart','touchmove','touchend','touchcancel'];
    } else if(isTouch && isTouchIE){
      this.dragType = ['MSPointerDown','MSPointerMove','MSPointerUp','MSPointerCancel'];
    } else {
      this.dragType = ['mousedown','mousemove','mouseup'];
    }

    if( (isTouch || isTouchIE) && this.options.touchDrag){
      //touch cancel event 
      this.on(document, this.dragType[3], this.e._onDragEnd);

    } else {
      // firefox startdrag fix - addeventlistener doesnt work here :/
      this.dom.$stage.on('dragstart', function() {return false;});

      if(this.options.mouseDrag){
        //disable text select
        this.dom.stage.onselectstart = function(){return false;};
      } else {
        // enable text select
        this.dom.$el.addClass('owl-text-select-on');
      }
    }

    // Video Play Button event delegation
    this.dom.$stage.on(this.dragType[2], '.owl-video-play-icon', this.e._playVideo);

    if(this.options.URLhashListener){
      this.on(window, 'hashchange', this.e._goToHash, false);
    }

    if(this.options.autoplayHoverPause){
      var that = this;
      this.dom.$stage.on('mouseover', this.e._pause );
      this.dom.$stage.on('mouseleave', this.e._ap );
    }

    // Catch transitionEnd event
    if(this.transitionEndVendor){
      this.on(this.dom.stage, this.transitionEndVendor, this.e._transitionEnd, false);
    }

    // Responsive
    if(this.options.responsive !== false){
      this.on(window, 'resize', this.e._resizer, false);
    }

    this.updateEvents();
  };

  /**
   * updateEvents
   * @since 2.0.0
   */

  Owl.prototype.updateEvents = function(){

    if(this.options.touchDrag && (this.dragType[0] === 'touchstart' || this.dragType[0] === 'MSPointerDown')){
      this.on(this.dom.stage, this.dragType[0], this.e._onDragStart,false);
    } else if(this.options.mouseDrag && this.dragType[0] === 'mousedown'){
      this.on(this.dom.stage, this.dragType[0], this.e._onDragStart,false);

    } else {
      this.off(this.dom.stage, this.dragType[0], this.e._onDragStart);
    }
  };

  /**
   * onDragStart
   * @desc touchstart/mousedown event
   * @since 2.0.0
   */

  Owl.prototype.onDragStart = function(event){
    var ev = event.originalEvent || event || window.event;
    // prevent right click
    if (ev.which === 3) { 
      return false;
    }

    if(this.dragType[0] === 'mousedown'){
      this.dom.$stage.addClass('owl-grab');
    }

    this.fireCallback('onTouchStart');
    this.drag.startTime = new Date().getTime();
    this.setSpeed(0);
    this.state.isTouch = true;
    this.state.isScrolling = false;
    this.state.isSwiping = false;
    this.drag.distance = 0;

    // if is 'touchstart'
    var isTouchEvent = ev.type === 'touchstart';
    var pageX = isTouchEvent ? event.targetTouches[0].pageX : (ev.pageX || ev.clientX);
    var pageY = isTouchEvent ? event.targetTouches[0].pageY : (ev.pageY || ev.clientY);

    //get stage position left
    this.drag.offsetX = this.dom.$stage.position().left - this.options.stagePadding;
    this.drag.offsetY = this.dom.$stage.position().top;

    if(this.options.rtl){
      this.drag.offsetX = this.dom.$stage.position().left + this.width.stage - this.width.el + this.options.margin;
    }

    //catch position // ie to fix
    if(this.state.inMotion && this.support3d){
      var animatedPos = this.getTransformProperty();
      this.drag.offsetX = animatedPos;
      this.animStage(animatedPos);
    } else if(this.state.inMotion && !this.support3d ){
      this.state.inMotion = false;
      return false;
    }

    this.drag.startX = pageX - this.drag.offsetX;
    this.drag.startY = pageY - this.drag.offsetY;

    this.drag.start = pageX - this.drag.startX;
    this.drag.targetEl = ev.target || ev.srcElement;
    this.drag.updatedX = this.drag.start;

    // to do/check
    //prevent links and images dragging;
    //this.drag.targetEl.draggable = false;

    this.on(document, this.dragType[1], this.e._onDragMove, false);
    this.on(document, this.dragType[2], this.e._onDragEnd, false);
  };

  /**
   * onDragMove
   * @desc touchmove/mousemove event
   * @since 2.0.0
   */

  Owl.prototype.onDragMove = function(event){
    if (!this.state.isTouch){
      return;
    }

    if (this.state.isScrolling){
      return;
    }

    var neighbourItemWidth=0;
    var ev = event.originalEvent || event || window.event;

    // if is 'touchstart'
    var isTouchEvent = ev.type == 'touchmove';
    var pageX = isTouchEvent ? ev.targetTouches[0].pageX : (ev.pageX || ev.clientX);
    var pageY = isTouchEvent ? ev.targetTouches[0].pageY : (ev.pageY || ev.clientY);

    // Drag Direction 
    this.drag.currentX = pageX - this.drag.startX;
    this.drag.currentY = pageY - this.drag.startY;
    this.drag.distance = this.drag.currentX - this.drag.offsetX;

    // Check move direction 
    if (this.drag.distance < 0) {
      this.state.direction = this.options.rtl ? 'right' : 'left';
    } else if(this.drag.distance > 0){
      this.state.direction = this.options.rtl ? 'left' : 'right';
    }
    // Loop
    if(this.options.loop){
      if(this.op(this.drag.currentX, '>', this.pos.minValue) && this.state.direction === 'right' ){
        this.drag.currentX -= this.pos.loop;
      }else if(this.op(this.drag.currentX, '<', this.pos.maxValue) && this.state.direction === 'left' ){
        this.drag.currentX += this.pos.loop;
      }
    } else {
      // pull
      var minValue = this.options.rtl ? this.pos.maxValue : this.pos.minValue;
      var maxValue = this.options.rtl ? this.pos.minValue : this.pos.maxValue;
      var pull = this.options.pullDrag ? this.drag.distance / 5 : 0;
      this.drag.currentX = Math.max(Math.min(this.drag.currentX, minValue + pull), maxValue + pull);
    }



    // Lock browser if swiping horizontal

    if ((this.drag.distance > 8 || this.drag.distance < -8)) {
      if (ev.preventDefault !== undefined) {
        ev.preventDefault();
      } else {
        ev.returnValue = false;
      }
      this.state.isSwiping = true;
    }

    this.drag.updatedX = this.drag.currentX;

    // Lock Owl if scrolling 
    if ((this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === false) {
       this.state.isScrolling = true;
       this.drag.updatedX = this.drag.start;
    }

    this.animStage(this.drag.updatedX);
  };

  /**
   * onDragEnd 
   * @desc touchend/mouseup event
   * @since 2.0.0
   */

  Owl.prototype.onDragEnd = function(event){
    if (!this.state.isTouch){
      return;
    }
    if(this.dragType[0] === 'mousedown'){
      this.dom.$stage.removeClass('owl-grab');
    }

    this.fireCallback('onTouchEnd');

    //prevent links and images dragging;
    //this.drag.targetEl.draggable = true;

    //remove drag event listeners

    this.state.isTouch = false;
    this.state.isScrolling = false;
    this.state.isSwiping = false;

    //to check
    if(this.drag.distance === 0 && this.state.inMotion !== true){
      this.state.inMotion = false;
      return false;
    }

    // prevent clicks while scrolling

    this.drag.endTime = new Date().getTime();
    var compareTimes = this.drag.endTime - this.drag.startTime;
    var distanceAbs = Math.abs(this.drag.distance);

    //to test
    if(distanceAbs > 3 || compareTimes > 300){
      this.removeClick(this.drag.targetEl);
    }

    var closest = this.closest(this.drag.updatedX);

    this.setSpeed(this.options.dragEndSpeed, false, true);
    this.animStage(this.pos.items[closest]);

    //if pullDrag is off then fire transitionEnd event manually when stick to border
    if(!this.options.pullDrag && this.drag.updatedX === this.pos.items[closest]){
      this.transitionEnd();
    }

    this.drag.distance = 0;

    this.off(document, this.dragType[1], this.e._onDragMove);
    this.off(document, this.dragType[2], this.e._onDragEnd);
  };

  /**
   * removeClick
   * @desc Attach preventClick function to disable link while swipping
   * @since 2.0.0
   * @param [target] - clicked dom element
   */

  Owl.prototype.removeClick = function(target){
    this.drag.targetEl = target;
    $(target).on('click.preventClick', this.e._preventClick);
    // to make sure click is removed:
    window.setTimeout(function(){
      $(target).off('click.preventClick');
    },300);
  };

  /**
   * preventClick
   * @desc Add preventDefault for any link and then remove removeClick event hanlder
   * @since 2.0.0
   */

  Owl.prototype.preventClick = function(ev){
    if(ev.preventDefault) {
      ev.preventDefault();
    }else {
      ev.returnValue = false;
    }
    if(ev.stopPropagation){
      ev.stopPropagation();
    }
    $(ev.target).off('click.preventClick')
  };

  /**
   * getTransformProperty
   * @desc catch stage position while animate (only css3)
   * @since 2.0.0
   */

  Owl.prototype.getTransformProperty = function(){
    var transform = window.getComputedStyle(this.dom.stage, null).getPropertyValue(this.vendorName + 'transform');
    //var transform = this.dom.$stage.css(this.vendorName + 'transform')
    transform = transform.replace(/matrix(3d)?\(|\)/g, '').split(',');
    var matrix3d = transform.length === 16;

    return matrix3d !== true ? transform[4] : transform[12];
  };

  /**
   * closest
   * @desc Get closest item after touchend/mouseup
   * @since 2.0.0
   * @param [x] - curent position in pixels
   * return position in pixels
   */

  Owl.prototype.closest = function(x){
    var newX = 0,
      pull = 30;

    if(!this.options.freeDrag){
      // Check closest item
      for(var i = 0; i< this.num.items; i++){
        if(x > this.pos.items[i]-pull && x < this.pos.items[i]+pull){
          newX = i;
        }else if(this.op(x,'<',this.pos.items[i]) && this.op(x,'>',this.pos.items[i+1 || this.pos.items[i] - this.width.el]) ){
          newX = this.state.direction === 'left' ? i+1 : i;
        }
      }
    }
    //non loop boundries
    if(!this.options.loop){
      if(this.op(x,'>',this.pos.minValue)){
        newX = x = this.pos.min;
      } else if(this.op(x,'<',this.pos.maxValue)){
        newX = x = this.pos.max;
      }
    }

    if(!this.options.freeDrag){
      // set positions
      this.pos.currentAbs = newX;
      this.pos.current = this.dom.$items.eq(newX).data('owl-item').index;
    } else {
      this.updateItemState();
      return x;
    }

    return newX;
  };

  /**
   * animStage
   * @desc animate stage position (both css3/css2) and perform onChange functions/events
   * @since 2.0.0
   * @param [x] - curent position in pixels
   */

  Owl.prototype.animStage = function(pos){

    // if speed is 0 the set inMotion to false
    if(this.speed.current !== 0 && this.pos.currentAbs !== this.pos.min){
      this.fireCallback('onTransitionStart');
      this.state.inMotion = true;
    }

    var posX = this.pos.stage = pos,
      style = this.dom.stage.style;

    if(this.support3d){
      translate = 'translate3d(' + posX + 'px'+',0px, 0px)';
      style[this.transformVendor] = translate;
    } else if(this.state.isTouch){
      style.left = posX+'px';
    } else {
      this.dom.$stage.animate({left: posX},this.speed.css2speed, this.options.fallbackEasing, function(){
        if(this.state.inMotion){
          this.transitionEnd();
        }
      }.bind(this));
    }

    this.onChange();
  };

  /**
   * updatePosition
   * @desc Update current positions
   * @since 2.0.0
   * @param [pos] - number - new position
   */

  Owl.prototype.updatePosition = function(pos){

    // if no items then stop 
    if(this.num.oItems === 0){return false;}
    // to do
    //if(pos > this.num.items){pos = 0;}
    if(pos === undefined){return false;}

    //pos - new current position
    var nextPos = pos;
    this.pos.prev = this.pos.currentAbs;

    if(this.state.revert){
      this.pos.current = this.dom.$items.eq(nextPos).data('owl-item').index;
      this.pos.currentAbs = nextPos;
      return;
    }

    if(!this.options.loop){
      if(this.options.navRewind){
        nextPos = nextPos > this.pos.max ? this.pos.min : (nextPos < 0 ? this.pos.max : nextPos);
      } else {
        nextPos = nextPos > this.pos.max ? this.pos.max : (nextPos <= 0 ? 0 : nextPos);
      }
    } else {
      nextPos = nextPos >= this.num.oItems ? this.num.oItems-1 : nextPos;
    }

    this.pos.current = this.dom.$oItems.eq(nextPos).data('owl-item').index;
    this.pos.currentAbs = this.dom.$oItems.eq(nextPos).data('owl-item').indexAbs;

  };

  /**
   * setSpeed
   * @since 2.0.0
   * @param [speed] - number
   * @param [pos] - number - next position - use this param to calculate smartSpeed
   * @param [drag] - boolean - if drag is true then smart speed is disabled
   * return speed
   */

  Owl.prototype.setSpeed = function(speed,pos,drag) {
    var s = speed,
      nextPos = pos;

    if((s === false && s !== 0 && drag !== true) || s === undefined){

      //Double check this
      // var nextPx = this.pos.items[nextPos];
      // var currPx = this.pos.stage 
      // var diff = Math.abs(nextPx-currPx);
      // var s = diff/1
      // if(s>1000){
      //  s = 1000;
      // }

      var diff = Math.abs(nextPos - this.pos.prev);
      diff = diff === 0 ? 1 : diff;
      if(diff>6){diff = 6;}
      s = diff * this.options.smartSpeed;
    }

    if(s === false && drag === true){
      s = this.options.smartSpeed;
    }

    if(s === 0){s=0;}

    if(this.support3d){
      var style = this.dom.stage.style;
      style.webkitTransitionDuration = style.MsTransitionDuration = style.msTransitionDuration = style.MozTransitionDuration = style.OTransitionDuration = style.transitionDuration = (s / 1000) + 's';
    } else{
      this.speed.css2speed = s;
    }
    this.speed.current = s;
    return s;
  };

  /**
   * jumpTo
   * @since 2.0.0
   * @param [pos] - number - next position - use this param to calculate smartSpeed
   * @param [update] - boolean - if drag is true then smart speed is disabled
   */

  Owl.prototype.jumpTo = function(pos,update){
    if(this.state.lazyContent){
      this.pos.goToLazyContent = pos;
    }
    this.updatePosition(pos);
    this.setSpeed(0);
    this.animStage(this.pos.items[this.pos.currentAbs]);
    if(update !== true){
      this.updateItemState();
    }
  };

  /**
   * goTo
   * @since 2.0.0
   * @param [pos] - number
   * @param [speed] - speed in ms
   * @param [speed] - speed in ms
   */

  Owl.prototype.goTo = function(pos,speed){
    if(this.state.lazyContent && this.state.inMotion){
      return false;
    }

    this.updatePosition(pos);

    if(this.state.animate){speed = 0;}
    this.setSpeed(speed,this.pos.currentAbs);

    if(this.state.animate){this.animate();}
    this.animStage(this.pos.items[this.pos.currentAbs]);

  };

  /**
   * next
   * @since 2.0.0
   */

  Owl.prototype.next = function(optionalSpeed){
    var s = optionalSpeed || this.options.navSpeed;
    if(this.options.loop && !this.state.lazyContent){
      this.goToLoop(this.options.slideBy, s);
    }else{
      this.goTo(this.pos.current + this.options.slideBy, s);
    }
  };

  /**
   * prev
   * @since 2.0.0
   */

  Owl.prototype.prev = function(optionalSpeed){
    var s = optionalSpeed || this.options.navSpeed;
    if(this.options.loop && !this.state.lazyContent){
      this.goToLoop(-this.options.slideBy, s);
    }else{
      this.goTo(this.pos.current-this.options.slideBy, s);
    }
  };

  /**
   * goToLoop
   * @desc Go to given position if loop is enabled - used only internal
   * @since 2.0.0
   * @param [distance] - number -how far to go
   * @param [speed] - number - speed in ms
   */

  Owl.prototype.goToLoop = function(distance,speed){

    var revert = this.pos.currentAbs,
      prevPosition = this.pos.currentAbs,
      newPosition = this.pos.currentAbs + distance,
      direction = prevPosition - newPosition < 0 ? true : false;

    this.state.revert = true;

    if(newPosition < this.options.items && direction === false){

      this.state.bypass = true;
      revert = this.num.items - (this.options.items-prevPosition) - this.options.items;
      this.jumpTo(revert,true);

    } else if(newPosition >= this.num.items - this.options.items && direction === true ){

      this.state.bypass = true;
      revert = prevPosition - this.num.oItems;
      this.jumpTo(revert,true);

    }
    window.clearTimeout(this.e._goToLoop);
    this.e._goToLoop = window.setTimeout(function(){
      this.state.bypass = false;
      this.goTo(revert + distance, speed);
      this.state.revert = false;

    }.bind(this), 30);
  };

  /**
   * initPosition
   * @since 2.0.0
   */

  Owl.prototype.initPosition = function(init){

    if( !this.dom.$oItems || !init || this.state.lazyContent ){return false;}
    var pos = this.options.startPosition;

    if(this.options.startPosition === 'URLHash'){
      pos = this.options.startPosition = this.hashPosition();
    } else if(typeof this.options.startPosition !== Number && !this.options.center){
      this.options.startPosition = 0;
    }
    this.dom.oStage.scrollLeft = 0;
    this.jumpTo(pos,true);
  };

  /**
   * goToHash
   * @since 2.0.0
   */

  Owl.prototype.goToHash = function(){
    var pos = this.hashPosition();
    if(pos === false){
      pos = 0;
    }
    this.dom.oStage.scrollLeft = 0;
    this.goTo(pos,this.options.navSpeed);
  };

  /**
   * hashPosition
   * @desc Find hash in URL then look into items to find contained ID
   * @since 2.0.0
   * return hashPos - number of item
   */

  Owl.prototype.hashPosition = function(){
    var hash = window.location.hash.substring(1),
      hashPos;
    if(hash === ""){return false;}

    for(var i=0;i<this.num.oItems; i++){
      if(hash === this.dom.$oItems.eq(i).data('owl-item').hash){
        hashPos = i;
      }
    }
    return hashPos;
  };

  /**
   * Autoplay
   * @since 2.0.0
   */

  Owl.prototype.autoplay = function(){
    if(this.options.autoplay && !this.state.videoPlay){
      window.clearInterval(this.e._autoplay);
      this.e._autoplay = window.setInterval(this.e._play, this.options.autoplayTimeout);
    } else {
      window.clearInterval(this.e._autoplay);
      this.state.autoplay=false;
    }
  };

  /**
   * play
   * @param [timeout] - Integrer
   * @param [speed] - Integrer
   * @since 2.0.0
   */

  Owl.prototype.play = function(timeout, speed){

    // if tab is inactive - doesnt work in <IE10
    if(document.hidden === true){return false;}

    // overwrite default options (custom options are always priority)
    if(!this.options.autoplay){
      this._options.autoplay = this.options.autoplay = true;
      this._options.autoplayTimeout = this.options.autoplayTimeout = timeout || this.options.autoplayTimeout || 4000;
      this._options.autoplaySpeed = speed || this.options.autoplaySpeed;
    }

    if(this.options.autoplay === false || this.state.isTouch || this.state.isScrolling || this.state.isSwiping || this.state.inMotion){
      window.clearInterval(this.e._autoplay);
      return false;
    }

    if(!this.options.loop && this.pos.current >= this.pos.max){
      window.clearInterval(this.e._autoplay);
      this.goTo(0);
    } else {
      this.next(this.options.autoplaySpeed);
    }
    this.state.autoplay=true;
  };

  /**
   * stop
   * @since 2.0.0
   */

  Owl.prototype.stop = function(){
    this._options.autoplay = this.options.autoplay = false;
    this.state.autoplay = false;
    window.clearInterval(this.e._autoplay);
  };

  Owl.prototype.pause = function(){
    window.clearInterval(this.e._autoplay);
  };

  /**
   * transitionEnd
   * @desc event used by css3 animation end and $.animate callback like transitionEnd,responsive etc.
   * @since 2.0.0
   */

  Owl.prototype.transitionEnd = function(event){

    // if css2 animation then event object is undefined 
    if(event !== undefined){
      event.stopPropagation();

      // Catch only owl-stage transitionEnd event
      var eventTarget = event.target || event.srcElement || event.originalTarget;
      if(eventTarget !== this.dom.stage){ 
        return false;
      }
    }

    this.state.inMotion = false;
    this.updateItemState();
    this.autoplay();
    this.fireCallback('onTransitionEnd');
  };

  /**
   * isElWidthChanged
   * @desc Check if element width has changed
   * @since 2.0.0
   */

  Owl.prototype.isElWidthChanged = function(){
    var newElWidth =  this.dom.$el.width() - this.options.stagePadding,//to check
      prevElWidth =   this.width.el + this.options.margin;
    return newElWidth !== prevElWidth;
  };

  /**
   * windowWidth
   * @desc Get Window/responsiveBaseElement width
   * @since 2.0.0
   */

  Owl.prototype.windowWidth = function() {
    if(this.options.responsiveBaseElement !== window){
      this.width.window =  $(this.options.responsiveBaseElement).width();
    } else if (window.innerWidth){
      this.width.window = window.innerWidth;
    } else if (document.documentElement && document.documentElement.clientWidth){
      this.width.window = document.documentElement.clientWidth;
    }
    return this.width.window;
  };

  /**
   * Controls
   * @desc Calls controls container, navigation and dots creator
   * @since 2.0.0
   */

  Owl.prototype.controls = function(){
    var cc = document.createElement('div');
    cc.className = this.options.controlsClass;
    this.dom.$el.append(cc);
    this.dom.$cc = $(cc);
  };

  /**
   * updateControls 
   * @since 2.0.0
   */

  Owl.prototype.updateControls = function(){

    if(this.dom.$cc === null && (this.options.nav || this.options.dots)){
      if(!this.options.navContainer || !this.options.dotsContainer){
        this.controls();
      }
    }

    if(this.dom.$nav === null && this.options.nav){
      this.createNavigation();
    }

    if(this.dom.$page === null && this.options.dots){
      this.createDots();
    }

    if(this.dom.$nav !== null){
      if(this.options.nav){
        this.dom.$nav.show();
        this.updateNavigation();
      } else {
        this.dom.$nav.hide();
      }
    }

    if(this.dom.$page !== null){
      if(this.options.dots){
        this.dom.$page.show();
        this.updateDots();
      } else {
        this.dom.$page.hide();
      }
    }
  };

  /**
   * createNavigation
   * @since 2.0.0
   */

  Owl.prototype.createNavigation = function(){

    var cc = this.options.navContainer ? $(this.options.navContainer).get(0) : this.dom.$cc.get(0);

    // Create nav container
    var nav = document.createElement('div');
    nav.className = this.options.navContainerClass;
    cc.appendChild(nav);

    // Create left and right buttons
    var navPrev = document.createElement('div'),
      navNext = document.createElement('div');

    navPrev.className = this.options.navClass[0];
    navNext.className = this.options.navClass[1];

    nav.appendChild(navPrev);
    nav.appendChild(navNext);

    this.dom.$nav = $(nav);
    this.dom.$navPrev = $(navPrev).html(this.options.navText[0]);
    this.dom.$navNext = $(navNext).html(this.options.navText[1]);

    // add events to do
    //this.on(navPrev, this.dragType[2], this.e._navPrev, false);
    //this.on(navNext, this.dragType[2], this.e._navNext, false);

    //FF fix?
    this.dom.$nav.on(this.dragType[2], '.'+this.options.navClass[0], this.e._navPrev);
    this.dom.$nav.on(this.dragType[2], '.'+this.options.navClass[1], this.e._navNext);
  };

  /**
   * createNavigation
   * @since 2.0.0
   * @param [cc] - dom element - Controls Container
   */

  Owl.prototype.createDots = function(){

    var cc = this.options.dotsContainer ? $(this.options.dotsContainer).get(0) : this.dom.$cc.get(0);

    // Create dots container
    var page = document.createElement('div');
    page.className = this.options.dotsClass;
    cc.appendChild(page);

    // save reference
    this.dom.$page = $(page);

    // add events
    //this.on(page, this.dragType[2], this.e._goToPage, false);

    // FF fix? To test!
    var that = this;
    this.dom.$page.on(this.dragType[2], '.'+this.options.dotClass, goToPage);

    function goToPage(e){
      e.preventDefault();
      var page = $(this).data('page');
      that.goTo(page,that.options.dotsSpeed);
    }
    // build dots
    this.rebuildDots();
  };

  /**
   * rebuildDots
   * @since 2.0.0
   */

  Owl.prototype.rebuildDots = function(){
    if(this.dom.$page === null){return false;}
    var each, dot, span, counter = 0, last = 0, i, page=0, roundPages = 0;

    each = this.options.dotsEach || this.options.items;

    // display full dots if center
    if(this.options.center || this.options.dotData){
      each = 1;
    }

    // clear dots
    this.dom.$page.html('');

    for(i = 0; i < this.num.nav.length; i++){

      if(counter >= each || counter === 0){

        dot = document.createElement('div');
        dot.className = this.options.dotClass;
        span = document.createElement('span');
        dot.appendChild(span);
        var $dot = $(dot);

        if(this.options.dotData){
          $dot.html(this.dom.$oItems.eq(i).data('owl-item').dot);
        }

        $dot.data('page',page);
        $dot.data('goToPage',roundPages);

        this.dom.$page.append(dot);

        counter = 0;
        roundPages++;
      }

      this.dom.$oItems.eq(i).data('owl-item').page = roundPages-1;

      //add merged items
      counter += this.num.nav[i];
      page++;
    }
    // find rest of dots
    if(!this.options.loop && !this.options.center){
      for(var j = this.num.nav.length-1; j >= 0; j--){
        last += this.num.nav[j];
        this.dom.$oItems.eq(j).data('owl-item').page = roundPages-1;
        if(last >= each){
          break;
        }
      }
    }

    this.num.allPages = roundPages-1;
  };

  /**
   * updateDots
   * @since 2.0.0
   */

  Owl.prototype.updateDots = function(){
    var dots = this.dom.$page.children();
    var itemIndex = this.dom.$oItems.eq(this.pos.current).data('owl-item').page;

    for(var i = 0; i < dots.length; i++){
      var dotPage = dots.eq(i).data('goToPage');

      if(dotPage===itemIndex){
        this.pos.currentPage = i;
        dots.eq(i).addClass('active');
      }else{
        dots.eq(i).removeClass('active');
      }
    }
  };

  /**
   * updateNavigation
   * @since 2.0.0
   */

  Owl.prototype.updateNavigation = function(){

    var isNav = this.options.nav;

    this.dom.$navNext.toggleClass('disabled',!isNav);
    this.dom.$navPrev.toggleClass('disabled',!isNav);

    if(!this.options.loop && isNav && !this.options.navRewind){

      if(this.pos.current <= 0){
        this.dom.$navPrev.addClass('disabled');
      } 
      if(this.pos.current >= this.pos.max){
        this.dom.$navNext.addClass('disabled');
      }
    }
  };

  Owl.prototype.insertContent = function(content){
    this.dom.$stage.empty();
    this.fetchContent(content);
    this.refresh();
  };

  /**
   * addItem - Add an item
   * @since 2.0.0
   * @param [content] - dom element / string '<div>content</div>'
   * @param [pos] - number - position
   */

  Owl.prototype.addItem = function(content,pos){
    pos = pos || 0;

    if(this.state.lazyContent){
      this.dom.$content = this.dom.$content.add($(content));
      this.updateItemState(true);
    } else {
      // wrap content
      var item = this.fillItem(content);
      // if carousel is empty then append item
      if(this.dom.$oItems.length === 0){
        this.dom.$stage.append(item);
      } else {
        // append item
        var it = this.dom.$oItems.eq(pos);
        if(pos !== -1){it.before(item);} else {it.after(item);}
      }
      // update and calculate carousel
      this.refresh();
    }

  };

  /**
   * removeItem - Remove an Item
   * @since 2.0.0
   * @param [pos] - number - position
   */

  Owl.prototype.removeItem = function(pos){
    if(this.state.lazyContent){
      this.dom.$content.splice(pos,1);
      this.updateItemState(true);
    } else {
      this.dom.$oItems.eq(pos).remove();
      this.refresh();
    }
  };

  /**
   * addCustomEvents
   * @desc Add custom events by jQuery .on method
   * @since 2.0.0
   */

  Owl.prototype.addCustomEvents = function(){

    this.e.next = function(e,s){this.next(s);     }.bind(this);
    this.e.prev = function(e,s){this.prev(s);     }.bind(this);
    this.e.goTo = function(e,p,s){this.goTo(p,s);   }.bind(this);
    this.e.jumpTo = function(e,p){this.jumpTo(p);   }.bind(this);
    this.e.addItem = function(e,c,p){this.addItem(c,p); }.bind(this);
    this.e.removeItem = function(e,p){this.removeItem(p);}.bind(this);
    this.e.refresh = function(e){this.refresh();    }.bind(this);
    this.e.destroy = function(e){this.destroy();    }.bind(this);
    this.e.autoHeight = function(e){this.autoHeight(true);}.bind(this);
    this.e.stop = function(){this.stop();       }.bind(this);
    this.e.play = function(e,t,s){this.play(t,s);   }.bind(this);
    this.e.insertContent = function(e,d){this.insertContent(d); }.bind(this);

    this.dom.$el.on('next.owl',this.e.next);
    this.dom.$el.on('prev.owl',this.e.prev);
    this.dom.$el.on('goTo.owl',this.e.goTo);
    this.dom.$el.on('jumpTo.owl',this.e.jumpTo);
    this.dom.$el.on('addItem.owl',this.e.addItem);
    this.dom.$el.on('removeItem.owl',this.e.removeItem);
    this.dom.$el.on('destroy.owl',this.e.destroy);
    this.dom.$el.on('refresh.owl',this.e.refresh);
    this.dom.$el.on('autoHeight.owl',this.e.autoHeight);
    this.dom.$el.on('play.owl',this.e.play);
    this.dom.$el.on('stop.owl',this.e.stop);
    this.dom.$el.on('stopVideo.owl',this.e.stop);
    this.dom.$el.on('insertContent.owl',this.e.insertContent);

  };

  /**
   * on
   * @desc On method for adding internal events
   * @since 2.0.0
   */

  Owl.prototype.on = function (element, event, listener, capture) {

    if (element.addEventListener) {
      element.addEventListener(event, listener, capture);
    }
    else if (element.attachEvent) {
      element.attachEvent('on' + event, listener);
    }
  };

  /**
   * off
   * @desc Off method for removing internal events
   * @since 2.0.0
   */

  Owl.prototype.off = function (element, event, listener, capture) {
    if (element.removeEventListener) {
      element.removeEventListener(event, listener, capture);
    }
    else if (element.detachEvent) {
      element.detachEvent('on' + event, listener);
    }
  };

  /**
   * fireCallback
   * @since 2.0.0
   * @param event - string - event name
   * @param data - object - additional options - to do
   */

  Owl.prototype.fireCallback = function(event, data){
    if(!this.options.callbacks){return;}

    if (typeof this.options[event] === 'function') {
      this.options[event].apply(this,[this.dom.el,this.info,event]);
    }

    if(this.dom.el.dispatchEvent){

      // dispatch event
      var evt = document.createEvent('CustomEvent');

      //evt.initEvent(event, false, true );
      evt.initCustomEvent(event, true, true, data);
      return this.dom.el.dispatchEvent(evt);

    } else if (!this.dom.el.dispatchEvent){

      //  There is no clean solution for custom events name in <=IE8 
      //  But if you know better way, please let me know :) 
      return this.dom.$el.trigger(event);
    }
  };

  /**
   * watchVisibility
   * @desc check if el is visible - handy if Owl is inside hidden content (tabs etc.)
   * @since 2.0.0
   */

  Owl.prototype.watchVisibility = function(){

    // test on zepto
    if(!isElVisible(this.dom.el)) {
      this.dom.$el.addClass('owl-hidden');
      window.clearInterval(this.e._checkVisibile);
      this.e._checkVisibile = window.setInterval(checkVisible.bind(this),500);
    }

    function isElVisible(el) {
        return el.offsetWidth > 0 && el.offsetHeight > 0;
    }

    function checkVisible(){
      if (isElVisible(this.dom.el)) {
        this.dom.$el.removeClass('owl-hidden');
        this.refresh();
        window.clearInterval(this.e._checkVisibile);
      }
    }
  };

  /**
   * onChange
   * @since 2.0.0
   */

  Owl.prototype.onChange = function(){

    if(!this.state.isTouch && !this.state.bypass && !this.state.responsive ){

      if (this.options.nav || this.options.dots) {
        this.updateControls();
      }
      this.autoHeight();

      this.fireCallback('onChangeState');
    }

    if(!this.state.isTouch && !this.state.bypass){

      if(!this.state.lazyContent){
        this.updateActiveItems();
      }

      // set Status to do
      this.storeInfo();

      // stopVideo 
      if(this.state.videoPlay){
        this.stopVideo();
      }
    }
  };

  /**
   * storeInfo
   * store basic information about current states
   * @since 2.0.0
   */

  Owl.prototype.storeInfo = function(){
    var currentPosition = this.state.lazyContent ? this.pos.lcCurrentAbs || 0 : this.pos.current;
    var allItems = this.state.lazyContent ? this.dom.$content.length-1 : this.num.oItems;

    this.info = { 
      items:      this.options.items,
      allItems:   allItems,
      currentPosition:currentPosition,
      currentPage:  this.pos.currentPage,
      allPages:   this.num.allPages,
      autoplay:   this.state.autoplay,
      windowWidth:  this.width.window,
      elWidth:    this.width.el,
      breakpoint:   this.num.breakpoint
    };

    if (typeof this.options.info === 'function') {
      this.options.info.apply(this,[this.info,this.dom.el]);
    }
  };

  /**
   * autoHeight
   * @since 2.0.0
   */

  Owl.prototype.autoHeight = function(callback){
     if(this.options.autoHeight !== true && callback !== true){
      return false;
    }
    if(!this.dom.$oStage.hasClass(this.options.autoHeightClass)){
      this.dom.$oStage.addClass(this.options.autoHeightClass);
    }

    var loaded = this.dom.$items.eq(this.pos.currentAbs);
    var stage = this.dom.$oStage;
    var iterations = 0;

    var isLoaded = window.setInterval(function() {
      iterations += 1;
      if(loaded.data('owl-item').loaded){
        stage.height(loaded.height() + 'px');
        clearInterval(isLoaded);
      } else if(iterations === 500){
        clearInterval(isLoaded);
      }
    }, 100);
  };

  /**
   * preloadAutoWidthImages
   * @desc still to test
   * @since 2.0.0
   */

  Owl.prototype.preloadAutoWidthImages = function(imgs){
    var loaded = 0;
    var that = this;
    imgs.each(function(i,el){
      var $el = $(el);
      var img = new Image();

      img.onload = function(){
        loaded++;
        $el.attr('src',img.src);
        $el.css('opacity',1);
        if(loaded >= imgs.length){
          that.state.imagesLoaded = true;
          that.init();
        }
      }

      img.src = $el.attr('src') ||  $el.attr('data-src') || $el.attr('data-src-retina');;
    })
  };

  /**
   * lazyLoad
   * @desc lazyLoad images
   * @since 2.0.0
   */

  Owl.prototype.lazyLoad = function(){
    var attr = isRetina() ? 'data-src-retina' : 'data-src';
    var src, img,i;

    for(i = 0; i < this.num.items; i++){
      var $item = this.dom.$items.eq(i);

      if( $item.data('owl-item').current === true && $item.data('owl-item').loaded === false){
        img = $item.find('.owl-lazy');
        src = img.attr(attr);
        src = src || img.attr('data-src');
        if(src){
          img.css('opacity','0');
          this.preload(img,$item);
        }
      }
    }
  };

  /**
   * preload
   * @since 2.0.0
   */

   Owl.prototype.preload = function(images,$item){
    var that = this; // fix this later

    images.each(function(i,el){
      var $el = $(el);
      var img = new Image();
      var srcType = isRetina() ? $el.attr('data-src-retina') : $el.attr('data-src');
      var srcType = srcType || $el.attr('data-src');

      img.onload = function(){

        $item.data('owl-item').loaded = true;
        if($el.is('img')){
          $el.attr('src',img.src);
        }else{
          $el.css('background-image','url(' + img.src + ')');
        }

        $el.css('opacity',1);
        that.fireCallback('onLazyLoaded');
      };
      img.src = srcType;
    });
   };

  /**
   * animate
   * @since 2.0.0
   */

   Owl.prototype.animate = function(){

    var prevItem = this.dom.$items.eq(this.pos.prev),
      prevPos = Math.abs(prevItem.data('owl-item').width) * this.pos.prev,
      currentItem = this.dom.$items.eq(this.pos.currentAbs),
      currentPos = Math.abs(currentItem.data('owl-item').width) * this.pos.currentAbs;

    if(this.pos.currentAbs === this.pos.prev){
      return false;
    }

    var pos = currentPos - prevPos;
    var tIn = this.options.animateIn;
    var tOut = this.options.animateOut;
    var that = this;

    removeStyles = function(){
      $(this).css({
                "left" : ""
            })
            .removeClass('animated owl-animated-out owl-animated-in')
            .removeClass(tIn)
            .removeClass(tOut);

            that.transitionEnd();
        };

    if(tOut){
      prevItem
      .css({
        "left" : pos + "px"
      })
      .addClass('animated owl-animated-out '+tOut)
      .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', removeStyles);
    }

    if(tIn){
      currentItem
      .addClass('animated owl-animated-in '+tIn)
      .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', removeStyles);
    }
   };

  /**
   * destroy
   * @desc Remove Owl structure and events :(
   * @since 2.0.0
   */

  Owl.prototype.destroy = function(){

    window.clearInterval(this.e._autoplay);

    if(this.dom.$el.hasClass(this.options.themeClass)){
      this.dom.$el.removeClass(this.options.themeClass);
    }

    if(this.options.responsive !== false){
      this.off(window, 'resize', this.e._resizer);
    }

    if(this.transitionEndVendor){
      this.off(this.dom.stage, this.transitionEndVendor, this.e._transitionEnd);
    }

    if(this.options.mouseDrag || this.options.touchDrag){
      this.off(this.dom.stage, this.dragType[0], this.e._onDragStart);
      if(this.options.mouseDrag){
        this.off(document, this.dragType[3], this.e._onDragStart);
      }
      if(this.options.mouseDrag){
        this.dom.$stage.off('dragstart', function() {return false;});
        this.dom.stage.onselectstart = function(){};
      }
    }

    if(this.options.URLhashListener){
      this.off(window, 'hashchange', this.e._goToHash);
    }

    this.dom.$el.off('next.owl',this.e.next);
    this.dom.$el.off('prev.owl',this.e.prev);
    this.dom.$el.off('goTo.owl',this.e.goTo);
    this.dom.$el.off('jumpTo.owl',this.e.jumpTo);
    this.dom.$el.off('addItem.owl',this.e.addItem);
    this.dom.$el.off('removeItem.owl',this.e.removeItem);
    this.dom.$el.off('refresh.owl',this.e.refresh);
    this.dom.$el.off('autoHeight.owl',this.e.autoHeight);
    this.dom.$el.off('play.owl',this.e.play);
    this.dom.$el.off('stop.owl',this.e.stop);
    this.dom.$el.off('stopVideo.owl',this.e.stop);
    this.dom.$stage.off('click',this.e._playVideo);

    if(this.dom.$cc !== null){
      this.dom.$cc.remove();
    }
    if(this.dom.$cItems !== null){
      this.dom.$cItems.remove();
    }
    this.e = null;
    this.dom.$el.data('owlCarousel',null);
    delete this.dom.el.owlCarousel;

    this.dom.$stage.unwrap();
    this.dom.$items.unwrap();
    this.dom.$items.contents().unwrap();
    this.dom = null;
  };

  /**
   * Opertators 
   * @desc Used to calculate RTL
   * @param [a] - Number - left side
   * @param [o] - String - operator 
   * @param [b] - Number - right side
   * @since 2.0.0
   */

  Owl.prototype.op = function(a,o,b){
    var rtl = this.options.rtl;
    switch(o) {
      case '<':
        return rtl ? a > b : a < b;
      case '>':
        return rtl ? a < b : a > b;
      case '>=':
        return rtl ? a <= b : a >= b;
      case '<=':
        return rtl ? a >= b : a <= b;
      default:
        break;
    }
  };

  /**
   * Opertators 
   * @desc Used to calculate RTL
   * @since 2.0.0
   */

  Owl.prototype.browserSupport = function(){
    this.support3d = isPerspective();

    if(this.support3d){
      this.transformVendor = isTransform();

      // take transitionend event name by detecting transition
      var endVendors = ['transitionend','webkitTransitionEnd','transitionend','oTransitionEnd'];
      this.transitionEndVendor = endVendors[isTransition()];

      // take vendor name from transform name
      this.vendorName = this.transformVendor.replace(/Transform/i,'');
      this.vendorName = this.vendorName !== '' ? '-'+this.vendorName.toLowerCase()+'-' : '';
    }

    this.state.orientation = window.orientation;
  };

  // Pivate methods 

  // CSS detection;
  function isStyleSupported(array){
    var p,s,fake = document.createElement('div'),list = array;
    for(p in list){
      s = list[p]; 
      if(typeof fake.style[s] !== 'undefined'){
        fake = null;
        return [s,p];
      }
    }
    return [false];
  }

  function isTransition(){
    return isStyleSupported(['transition','WebkitTransition','MozTransition','OTransition'])[1];
  }
 
  function isTransform() {
    return isStyleSupported(['transform','WebkitTransform','MozTransform','OTransform','msTransform'])[0];
  }

  function isPerspective(){
    return isStyleSupported(['perspective','webkitPerspective','MozPerspective','OPerspective','MsPerspective'])[0];
  }

  function isTouchSupport(){
    return 'ontouchstart' in window || !!(navigator.msMaxTouchPoints);
  }

  function isTouchSupportIE(){
    return window.navigator.msPointerEnabled;
  }

  function isRetina(){
    return window.devicePixelRatio > 1;
  }

  $.fn.owlCarousel = function ( options ) {
    return this.each(function () {
      if (!$(this).data('owlCarousel')) {
        $(this).data( 'owlCarousel',
        new Owl( this, options ));
      }
    });

  };

})( window.Zepto || window.jQuery, window,  document );

//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/bind
//The bind() method creates a new function that, when called, has its this keyword set to the provided value, with a given sequence of arguments preceding any provided when the new function is called.

if (!Function.prototype.bind) {
  Function.prototype.bind = function (oThis) {
	if (typeof this !== 'function') {
		// closest thing possible to the ECMAScript 5 internal IsCallable function
		throw new TypeError('Function.prototype.bind - what is trying to be bound is not callable');
	}

	var aArgs = Array.prototype.slice.call(arguments, 1), 
		fToBind = this, 
		fNOP = function () {},
		fBound = function () {
			return fToBind.apply(this instanceof fNOP && oThis ? this : oThis, aArgs.concat(Array.prototype.slice.call(arguments)));
		};
	fNOP.prototype = this.prototype;
	fBound.prototype = new fNOP();
	return fBound;
  };
}
// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-shiv-mq-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function D(a){j.cssText=a}function E(a,b){return D(n.join(a+";")+(b||""))}function F(a,b){return typeof a===b}function G(a,b){return!!~(""+a).indexOf(b)}function H(a,b){for(var d in a){var e=a[d];if(!G(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function I(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:F(f,"function")?f.bind(d||b):f}return!1}function J(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+p.join(d+" ")+d).split(" ");return F(b,"string")||F(b,"undefined")?H(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),I(e,b,c))}function K(){e.input=function(c){for(var d=0,e=c.length;d<e;d++)u[c[d]]=c[d]in k;return u.list&&(u.list=!!b.createElement("datalist")&&!!a.HTMLDataListElement),u}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)k.setAttribute("type",f=a[d]),e=k.type!=="text",e&&(k.value=l,k.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&k.style.WebkitAppearance!==c?(g.appendChild(k),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(k,null).WebkitAppearance!=="textfield"&&k.offsetHeight!==0,g.removeChild(k)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=k.checkValidity&&k.checkValidity()===!1:e=k.value!=l)),t[a[d]]=!!e;return t}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k=b.createElement("input"),l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={svg:"http://www.w3.org/2000/svg"},s={},t={},u={},v=[],w=v.slice,x,y=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},z=function(b){var c=a.matchMedia||a.msMatchMedia;if(c)return c(b).matches;var d;return y("@media "+b+" { #"+h+" { position: absolute; } }",function(b){d=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle)["position"]=="absolute"}),d},A=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;return f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=F(e[d],"function"),F(e[d],"undefined")||(e[d]=c),e.removeAttribute(d))),e=null,f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),B={}.hasOwnProperty,C;!F(B,"undefined")&&!F(B.call,"undefined")?C=function(a,b){return B.call(a,b)}:C=function(a,b){return b in a&&F(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=w.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(w.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(w.call(arguments)))};return e}),s.flexbox=function(){return J("flexWrap")},s.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},s.canvastext=function(){return!!e.canvas&&!!F(b.createElement("canvas").getContext("2d").fillText,"function")},s.webgl=function(){return!!a.WebGLRenderingContext},s.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:y(["@media (",n.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},s.geolocation=function(){return"geolocation"in navigator},s.postmessage=function(){return!!a.postMessage},s.websqldatabase=function(){return!!a.openDatabase},s.indexedDB=function(){return!!J("indexedDB",a)},s.hashchange=function(){return A("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},s.history=function(){return!!a.history&&!!history.pushState},s.draganddrop=function(){var a=b.createElement("div");return"draggable"in a||"ondragstart"in a&&"ondrop"in a},s.websockets=function(){return"WebSocket"in a||"MozWebSocket"in a},s.rgba=function(){return D("background-color:rgba(150,255,150,.5)"),G(j.backgroundColor,"rgba")},s.hsla=function(){return D("background-color:hsla(120,40%,100%,.5)"),G(j.backgroundColor,"rgba")||G(j.backgroundColor,"hsla")},s.multiplebgs=function(){return D("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(j.background)},s.backgroundsize=function(){return J("backgroundSize")},s.borderimage=function(){return J("borderImage")},s.borderradius=function(){return J("borderRadius")},s.boxshadow=function(){return J("boxShadow")},s.textshadow=function(){return b.createElement("div").style.textShadow===""},s.opacity=function(){return E("opacity:.55"),/^0.55$/.test(j.opacity)},s.cssanimations=function(){return J("animationName")},s.csscolumns=function(){return J("columnCount")},s.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";return D((a+"-webkit- ".split(" ").join(b+a)+n.join(c+a)).slice(0,-a.length)),G(j.backgroundImage,"gradient")},s.cssreflections=function(){return J("boxReflect")},s.csstransforms=function(){return!!J("transform")},s.csstransforms3d=function(){var a=!!J("perspective");return a&&"webkitPerspective"in g.style&&y("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},s.csstransitions=function(){return J("transition")},s.fontface=function(){var a;return y('@font-face {font-family:"font";src:url("https://")}',function(c,d){var e=b.getElementById("smodernizr"),f=e.sheet||e.styleSheet,g=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"";a=/src/i.test(g)&&g.indexOf(d.split(" ")[0])===0}),a},s.generatedcontent=function(){var a;return y(["#",h,"{font:0/0 a}#",h,':after{content:"',l,'";visibility:hidden;font:3px/1 a}'].join(""),function(b){a=b.offsetHeight>=3}),a},s.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),c.h264=a.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"")}catch(d){}return c},s.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),c.mp3=a.canPlayType("audio/mpeg;").replace(/^no$/,""),c.wav=a.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),c.m4a=(a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")).replace(/^no$/,"")}catch(d){}return c},s.localstorage=function(){try{return localStorage.setItem(h,h),localStorage.removeItem(h),!0}catch(a){return!1}},s.sessionstorage=function(){try{return sessionStorage.setItem(h,h),sessionStorage.removeItem(h),!0}catch(a){return!1}},s.webworkers=function(){return!!a.Worker},s.applicationcache=function(){return!!a.applicationCache},s.svg=function(){return!!b.createElementNS&&!!b.createElementNS(r.svg,"svg").createSVGRect},s.inlinesvg=function(){var a=b.createElement("div");return a.innerHTML="<svg/>",(a.firstChild&&a.firstChild.namespaceURI)==r.svg},s.smil=function(){return!!b.createElementNS&&/SVGAnimate/.test(m.call(b.createElementNS(r.svg,"animate")))},s.svgclippaths=function(){return!!b.createElementNS&&/SVGClipPath/.test(m.call(b.createElementNS(r.svg,"clipPath")))};for(var L in s)C(s,L)&&(x=L.toLowerCase(),e[x]=s[L](),v.push((e[x]?"":"no-")+x));return e.input||K(),e.addTest=function(a,b){if(typeof a=="object")for(var d in a)C(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},D(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.mq=z,e.hasEvent=A,e.testProp=function(a){return H([a])},e.testAllProps=J,e.testStyles=y,e.prefixed=function(a,b,c){return b?J(a,b,c):J(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+v.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};



// jQuery Easing plugin
jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});
jQuery(document).ready(function ($) {
"use strict";

jQuery('.mom_button').hover(
		function(){
		var $hoverbg = jQuery(this).attr('data-hoverbg');
		var $texthcolor = jQuery(this).attr('data-texthover');
		var $borderhover = jQuery(this).attr('data-borderhover');
		jQuery(this).css("background-color",$hoverbg);
		jQuery(this).css("color",$texthcolor);
		jQuery(this).css("border-color",$borderhover);
	},function() {
		var $bgcolor = jQuery(this).attr('data-bg');
		var $textColor = jQuery(this).attr('data-text');
		var $bordercolor = jQuery(this).attr('data-border');
		if($bgcolor!==undefined){
			jQuery(this).css("background-color",$bgcolor);
		}else {
			jQuery(this).css("background-color",'');
		}
		if($textColor!==undefined){
			jQuery(this).css("color",$textColor);
		}else {
			jQuery(this).css("color",'');
		}
		if($bordercolor !== undefined){
			jQuery(this).css("border-color",$bordercolor);
		}else {
			jQuery(this).css("border-color",'');
		}
	});
// Tab Current icon
if ($(".main_tabs ul.tabs").length) { $("ul.tabs").momtabs("div.tabs-content-wrap > .tab-content", { effect: 'fade'}); }

if (('ul.mom_tabs li a i').length) {
    $('.mom_tabs_container').each(function () {
	var $this = $(this);
	var current_tab = $this.find('.mom_tabs li a.current i[class^="momizat-icon"]');
	current_tab.css('color', current_tab.attr('data-current'));
	$this.find('.mom_tabs li a').click(function () {
	if ($(this).hasClass('current')) {
	var $current = $(this).find('[class^="momizat-icon"]').attr('data-current');
	var $orig = $(this).find('[class^="momizat-icon"]').attr('data-color');
	
	$this.find('.mom_tabs li a i[class^="momizat-icon"]').css('color',$orig);
	$('[class^="momizat-icon"]', this).css('color', $current);
	} 
	});
    });
}
// Accordion Current icon
if (('h2.acc_title i').length) {
    $('.accordion').each(function () {
	var $this = $(this);
	var current_acc = $this.find('h2.active i[class^="momizat-icon"]');
	current_acc.css('color', current_acc.attr('data-current'));
	$this.find('h2.acc_title').click(function () {
	if ($(this).hasClass('active')) {
	var $current = $(this).find('[class^="momizat-icon"]').attr('data-current');
	var $orig = $(this).find('[class^="momizat-icon"]').attr('data-color');
	
	$this.find('h2.acc_title i[class^="momizat-icon"]').css('color',$orig);
	$('[class^="momizat-icon"]', this).css('color', $current);
	} 
	});
    });
}
//Pricing table
    $('.pricing-table .plan .plan-content ul li').wrapInner('<span></span>');
    $('.pricing-table .pricetable-featured').next().children('.plan_container').css('border-left', 'none');

//Accordion
$('.accordion').each( function() {
    var acc = $(this);
    if (acc.hasClass('toggle_acc')) {
	acc.find('li:first .acc_title').addClass('active');
	acc.find('.acc_toggle_open').addClass('active');
	acc.find('.acc_toggle_open').next('.acc_content').show();
	acc.find('.acc_toggle_close').removeClass('active');
	acc.find('.acc_toggle_close').next('.acc_content').hide();
	acc.find('.acc_title').click(function() {
	$(this).toggleClass('active');
	$(this).next('.acc_content').slideToggle();
    });
    } else {
    acc.find('li:first .acc_title').addClass('active');
    acc.find('.acc_title').click(function() {
	if(!$(this).hasClass('active')) {
	acc.find('.acc_title').removeClass('active');
	acc.find('.acc_content').slideUp();
	$(this).addClass('active');
	$(this).next('.acc_content').slideDown();
	}
    });
    }
}); 
$(".accordion").each(function () {
    $(this).find('.acc_title').each(function(i) {
	$(this).find('.acch_numbers').text(i+1);
    });
});
//graph
$('.animator.animated, .iconb_wrap.animated').each( function() {
    var $this = $(this);
    var animation = $(this).attr('data-animate');

$this.bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
  if (isInView) {
	    $(this).addClass(animation);
	    if(animation.indexOf('fade') === -1)
	    {
	      $(this).css('opacity', '1');
	    }
    if (visiblePartY == 'top') {
      // top part of element is visible
    } else if (visiblePartY == 'bottom') {
      // bottom part of element is visible
    } else {
      // whole part of element is visible
    }
  } else {
    // element has gone out of viewport
  }
});

});
if ($('.progress_outer').length) {
    $('.progress_outer').each( function() {
	var $this = $(this);
    $this.bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
      if (isInView) {
		$(this).find('.parograss_inner').show();
		$(this).find('.parograss_inner').addClass('ani-bar');
	if (visiblePartY == 'top') {
	  // top part of element is visible
	} else if (visiblePartY == 'bottom') {
	  // bottom part of element is visible
	} else {
	  // whole part of element is visible
	}
      } else {
	// element has gone out of viewport
      }
    });
    
    });
}

//toggles
jQuery("h4.toggle_title").click(function () {
	$(this).next(".toggle_content").slideToggle();
	$(this).toggleClass("active_toggle");
	$(this).parent().toggleClass("toggle_active");
});

$("h4.toggle_min").click(function () {
	$(this).next(".toggle_content_min").slideToggle();
	$(this).toggleClass("active_toggle_min");
});
//Icon Colors in hover
jQuery('.mom_iconbox').hover(
	function(){
	var icon = $(this).find('[class^="momizat-icon"]');
	var icon_wrap = $(this).find('.iconb_wrap');
	
	var $hover = icon.attr('data-hover');
	var $bghover = icon_wrap.attr('data-hover');
	var $bdhover = icon_wrap.attr('data-border_hover');

	icon.css("color",$hover);
	icon_wrap.css("background",$bghover);
	icon_wrap.css("border-color",$bdhover);
},function() {
	var icon = $(this).find('[class^="momizat-icon"]');
	var icon_wrap = $(this).find('.iconb_wrap');

	var $color = icon.attr('data-color');
	var $origcolor = icon.css('color');
	var $bgcolor = icon_wrap.attr('data-color');
	var $origbg = icon_wrap.css('background-color');
	var $bdcolor = icon_wrap.attr('data-border_color');
	var $origbd = icon_wrap.css('border-color');
	if($color!==undefined){
		icon.css("color",$color);
	}else {
		icon.css("color",$origcolor);
	}
	if($bgcolor!==undefined){
		icon_wrap.css("background",$bgcolor);
	}else {
		icon_wrap.css("background",$origbg);
	}
	if($bdcolor!==undefined){
		icon_wrap.css("border-color",$bdcolor);
	}else {
	}
});
//icona
jQuery('.mom_icona').hover(
	function(){
	var icon = $(this).find('[class^="momizat-icon"]');
	var icon_wrap = $(this);
	var $hover = icon.attr('data-hover');
	var $bghover = icon_wrap.attr('data-hover');
	var $bdhover = icon_wrap.attr('data-border_hover');
	icon.css("color",$hover);
	icon_wrap.css("background",$bghover);
	icon_wrap.css("border-color",$bdhover);
},function() {
	var icon = $(this).find('[class^="momizat-icon"]');
	var icon_wrap = $(this);
	var $color = icon.attr('data-color');
	var $origcolor = icon.css('color');
	var $bgcolor = icon_wrap.attr('data-color');
	var $origbg = icon_wrap.css('background-color');
	var $bdcolor = icon_wrap.attr('data-border_color');
	var $origbd = icon_wrap.css('border-color');
	if($color!==undefined){
		icon.css("color",$color);
	}else {
		icon.css("color",$origcolor);
	}
	if($bgcolor!==undefined){
		icon_wrap.css("background",$bgcolor);
	}else {
		icon_wrap.css("background",$origbg);
	}
	if($bdcolor!==undefined){
		icon_wrap.css("border-color",$bdcolor);
	}else {
	}
});
//teaser boxes
	var tb_cols = 2;
	var tb_2_i = 0;
	$(".teaser_box2").each(function(){
		tb_2_i++;
		tb_cols = 2;
		if (tb_2_i % tb_cols === 0) {$(this).addClass("last");}
	});
	var tb_3_i = 0;
	$(".teaser_box3").each(function(){
		tb_3_i++;
		tb_cols = 3;
		if (tb_3_i % tb_cols === 0) {$(this).addClass("last");}
	});

	var tb_4_i = 0;
	$(".teaser_box4").each(function(){
		tb_4_i++;
		tb_cols = 4;
		if (tb_4_i % tb_cols === 0) {$(this).addClass("last");}
	});

	var tb_5_i = 0;
	$(".teaser_box5").each(function(){
		tb_5_i++;
		tb_cols = 5;
		if (tb_5_i % tb_cols === 0) {$(this).addClass("last");}
	});
//team members
	var tm_cols = 2;
	var tm_2_i = 0;
	$(".team_member2").each(function(){
		tm_2_i++;
		tm_cols = 2;
		if (tm_2_i % tm_cols === 0) {$(this).addClass("last");}
	});
	var tm_3_i = 0;
	$(".team_member3").each(function(){
		tm_3_i++;
		tm_cols = 3;
		if (tm_3_i % tm_cols === 0) {$(this).addClass("last");}
	});
	var tm_4_i = 0;
	$(".team_member4").each(function(){
		tm_4_i++;
		tm_cols = 4;
		if (tm_4_i % tm_cols === 0) {$(this).addClass("last");}
	});
	var tm_5_i = 0;
	$(".team_member5").each(function(){
		tm_5_i++;
		tm_cols = 5;
		if (tm_5_i % tm_cols === 0) {$(this).addClass("last");}
	});
$('.team_member').each( function () {
    var socials = $(this).find('.member_social ul li');
    var width = 100/socials.length;
    socials.css('width',width+'%');
});	
//Mom Columns
	var mom_cols = 2;
	var mc_2_i = 0;
	$(".mom_columns2").each(function(){
		mc_2_i++;
		mom_cols = 2;
		if (mc_2_i % mom_cols === 0) {$(this).addClass("last");}
	});
	var mc_3_i = 0;
	$(".mom_columns3").each(function(){
		mc_3_i++;
		mom_cols = 3;
		if (mc_3_i % mom_cols === 0) {$(this).addClass("last");}
	});

	var mc_4_i = 0;
	$(".mom_columns4").each(function(){
		mc_4_i++;
		mom_cols = 4;
		if (mc_4_i % mom_cols === 0) {$(this).addClass("last");}
	});

	var mc_5_i = 0;
	$(".mom_columns5").each(function(){
		mc_5_i++;
		mom_cols = 5;
		if (mc_5_i % mom_cols === 0) {$(this).addClass("last");}
	});
//prallax bg
if ($('.mom_custom_background').length) {
    $('.mom_custom_background').each(function() {
	var $this = $(this);
	$(window).scroll(function () {
		var speed = 8.0;
		$this.css({backgroundPosition:(-window.pageXOffset / speed) + "px " + (-window.pageYOffset / speed) + "px"});
		//document.body.style.backgroundPosition = (-window.pageXOffset / speed) + "px " + (-window.pageYOffset / speed) + "px";
	});
    });
}
//callitout
if ($('.mom_callout').length) {
    $('.mom_callout').each( function () {
	if ($(this).find('.cobtr').length) {
	var btwidth = parseFloat($(this).find('.cobtr').css('width'))+30;
	var btheight = parseFloat($(this).find('.cobtr').css('height'))/2;
	$(this).find('.callout_content').css('margin-right',btwidth+'px');
	$(this).find('.cobtr').css('margin-top', '-'+btheight+'px');
	}
	if ($(this).find('.cobtl').length) {
	var btwidth = parseFloat($(this).find('.cobtl').css('width'))+30;
	var btheight = parseFloat($(this).find('.cobtl').css('height'))/2;
	$(this).find('.callout_content').css('margin-left',btwidth+'px');
	$(this).find('.cobtl').css('margin-top', '-'+btheight+'px');
	}
    });
}
	jQuery('.mom_button').hover(
		function(){
		var $hoverbg = jQuery(this).attr('data-hoverbg');
		var $texthcolor = jQuery(this).attr('data-texthover');
		var $borderhover = jQuery(this).attr('data-borderhover');
		jQuery(this).css("background-color",$hoverbg);
		jQuery(this).css("color",$texthcolor);
		jQuery(this).css("border-color",$borderhover);
	},function() {
		var $bgcolor = jQuery(this).attr('data-bg');
		var $textColor = jQuery(this).attr('data-text');
		var $bordercolor = jQuery(this).attr('data-border');
		if($bgcolor!==undefined){
			jQuery(this).css("background-color",$bgcolor);
		}else {
			jQuery(this).css("background-color",'');
		}
		if($textColor!==undefined){
			jQuery(this).css("color",$textColor);
		}else {
			jQuery(this).css("color",'');
		}
		if($bordercolor !== undefined){
			jQuery(this).css("border-color",$bordercolor);
		}else {
			jQuery(this).css("border-color",'');
		}
	});

$(window).resize(function() {
  if ($(window).width() < 940) {
	$('.video_wrap').fitVids();
  } 
});

  if ($(window).width() < 940) {
	$('.video_wrap').fitVids();
  } 
}); //end
// Place any jQuery/helper plugins in here.
/*!
 * jQuery Tools v1.2.7 - The missing UI library for the Web
 * 
 * tabs/tabs.js
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/
 * 
 */
(function(a) {
    a.tools = a.tools || {
        version: "v1.2.7"
    }, a.tools.momtabs = {
        conf: {
            momtabs: "a",
            current: "current",
            onBeforeClick: null,
            onClick: null,
            effect: "default",
            initialEffect: !1,
            initialIndex: 0,
            event: "click",
            rotate: !1,
            slideUpSpeed: 400,
            slideDownSpeed: 400,
            history: !1
        },
        addEffect: function(a, c) {
            b[a] = c
        }
    };
    var b = {
        "default": function(a, b) {
            this.getPanes().hide().eq(a).show(), b.call()
        },
        fade: function(a, b) {
            var c = this.getConf(),
                d = c.fadeOutSpeed,
                e = this.getPanes();
            d ? e.fadeOut(d) : e.hide(), e.eq(a).fadeIn(c.fadeInSpeed, b)
        },
        slide: function(a, b) {
            var c = this.getConf();
            this.getPanes().slideUp(c.slideUpSpeed), this.getPanes().eq(a).slideDown(c.slideDownSpeed, b)
        },
        ajax: function(a, b) {
            this.getPanes().eq(0).load(this.getmomtabs().eq(a).attr("href"), b)
        }
    },
        c, d;
    a.tools.momtabs.addEffect("horizontal", function(b, e) {
        if (!c) {
            var f = this.getPanes().eq(b),
                g = this.getCurrentPane();
            d || (d = this.getPanes().eq(0).width()), c = !0, f.show(), g.animate({
                width: 0
            }, {
                step: function(a) {
                    f.css("width", d - a)
                },
                complete: function() {
                    a(this).hide(), e.call(), c = !1
                }
            }), g.length || (e.call(), c = !1)
        }
    });
    function e(c, d, e) {
        var f = this,
            g = c.add(this),
            h = c.find(e.momtabs),
            i = d.jquery ? d : c.children(d),
            j;
        h.length || (h = c.children()), i.length || (i = c.parent().find(d)), i.length || (i = a(d)), a.extend(this, {
            click: function(d, i) {
                var k = h.eq(d),
                    l = !c.data("momtabs");
                typeof d == "string" && d.replace("#", "") && (k = h.filter("[href*=\"" + d.replace("#", "") + "\"]"), d = Math.max(h.index(k), 0));
                if (e.rotate) {
                    var m = h.length - 1;
                    if (d < 0) return f.click(m, i);
                    if (d > m) return f.click(0, i)
                }
                if (!k.length) {
                    if (j >= 0) return f;
                    d = e.initialIndex, k = h.eq(d)
                }
                if (d === j) return f;
                i = i || a.Event(), i.type = "onBeforeClick", g.trigger(i, [d]);
                if (!i.isDefaultPrevented()) {
                    var n = l ? e.initialEffect && e.effect || "default" : e.effect;
                    b[n].call(f, d, function() {
                        j = d, i.type = "onClick", g.trigger(i, [d])
                    }), h.removeClass(e.current), k.addClass(e.current);
                    return f
                }
            },
            getConf: function() {
                return e
            },
            getmomtabs: function() {
                return h
            },
            getPanes: function() {
                return i
            },
            getCurrentPane: function() {
                return i.eq(j)
            },
            getCurrentTab: function() {
                return h.eq(j)
            },
            getIndex: function() {
                return j
            },
            next: function() {
                return f.click(j + 1)
            },
            prev: function() {
                return f.click(j - 1)
            },
            destroy: function() {
                h.off(e.event).removeClass(e.current), i.find("a[href^=\"#\"]").off("click.T");
                return f
            }
        }), a.each("onBeforeClick,onClick".split(","), function(b, c) {
            a.isFunction(e[c]) && a(f).on(c, e[c]), f[c] = function(b) {
                b && a(f).on(c, b);
                return f
            }
        }), e.history && a.fn.history && (a.tools.history.init(h), e.event = "history"), h.each(function(b) {
            a(this).on(e.event, function(a) {
                f.click(b, a);
                return a.preventDefault()
            })
        }), i.find("a[href^=\"#\"]").on("click.T", function(b) {
            f.click(a(this).attr("href"), b)
        }), location.hash && e.momtabs == "a" && c.find("[href=\"" + location.hash + "\"]").length ? f.click(location.hash) : (e.initialIndex === 0 || e.initialIndex > 0) && f.click(e.initialIndex)
    }
    a.fn.momtabs = function(b, c) {
        var d = this.data("momtabs");
        d && (d.destroy(), this.removeData("momtabs")), a.isFunction(c) && (c = {
            onBeforeClick: c
        }), c = a.extend({}, a.tools.momtabs.conf, c), this.each(function() {
            d = new e(a(this), b, c), a(this).data("momtabs", d)
        });
        return c.api ? d : this
    }
})(jQuery);

/*! Magnific Popup - v0.9.9 - 2014-09-06
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2014 Dmitry Semenov; */
(function(e){var t,n,i,o,r,a,s,l="Close",c="BeforeClose",d="AfterClose",u="BeforeAppend",p="MarkupParse",f="Open",m="Change",g="mfp",h="."+g,v="mfp-ready",C="mfp-removing",y="mfp-prevent-close",w=function(){},b=!!window.jQuery,I=e(window),x=function(e,n){t.ev.on(g+e+h,n)},k=function(t,n,i,o){var r=document.createElement("div");return r.className="mfp-"+t,i&&(r.innerHTML=i),o?n&&n.appendChild(r):(r=e(r),n&&r.appendTo(n)),r},T=function(n,i){t.ev.triggerHandler(g+n,i),t.st.callbacks&&(n=n.charAt(0).toLowerCase()+n.slice(1),t.st.callbacks[n]&&t.st.callbacks[n].apply(t,e.isArray(i)?i:[i]))},E=function(n){return n===s&&t.currTemplate.closeBtn||(t.currTemplate.closeBtn=e(t.st.closeMarkup.replace("%title%",t.st.tClose)),s=n),t.currTemplate.closeBtn},_=function(){e.magnificPopup.instance||(t=new w,t.init(),e.magnificPopup.instance=t)},S=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};w.prototype={constructor:w,init:function(){var n=navigator.appVersion;t.isIE7=-1!==n.indexOf("MSIE 7."),t.isIE8=-1!==n.indexOf("MSIE 8."),t.isLowIE=t.isIE7||t.isIE8,t.isAndroid=/android/gi.test(n),t.isIOS=/iphone|ipad|ipod/gi.test(n),t.supportsTransition=S(),t.probablyMobile=t.isAndroid||t.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),o=e(document),t.popupsCache={}},open:function(n){i||(i=e(document.body));var r;if(n.isObj===!1){t.items=n.items.toArray(),t.index=0;var s,l=n.items;for(r=0;l.length>r;r++)if(s=l[r],s.parsed&&(s=s.el[0]),s===n.el[0]){t.index=r;break}}else t.items=e.isArray(n.items)?n.items:[n.items],t.index=n.index||0;if(t.isOpen)return t.updateItemHTML(),void 0;t.types=[],a="",t.ev=n.mainEl&&n.mainEl.length?n.mainEl.eq(0):o,n.key?(t.popupsCache[n.key]||(t.popupsCache[n.key]={}),t.currTemplate=t.popupsCache[n.key]):t.currTemplate={},t.st=e.extend(!0,{},e.magnificPopup.defaults,n),t.fixedContentPos="auto"===t.st.fixedContentPos?!t.probablyMobile:t.st.fixedContentPos,t.st.modal&&(t.st.closeOnContentClick=!1,t.st.closeOnBgClick=!1,t.st.showCloseBtn=!1,t.st.enableEscapeKey=!1),t.bgOverlay||(t.bgOverlay=k("bg").on("click"+h,function(){t.close()}),t.wrap=k("wrap").attr("tabindex",-1).on("click"+h,function(e){t._checkIfClose(e.target)&&t.close()}),t.container=k("container",t.wrap)),t.contentContainer=k("content"),t.st.preloader&&(t.preloader=k("preloader",t.container,t.st.tLoading));var c=e.magnificPopup.modules;for(r=0;c.length>r;r++){var d=c[r];d=d.charAt(0).toUpperCase()+d.slice(1),t["init"+d].call(t)}T("BeforeOpen"),t.st.showCloseBtn&&(t.st.closeBtnInside?(x(p,function(e,t,n,i){n.close_replaceWith=E(i.type)}),a+=" mfp-close-btn-in"):t.wrap.append(E())),t.st.alignTop&&(a+=" mfp-align-top"),t.fixedContentPos?t.wrap.css({overflow:t.st.overflowY,overflowX:"hidden",overflowY:t.st.overflowY}):t.wrap.css({top:I.scrollTop(),position:"absolute"}),(t.st.fixedBgPos===!1||"auto"===t.st.fixedBgPos&&!t.fixedContentPos)&&t.bgOverlay.css({height:o.height(),position:"absolute"}),t.st.enableEscapeKey&&o.on("keyup"+h,function(e){27===e.keyCode&&t.close()}),I.on("resize"+h,function(){t.updateSize()}),t.st.closeOnContentClick||(a+=" mfp-auto-cursor"),a&&t.wrap.addClass(a);var u=t.wH=I.height(),m={};if(t.fixedContentPos&&t._hasScrollBar(u)){var g=t._getScrollbarSize();g&&(m.marginRight=g)}t.fixedContentPos&&(t.isIE7?e("body, html").css("overflow","hidden"):m.overflow="hidden");var C=t.st.mainClass;return t.isIE7&&(C+=" mfp-ie7"),C&&t._addClassToMFP(C),t.updateItemHTML(),T("BuildControls"),e("html").css(m),t.bgOverlay.add(t.wrap).prependTo(t.st.prependTo||i),t._lastFocusedEl=document.activeElement,setTimeout(function(){t.content?(t._addClassToMFP(v),t._setFocus()):t.bgOverlay.addClass(v),o.on("focusin"+h,t._onFocusIn)},16),t.isOpen=!0,t.updateSize(u),T(f),n},close:function(){t.isOpen&&(T(c),t.isOpen=!1,t.st.removalDelay&&!t.isLowIE&&t.supportsTransition?(t._addClassToMFP(C),setTimeout(function(){t._close()},t.st.removalDelay)):t._close())},_close:function(){T(l);var n=C+" "+v+" ";if(t.bgOverlay.detach(),t.wrap.detach(),t.container.empty(),t.st.mainClass&&(n+=t.st.mainClass+" "),t._removeClassFromMFP(n),t.fixedContentPos){var i={marginRight:""};t.isIE7?e("body, html").css("overflow",""):i.overflow="",e("html").css(i)}o.off("keyup"+h+" focusin"+h),t.ev.off(h),t.wrap.attr("class","mfp-wrap").removeAttr("style"),t.bgOverlay.attr("class","mfp-bg"),t.container.attr("class","mfp-container"),!t.st.showCloseBtn||t.st.closeBtnInside&&t.currTemplate[t.currItem.type]!==!0||t.currTemplate.closeBtn&&t.currTemplate.closeBtn.detach(),t._lastFocusedEl&&e(t._lastFocusedEl).focus(),t.currItem=null,t.content=null,t.currTemplate=null,t.prevHeight=0,T(d)},updateSize:function(e){if(t.isIOS){var n=document.documentElement.clientWidth/window.innerWidth,i=window.innerHeight*n;t.wrap.css("height",i),t.wH=i}else t.wH=e||I.height();t.fixedContentPos||t.wrap.css("height",t.wH),T("Resize")},updateItemHTML:function(){var n=t.items[t.index];t.contentContainer.detach(),t.content&&t.content.detach(),n.parsed||(n=t.parseEl(t.index));var i=n.type;if(T("BeforeChange",[t.currItem?t.currItem.type:"",i]),t.currItem=n,!t.currTemplate[i]){var o=t.st[i]?t.st[i].markup:!1;T("FirstMarkupParse",o),t.currTemplate[i]=o?e(o):!0}r&&r!==n.type&&t.container.removeClass("mfp-"+r+"-holder");var a=t["get"+i.charAt(0).toUpperCase()+i.slice(1)](n,t.currTemplate[i]);t.appendContent(a,i),n.preloaded=!0,T(m,n),r=n.type,t.container.prepend(t.contentContainer),T("AfterChange")},appendContent:function(e,n){t.content=e,e?t.st.showCloseBtn&&t.st.closeBtnInside&&t.currTemplate[n]===!0?t.content.find(".mfp-close").length||t.content.append(E()):t.content=e:t.content="",T(u),t.container.addClass("mfp-"+n+"-holder"),t.contentContainer.append(t.content)},parseEl:function(n){var i,o=t.items[n];if(o.tagName?o={el:e(o)}:(i=o.type,o={data:o,src:o.src}),o.el){for(var r=t.types,a=0;r.length>a;a++)if(o.el.hasClass("mfp-"+r[a])){i=r[a];break}o.src=o.el.attr("data-mfp-src"),o.src||(o.src=o.el.attr("href"))}return o.type=i||t.st.type||"inline",o.index=n,o.parsed=!0,t.items[n]=o,T("ElementParse",o),t.items[n]},addGroup:function(e,n){var i=function(i){i.mfpEl=this,t._openClick(i,e,n)};n||(n={});var o="click.magnificPopup";n.mainEl=e,n.items?(n.isObj=!0,e.off(o).on(o,i)):(n.isObj=!1,n.delegate?e.off(o).on(o,n.delegate,i):(n.items=e,e.off(o).on(o,i)))},_openClick:function(n,i,o){var r=void 0!==o.midClick?o.midClick:e.magnificPopup.defaults.midClick;if(r||2!==n.which&&!n.ctrlKey&&!n.metaKey){var a=void 0!==o.disableOn?o.disableOn:e.magnificPopup.defaults.disableOn;if(a)if(e.isFunction(a)){if(!a.call(t))return!0}else if(a>I.width())return!0;n.type&&(n.preventDefault(),t.isOpen&&n.stopPropagation()),o.el=e(n.mfpEl),o.delegate&&(o.items=i.find(o.delegate)),t.open(o)}},updateStatus:function(e,i){if(t.preloader){n!==e&&t.container.removeClass("mfp-s-"+n),i||"loading"!==e||(i=t.st.tLoading);var o={status:e,text:i};T("UpdateStatus",o),e=o.status,i=o.text,t.preloader.html(i),t.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),t.container.addClass("mfp-s-"+e),n=e}},_checkIfClose:function(n){if(!e(n).hasClass(y)){var i=t.st.closeOnContentClick,o=t.st.closeOnBgClick;if(i&&o)return!0;if(!t.content||e(n).hasClass("mfp-close")||t.preloader&&n===t.preloader[0])return!0;if(n===t.content[0]||e.contains(t.content[0],n)){if(i)return!0}else if(o&&e.contains(document,n))return!0;return!1}},_addClassToMFP:function(e){t.bgOverlay.addClass(e),t.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),t.wrap.removeClass(e)},_hasScrollBar:function(e){return(t.isIE7?o.height():document.body.scrollHeight)>(e||I.height())},_setFocus:function(){(t.st.focus?t.content.find(t.st.focus).eq(0):t.wrap).focus()},_onFocusIn:function(n){return n.target===t.wrap[0]||e.contains(t.wrap[0],n.target)?void 0:(t._setFocus(),!1)},_parseMarkup:function(t,n,i){var o;i.data&&(n=e.extend(i.data,n)),T(p,[t,n,i]),e.each(n,function(e,n){if(void 0===n||n===!1)return!0;if(o=e.split("_"),o.length>1){var i=t.find(h+"-"+o[0]);if(i.length>0){var r=o[1];"replaceWith"===r?i[0]!==n[0]&&i.replaceWith(n):"img"===r?i.is("img")?i.attr("src",n):i.replaceWith('<img src="'+n+'" class="'+i.attr("class")+'" />'):i.attr(o[1],n)}}else t.find(h+"-"+e).html(n)})},_getScrollbarSize:function(){if(void 0===t.scrollbarSize){var e=document.createElement("div");e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),t.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return t.scrollbarSize}},e.magnificPopup={instance:null,proto:w.prototype,modules:[],open:function(t,n){return _(),t=t?e.extend(!0,{},t):{},t.isObj=!0,t.index=n||0,this.instance.open(t)},close:function(){return e.magnificPopup.instance&&e.magnificPopup.instance.close()},registerModule:function(t,n){n.options&&(e.magnificPopup.defaults[t]=n.options),e.extend(this.proto,n.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(n){_();var i=e(this);if("string"==typeof n)if("open"===n){var o,r=b?i.data("magnificPopup"):i[0].magnificPopup,a=parseInt(arguments[1],10)||0;r.items?o=r.items[a]:(o=i,r.delegate&&(o=o.find(r.delegate)),o=o.eq(a)),t._openClick({mfpEl:o},i,r)}else t.isOpen&&t[n].apply(t,Array.prototype.slice.call(arguments,1));else n=e.extend(!0,{},n),b?i.data("magnificPopup",n):i[0].magnificPopup=n,t.addGroup(i,n);return i};var P,O,z,M="inline",B=function(){z&&(O.after(z.addClass(P)).detach(),z=null)};e.magnificPopup.registerModule(M,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){t.types.push(M),x(l+"."+M,function(){B()})},getInline:function(n,i){if(B(),n.src){var o=t.st.inline,r=e(n.src);if(r.length){var a=r[0].parentNode;a&&a.tagName&&(O||(P=o.hiddenClass,O=k(P),P="mfp-"+P),z=r.after(O).detach().removeClass(P)),t.updateStatus("ready")}else t.updateStatus("error",o.tNotFound),r=e("<div>");return n.inlineElement=r,r}return t.updateStatus("ready"),t._parseMarkup(i,{},n),i}}});var F,H="ajax",L=function(){F&&i.removeClass(F)},A=function(){L(),t.req&&t.req.abort()};e.magnificPopup.registerModule(H,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){t.types.push(H),F=t.st.ajax.cursor,x(l+"."+H,A),x("BeforeChange."+H,A)},getAjax:function(n){F&&i.addClass(F),t.updateStatus("loading");var o=e.extend({url:n.src,success:function(i,o,r){var a={data:i,xhr:r};T("ParseAjax",a),t.appendContent(e(a.data),H),n.finished=!0,L(),t._setFocus(),setTimeout(function(){t.wrap.addClass(v)},16),t.updateStatus("ready"),T("AjaxContentAdded")},error:function(){L(),n.finished=n.loadError=!0,t.updateStatus("error",t.st.ajax.tError.replace("%url%",n.src))}},t.st.ajax.settings);return t.req=e.ajax(o),""}}});var j,N=function(n){if(n.data&&void 0!==n.data.title)return n.data.title;var i=t.st.image.titleSrc;if(i){if(e.isFunction(i))return i.call(t,n);if(n.el)return n.el.attr(i)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=t.st.image,n=".image";t.types.push("image"),x(f+n,function(){"image"===t.currItem.type&&e.cursor&&i.addClass(e.cursor)}),x(l+n,function(){e.cursor&&i.removeClass(e.cursor),I.off("resize"+h)}),x("Resize"+n,t.resizeImage),t.isLowIE&&x("AfterChange",t.resizeImage)},resizeImage:function(){var e=t.currItem;if(e&&e.img&&t.st.image.verticalFit){var n=0;t.isLowIE&&(n=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",t.wH-n)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,j&&clearInterval(j),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(t.content&&t.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var n=0,i=e.img[0],o=function(r){j&&clearInterval(j),j=setInterval(function(){return i.naturalWidth>0?(t._onImageHasSize(e),void 0):(n>200&&clearInterval(j),n++,3===n?o(10):40===n?o(50):100===n&&o(500),void 0)},r)};o(1)},getImage:function(n,i){var o=0,r=function(){n&&(n.img[0].complete?(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("ready")),n.hasSize=!0,n.loaded=!0,T("ImageLoadComplete")):(o++,200>o?setTimeout(r,100):a()))},a=function(){n&&(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("error",s.tError.replace("%url%",n.src))),n.hasSize=!0,n.loaded=!0,n.loadError=!0)},s=t.st.image,l=i.find(".mfp-img");if(l.length){var c=document.createElement("img");c.className="mfp-img",n.img=e(c).on("load.mfploader",r).on("error.mfploader",a),c.src=n.src,l.is("img")&&(n.img=n.img.clone()),c=n.img[0],c.naturalWidth>0?n.hasSize=!0:c.width||(n.hasSize=!1)}return t._parseMarkup(i,{title:N(n),img_replaceWith:n.img},n),t.resizeImage(),n.hasSize?(j&&clearInterval(j),n.loadError?(i.addClass("mfp-loading"),t.updateStatus("error",s.tError.replace("%url%",n.src))):(i.removeClass("mfp-loading"),t.updateStatus("ready")),i):(t.updateStatus("loading"),n.loading=!0,n.hasSize||(n.imgHidden=!0,i.addClass("mfp-loading"),t.findImageSize(n)),i)}}});var W,R=function(){return void 0===W&&(W=void 0!==document.createElement("p").style.MozTransform),W};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,n=t.st.zoom,i=".zoom";if(n.enabled&&t.supportsTransition){var o,r,a=n.duration,s=function(e){var t=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),i="all "+n.duration/1e3+"s "+n.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},r="transition";return o["-webkit-"+r]=o["-moz-"+r]=o["-o-"+r]=o[r]=i,t.css(o),t},d=function(){t.content.css("visibility","visible")};x("BuildControls"+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.content.css("visibility","hidden"),e=t._getItemToZoom(),!e)return d(),void 0;r=s(e),r.css(t._getOffset()),t.wrap.append(r),o=setTimeout(function(){r.css(t._getOffset(!0)),o=setTimeout(function(){d(),setTimeout(function(){r.remove(),e=r=null,T("ZoomAnimationEnded")},16)},a)},16)}}),x(c+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.st.removalDelay=a,!e){if(e=t._getItemToZoom(),!e)return;r=s(e)}r.css(t._getOffset(!0)),t.wrap.append(r),t.content.css("visibility","hidden"),setTimeout(function(){r.css(t._getOffset())},16)}}),x(l+i,function(){t._allowZoom()&&(d(),r&&r.remove(),e=null)})}},_allowZoom:function(){return"image"===t.currItem.type},_getItemToZoom:function(){return t.currItem.hasSize?t.currItem.img:!1},_getOffset:function(n){var i;i=n?t.currItem.img:t.st.zoom.opener(t.currItem.el||t.currItem);var o=i.offset(),r=parseInt(i.css("padding-top"),10),a=parseInt(i.css("padding-bottom"),10);o.top-=e(window).scrollTop()-r;var s={width:i.width(),height:(b?i.innerHeight():i[0].offsetHeight)-a-r};return R()?s["-moz-transform"]=s.transform="translate("+o.left+"px,"+o.top+"px)":(s.left=o.left,s.top=o.top),s}}});var Z="iframe",q="//about:blank",D=function(e){if(t.currTemplate[Z]){var n=t.currTemplate[Z].find("iframe");n.length&&(e||(n[0].src=q),t.isIE8&&n.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(Z,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){t.types.push(Z),x("BeforeChange",function(e,t,n){t!==n&&(t===Z?D():n===Z&&D(!0))}),x(l+"."+Z,function(){D()})},getIframe:function(n,i){var o=n.src,r=t.st.iframe;e.each(r.patterns,function(){return o.indexOf(this.index)>-1?(this.id&&(o="string"==typeof this.id?o.substr(o.lastIndexOf(this.id)+this.id.length,o.length):this.id.call(this,o)),o=this.src.replace("%id%",o),!1):void 0});var a={};return r.srcAction&&(a[r.srcAction]=o),t._parseMarkup(i,a,n),t.updateStatus("ready"),i}}});var K=function(e){var n=t.items.length;return e>n-1?e-n:0>e?n+e:e},Y=function(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var n=t.st.gallery,i=".mfp-gallery",r=Boolean(e.fn.mfpFastClick);return t.direction=!0,n&&n.enabled?(a+=" mfp-gallery",x(f+i,function(){n.navigateByImgClick&&t.wrap.on("click"+i,".mfp-img",function(){return t.items.length>1?(t.next(),!1):void 0}),o.on("keydown"+i,function(e){37===e.keyCode?t.prev():39===e.keyCode&&t.next()})}),x("UpdateStatus"+i,function(e,n){n.text&&(n.text=Y(n.text,t.currItem.index,t.items.length))}),x(p+i,function(e,i,o,r){var a=t.items.length;o.counter=a>1?Y(n.tCounter,r.index,a):""}),x("BuildControls"+i,function(){if(t.items.length>1&&n.arrows&&!t.arrowLeft){var i=n.arrowMarkup,o=t.arrowLeft=e(i.replace(/%title%/gi,n.tPrev).replace(/%dir%/gi,"left")).addClass(y),a=t.arrowRight=e(i.replace(/%title%/gi,n.tNext).replace(/%dir%/gi,"right")).addClass(y),s=r?"mfpFastClick":"click";o[s](function(){t.prev()}),a[s](function(){t.next()}),t.isIE7&&(k("b",o[0],!1,!0),k("a",o[0],!1,!0),k("b",a[0],!1,!0),k("a",a[0],!1,!0)),t.container.append(o.add(a))}}),x(m+i,function(){t._preloadTimeout&&clearTimeout(t._preloadTimeout),t._preloadTimeout=setTimeout(function(){t.preloadNearbyImages(),t._preloadTimeout=null},16)}),x(l+i,function(){o.off(i),t.wrap.off("click"+i),t.arrowLeft&&r&&t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(),t.arrowRight=t.arrowLeft=null}),void 0):!1},next:function(){t.direction=!0,t.index=K(t.index+1),t.updateItemHTML()},prev:function(){t.direction=!1,t.index=K(t.index-1),t.updateItemHTML()},goTo:function(e){t.direction=e>=t.index,t.index=e,t.updateItemHTML()},preloadNearbyImages:function(){var e,n=t.st.gallery.preload,i=Math.min(n[0],t.items.length),o=Math.min(n[1],t.items.length);for(e=1;(t.direction?o:i)>=e;e++)t._preloadItem(t.index+e);for(e=1;(t.direction?i:o)>=e;e++)t._preloadItem(t.index-e)},_preloadItem:function(n){if(n=K(n),!t.items[n].preloaded){var i=t.items[n];i.parsed||(i=t.parseEl(n)),T("LazyLoad",i),"image"===i.type&&(i.img=e('<img class="mfp-img" />').on("load.mfploader",function(){i.hasSize=!0}).on("error.mfploader",function(){i.hasSize=!0,i.loadError=!0,T("LazyLoadError",i)}).attr("src",i.src)),i.preloaded=!0}}}});var U="retina";e.magnificPopup.registerModule(U,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=t.st.retina,n=e.ratio;n=isNaN(n)?n():n,n>1&&(x("ImageHasSize."+U,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/n,width:"100%"})}),x("ElementParse."+U,function(t,i){i.src=e.replaceSrc(i,n)}))}}}}),function(){var t=1e3,n="ontouchstart"in window,i=function(){I.off("touchmove"+r+" touchend"+r)},o="mfpFastClick",r="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var a,s=e(this);if(n){var l,c,d,u,p,f;s.on("touchstart"+r,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,I.on("touchmove"+r,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,i())}).on("touchend"+r,function(e){i(),u||f>1||(a=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){a=!1},t),o())})})}s.on("click"+r,function(){a||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+r+" click"+r),n&&I.off("touchmove"+r+" touchend"+r)}}(),_()})(window.jQuery||window.Zepto);
/*
 Sticky-kit v1.1.1 | WTFPL | Leaf Corcoran 2014 | http://leafo.net
*/
(function(){var k,e;k=this.jQuery||window.jQuery;e=k(window);k.fn.stick_in_parent=function(d){var v,y,n,p,h,C,s,G,q,H;null==d&&(d={});s=d.sticky_class;y=d.inner_scrolling;C=d.recalc_every;h=d.parent;p=d.offset_top;n=d.spacer;v=d.bottoming;null==p&&(p=0);null==h&&(h=void 0);null==y&&(y=!0);null==s&&(s="is_stuck");null==v&&(v=!0);G=function(a,d,q,z,D,t,r,E){var u,F,m,A,c,f,B,w,x,g,b;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);f=a.parent();null!=h&&(f=f.closest(h));if(!f.length)throw"failed to find stick parent";
u=m=!1;(g=null!=n?n&&a.closest(n):k("<div />"))&&g.css("position",a.css("position"));B=function(){var c,e,l;if(!E&&(c=parseInt(f.css("border-top-width"),10),e=parseInt(f.css("padding-top"),10),d=parseInt(f.css("padding-bottom"),10),q=f.offset().top+c+e,z=f.height(),m&&(u=m=!1,null==n&&(a.insertAfter(g),g.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(s),l=!0),D=a.offset().top-parseInt(a.css("margin-top"),10)-p,t=a.outerHeight(!0),r=a.css("float"),g&&g.css({width:a.outerWidth(!0),
height:t,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),l))return b()};B();if(t!==z)return A=void 0,c=p,x=C,b=function(){var b,k,l,h;if(!E&&(null!=x&&(--x,0>=x&&(x=C,B())),l=e.scrollTop(),null!=A&&(k=l-A),A=l,m?(v&&(h=l+t+c>z+q,u&&!h&&(u=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),l<D&&(m=!1,c=p,null==n&&("left"!==r&&"right"!==r||a.insertAfter(g),g.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(s).trigger("sticky_kit:unstick")),
y&&(b=e.height(),t+p>b&&!u&&(c-=k,c=Math.max(b-t,c),c=Math.min(p,c),m&&a.css({top:c+"px"})))):l>D&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(s),null==n&&(a.after(g),"left"!==r&&"right"!==r||g.append(a)),a.trigger("sticky_kit:stick")),m&&v&&(null==h&&(h=l+t+c>z+q),!u&&h)))return u=!0,"static"===f.css("position")&&f.css({position:"relative"}),a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},
w=function(){B();return b()},F=function(){E=!0;e.off("touchmove",b);e.off("scroll",b);e.off("resize",w);k(document.body).off("sticky_kit:recalc",w);a.off("sticky_kit:detach",F);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});f.position("position","");if(m)return null==n&&("left"!==r&&"right"!==r||a.insertAfter(g),g.remove()),a.removeClass(s)},e.on("touchmove",b),e.on("scroll",b),e.on("resize",w),k(document.body).on("sticky_kit:recalc",w),a.on("sticky_kit:detach",F),setTimeout(b,
0)}};q=0;for(H=this.length;q<H;q++)d=this[q],G(k(d));return this}}).call(this);