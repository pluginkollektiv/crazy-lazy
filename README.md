# Crazy Lazy #
* Contributors:      pluginkollektiv
* Tags:              lazy, load, loading, performance, images
* Donate link:       https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LG5VC9KXMAYXJ
* Requires at least: 3.6
* Tested up to:      4.3
* Stable tag:        trunk
* License:           GPLv2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.html


Lazy load images. Simple to use: activate, done. Search engine and noscript user friendly.


## Description ##
*Crazy Lazy* helps increasing the performance of your blog or website by displaying images efficiently. When a page would usually display some images, *Crazy Lazy* will prevent those images to load. Only when a user scrolls down the page and reaches the position where an image actually should be displayed, that particular image will be loaded from the server.

By loading images only when needed, *Crazy Lazy* will reducing page loading times and (potentially costly) traffic.

This Lazy Load plugin is structured very lean and does not require any settings: activate, done. Depending on the theme or the usage of jQuery *Crazy Lazy* optionally will utilze a modified version of the jQuery plugin [Unveil.js](https://github.com/luis-almeida/unveil), or the native JavaScript library [lazyload.js](https://gist.github.com/miloplacencia/3931803).


### Deutsch ###
*Crazy Lazy* übernimmt die effiziente Anzeige der Artikelbilder im WordPress-Blog. Um die Performance der Blogseiten zu steigern, werden nicht alle Bilder sofort vom Server angefordert, sondern nach Bedarf: Erst beim Erreichen der Scroll-Position lädt *Crazy Lazy* das entsprechende Bild nach.

Durch die Nachlade-Technik lassen sich Ladezeiten verkürzen und der Traffic reduzieren.

Das Lazy Load Plugin ist simpel aufgebaut und benötigt keinerlei Einstellungen: Aktivieren, läuft. Je nach Theme bzw. die jQuery-Nutzung verwendet *Crazy Lazy* wahlweise das modifizierte jQuery Plugin [Unveil.js](https://github.com/luis-almeida/unveil) oder die JavaScript-native Bibliothek [lazyload.js](https://gist.github.com/miloplacencia/3931803).


### Styling ###
Placeholders for images can be styled, i.e. like this:

`img[src*='data:image/gif;base64'] {
    border: 1px dashed #dbdbdb;
}`

`img.crazy_lazy {
    background: url(/wp-includes/images/wpspin-2x.gif) no-repeat center center;
    background-size: 16px 16px;
}`

### Excluding images ###

It's possible to exclude some images from the lazy loading. This can be achieved by adding an attribute `data-crazy-lazy="exclude"` to the images that should not lazy loaded by the plugin. 

### Video ###
[youtube http://www.youtube.com/watch?v=tMv5tl3Q4Aw]


### Memory Usage ###
* Back-end: ~ 0,01 MB
* Front-end: ~ 0,04 MB


### Credits ###
* Author: [Sergej Müller](https://sergejmueller.github.io/)
* Maintainers: [pluginkollektiv](http://pluginkollektiv.org/)


## Installation ##
* If you don’t know how to install a plugin for WordPress, [here’s how](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).


## Frequently Asked Questions ##
### Will this plugin lazy load all the images on a page? ###
All images that have been uploaded into your media library, including featured images.

### Will I have to edit any theme template files to make this work? ###
Usually no. If Crazy Lazy doesn’t work out of the box, check your active theme’s `footer.php` template file. There should be a line calling `wp_footer()` in it which is required for Crazy Lazy to work properly.

### What’s with the “modified” version of Unveil.js? ###
That’s a fork of Unveil.js: [Unveil.js for WordPress](https://github.com/sergejmueller/unveil-wordpress-plugin) by.

### Will Crazy Lazy work well with any caching plugins? ###
Crazy Lazy will work with every caching plugin, including our own [Cachify](https://wordpress.org/plugins/cachify/).


## Changelog ##
### 0.1.0 ###
* fixed a bug in the regex

### 0.0.9.2 ###
* translated README
* updated [plugin authors](https://gist.github.com/glueckpress/f058c0ab973d45a72720)

### 0.0.9.1 ###
* Removed support for WordPress’ native galleries after some users had reported issues

### 0.0.9 ###
* Support zu WordPress 4.0
* Lazy Loading für WordPress-Bildergalerien

### 0.0.8 ###
* Weiches Einblenden der Bilder (FadeIn)
* Modifizierung der Unveil.js-Bibliothek

### 0.0.7 ###
* Unterstützung weiterer Formate des img-Tags

### 0.0.6 ###
* Hot Fix für fehlerhafte WordPress-Funktion `wp_script_is`

### 0.0.5 ###
* Fallback aus purem JavaScript
* Umzug to WordPress.org
* [Mehr auf Google+](https://plus.google.com/110569673423509816572/posts/SnhULufzrMF)
