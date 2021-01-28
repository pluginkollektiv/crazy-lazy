# Crazy Lazy #

Contributors:      pluginkollektiv  
Tags:              lazy, load, loading, performance, images  
Donate link:       https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=TD4AMD2D8EMZW  
Requires at least: 3.6  
Tested up to:      5.6  
Stable tag:        1.2.0  
License:           GPLv2 or later  
License URI:       http://www.gnu.org/licenses/gpl-2.0.html  
Lazy load images. Simple to use: activate, done. Search engine and noscript user friendly.  

## Description ##
**Warning: *Crazy Lazy* has reached end of life. WordPress 5.5+ supports [lazy-loading of images in Core](https://make.wordpress.org/core/2020/07/14/lazy-loading-images-in-5-5/) based on the native HTML `loading` attribute. If you look for an alternative plugin, we recommend to use [Lazy Loader](https://wordpress.org/plugins/lazy-loading-responsive-images/) instead.**

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
It's possible to exclude some images from the lazy loading. This can be achieved by adding a data attribute `data-crazy-lazy="exclude"` or `data-skip-lazy` to the images that should not lazy loaded by the plugin.
Alternatively you can add a CSS class `crazy_lazy` or `skip-lazy`. These CSS classes can also be added to the image block.

### Support ###
* Community support via the [support forums on wordpress.org](https://wordpress.org/support/plugin/crazy-lazy)
* We don’t handle support via e-mail, Twitter, GitHub issues etc.

### Contribute ###
* Active development of this plugin is handled [on GitHub](https://github.com/pluginkollektiv/crazy-lazy).
* Pull requests for documented bugs are highly appreciated.
* If you think you’ve found a bug (e.g. you’re experiencing unexpected behavior), please post at the [support forums](https://wordpress.org/support/plugin/crazy-lazy) first.
* If you want to help us translate this plugin you can do so [on WordPress Translate](https://translate.wordpress.org/projects/wp-plugins/crazy-lazy).

### Credits ###
* Author: [Sergej Müller](https://sergejmueller.github.io/)
* Maintainers: [pluginkollektiv](https://pluginkollektiv.org/)


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

### 1.2.0 ###
* Fix PHP warning due to undefined index (#37, #38) - thanks to Rouven Hurling
* Add EOL notice to the admin area recommending Lazy Loader as an alternative

### 1.1.0 ###
* add support for image block using a skip-class

### 1.0.5 ###
* add support for new skip data attribute "data-skip-lazy" and CSS class "skip-lazy"

### 1.0.4 ###
* fixed duplicate replacements of a single image

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
* updated [plugin authors](https://pluginkollektiv.org/hello-world/)

### 0.0.9.1 ###
* Removed support for WordPress’ native galleries after some users had reported issues

### 0.0.9 ###
* WordPress 4.0 Support
* Lazy Loading for WordPress-image-gallery

### 0.0.8 ###
* Smooth fadein of images
* Unveil.js-library modifications

### 0.0.7 ###
* Support of more formats for the img-tags

### 0.0.6 ###
* Hot Fix for faulty WordPress-function `wp_script_is`

### 0.0.5 ###
* Fallback on pure JavaScript
* Move to WordPress.org
* [Read the realease post](https://crazylazy.pluginkollektiv.org/news/2013/wordpress-plugin-crazy-lazy-load/)
