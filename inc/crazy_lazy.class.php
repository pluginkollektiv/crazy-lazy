<?php


/* Quit */
defined('ABSPATH') OR exit;


/* CrazyLazy class */
final class CrazyLazy {


    /**
    * Class instance
    *
    * @since   0.0.1
    * @change  0.0.1
    */

    public static function instance()
    {
        new self();
    }


    /**
    * Class constructor
    *
    * @since   0.0.1
    * @change  0.0.9
    */

    public function __construct()
    {
        /* Go home */
        if ( is_feed() OR ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) OR (defined('DOING_CRON') && DOING_CRON) OR (defined('DOING_AJAX') && DOING_AJAX) OR (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) ) {
            return;
        }

        /* Hooks */
        add_filter(
            'the_content',
            array(
                __CLASS__,
                'prepare_images'
            ),
            12 /* Important for galleries */
        );
        add_filter(
            'post_thumbnail_html',
            array(
                __CLASS__,
                'prepare_images'
            )
        );
        add_action(
            'wp_enqueue_scripts',
            array(
                __CLASS__,
                'print_scripts'
            )
        );
    }


    /**
    * Prepare content images for Crazy Lazy usage
    *
    * @since   0.0.1
    * @change  0.0.9.1
    *
    * @param   string  $content  Original post content
    * @param   string  $content  Modified post content
    */

    public static function prepare_images($content) {
        /* No lazy images? */
        if ( strpos($content, '-image') === false ) {
            return $content;
        }

        /* Empty gif */
        $null = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';

        /* Replace images */
        return preg_replace(
            array(
                '#(<img class=["\'](.*?(?:wp-image-|wp-post-image).+?)["\'](.+?)src=["\'](.+?)["\'](.*?)(/?)>)#',
                '#(<img src=["\'](.+?)["\'](.+?)class=["\'](.*?(?:wp-image-|wp-post-image).+?)["\'](.*?)(/?)>)#'
            ),
            array(
                '<img class="crazy_lazy ${2}" src="' .$null. '" ${3} data-src="${4}" ${5} style="display:none" ${6}><noscript>${1}</noscript>',
                '<img src="' .$null. '" data-src="${2}" ${3} class="crazy_lazy ${4}" ${5} style="display:none" ${6}><noscript>${1}</noscript>'
            ),
            $content
        );
    }


    /**
    * Print lazy load scripts in footer
    *
    * @since   0.0.1
    * @change  0.0.6
    */

    public static function print_scripts()
    {
        /* Globals */
        global $wp_scripts;

        /* Check for jQuery */
        if ( ! empty($wp_scripts) && (bool)$wp_scripts->query('jquery') ) { /* hot fix for buggy wp_script_is() */
            self::_print_jquery_lazyload();
        } else {
            self::_print_javascript_lazyload();
        }
    }


    /**
    * Call unveil lazy load jQuery plugin
    *
    * @since   0.0.5
    * @change  0.0.9
    */

    private static function _print_jquery_lazyload()
    {
        wp_enqueue_script(
            'unveil.js',
            plugins_url(
                '/js/jquery.unveil.min.js',
                CRAZY_LAZY_BASE
            ),
            array('jquery'),
            '',
            true
        );
    }

    /**
    * Call pure javascript lazyload.js
    *
    * @since   0.0.5
    * @change  0.0.9
    */

    private static function _print_javascript_lazyload()
    {
        wp_enqueue_script(
            'lazyload.js',
            plugins_url(
                '/js/lazyload.min.js',
                CRAZY_LAZY_BASE
            ),
            array(),
            '',
            true
        );
    }
}