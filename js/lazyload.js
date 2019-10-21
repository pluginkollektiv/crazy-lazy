/* lazyload.js (c) Lorenzo Giuliani
* MIT License (http://www.opensource.org/licenses/mit-license.html)
*
* Modified by Sergej Müller | http://wpcoder.de
*/


window.onload = function() {
	var $q = function(q, res){
		if (document.querySelectorAll) {
			res = document.querySelectorAll(q);
		} else {
			var d=document,
				a=d.styleSheets[0] || d.createStyleSheet();

			a.addRule(q,'f:b');
			for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
				l[b].currentStyle.f && c.push(l[b]);

			a.removeRule(0);
			res = c;
		}

		return res;
	},

	addEventListener = function(evt, fn) {
		window.addEventListener
			? this.addEventListener(evt, fn, false)
			: (window.attachEvent)
			? this.attachEvent('on' + evt, fn)
			: this['on' + evt] = fn;
	},

	triggerEvent = function(el, type, initParams){
		if (typeof window.CustomEvent !== "function") { // IE
			window.CustomEvent = function(event, params) {
				params = params || { bubbles: false, cancelable: false, detail: null };
				var evt = document.createEvent( 'CustomEvent' );
				evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
				return evt;
			}
		}
		var evt = new CustomEvent(type, initParams);
		el.dispatchEvent(evt);
 },

	_has = function(obj, key) {
		return Object.prototype.hasOwnProperty.call(obj, key);
	};

	function loadImage (el, fn) {
		var img = new Image(),
			src = el.getAttribute('data-src');

		img.onload = function() {
			if ( !! el.parent )
				el.parent.replaceChild(img, el)
			else
				el.src = src;

			if ( fn ) fn();

			triggerEvent(document.body, 'unveiled', {
				bubbles: true, 
				detail: {
					img: !!el.parent ? img : el
				}
			});
		}

		img.src = src;
	}

	function elementInViewport(el) {
		var rect = el.getBoundingClientRect();

		return (
			rect.top    >= 0
			&& rect.left   >= 0
			&& rect.top <= (window.innerHeight || document.documentElement.clientHeight)
		);
	}

	var images = new Array(),
		query = $q('img.crazy_lazy'),
		processScroll = function() {
			for (var i = 0; i < images.length; i++) {
				if (elementInViewport(images[i])) {
					loadImage(
						images[i],
						function () {
							images.splice(i, 1);
						}
					);
				}
			}
		};

	for (var i = 0; i < query.length; i++) {
		query[i].removeAttribute('style');
		images.push(query[i]);
	};

	processScroll();

	addEventListener(
		'scroll',
		processScroll
	);
};