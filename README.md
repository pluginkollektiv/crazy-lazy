# Crazy Lazy #
* Contributors:      pluginkollektiv
* Tags:              lazy, load, loading, performance, images
* Donate link:       https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8CH5FPR88QYML
* Requires at least: 3.6
* Tested up to:      4.6
* Stable tag:        1.0.3
* License:           GPLv2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.html


Lazy load images. Simple to use: activate, done. Search engine and noscript user friendly.


## Description ##
*Crazy Lazy* helps increasing the performance of your blog or website by displaying images efficiently. When a page would usually display some images, *Crazy Lazy* will prevent those images to load. Only when a user scrolls down the page and reaches the position where an image actually should be displayed, that particular image will be loaded from the server.

By loading images only when needed, *Crazy Lazy* will reducing page loading times and (potentially costly) traffic.

This Lazy Load plugin is structured very lean and does not require any settings: activate, done. Depending on the theme or the usage of jQuery *Crazy Lazy* optionally will utilze a modified version of the jQuery plugin [Unveil.js](https://github.com/luis-almeida/unveil), or the native JavaScript library [lazyload.js](https://gist.github.com/miloplacencia/3931803).

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


### Will Crazy Lazy work well with any caching plugins? ###
Crazy Lazy will work with every caching plugin, including our own [Cachify](https://wordpress.org/plugins/cachify/).


## Changelog ##
### 1.0.3 ###
* fixed some cases with HTML attributes not being closed correctly

### 1.0.2 ###
* fixed an unescaped slash in the regular expression

### 1.0.1 ###
* fixed a formatting error in the regular expression replacement

### 1.0.0 ###
* new regex to match images and preventing duplicate replacements
* added an option to exclude images from lazy loading by using a special attribute

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
