<?php
/**
 * CrazyLazy plugin class
 *
 * @package CrazyLazy
 */

/* Quit */
defined( 'ABSPATH' ) || exit;


/**
 * Class CrazyLazy
 */
final class CrazyLazy {


	/**
	 * Class instance
	 *
	 * @since   0.0.1
	 * @change  0.0.1
	 */
	public static function instance() {
		new self();
	}


	/**
	 * Class constructor
	 *
	 * @since   0.0.1
	 * @change  0.0.9
	 */
	public function __construct() {
		/* Go home */
		if ( is_feed() || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) ) {
			return;
		}

		/* Hooks */
		add_action(
			'init',
			array(
				__CLASS__,
				'load_plugin_textdomain',
			)
		);
		add_filter(
			'the_content',
			array(
				__CLASS__,
				'prepare_images',
			),
			12 /* Important for galleries */
		);
		add_filter(
			'post_thumbnail_html',
			array(
				__CLASS__,
				'prepare_images',
			)
		);
		add_filter(
			'widget_text',
			array(
				__CLASS__,
				'prepare_images',
			)
		);
		add_filter(
			'get_avatar',
			array(
				__CLASS__,
				'prepare_images',
			)
		);
		add_action(
			'wp_enqueue_scripts',
			array(
				__CLASS__,
				'print_scripts',
			)
		);
	}

	/**
	 * Add deprecation notice in WP Admin.
	 */
	public static function add_deprecation_notice() {
		// Only show notice for users who can actually uninstall or update plugins.
		if ( ! current_user_can( 'delete_plugins' ) && ! current_user_can( 'update_plugins' ) ) {
			return;
		}

		global $wp_version;
		?>
<div class="notice notice-warning">
			<p>
				<?php
				echo wp_kses(
					__( 'Crazy Lazy is deprecated in favor of <a href="https://make.wordpress.org/core/2020/07/14/lazy-loading-images-in-5-5/">lazy loading in Core</a> and the <a href="https://wordpress.org/plugins/lazy-loading-responsive-images/">Lazy Loader</a> plugin.', 'crazy-lazy' ),
					array( 'a' => array( 'href' => array() ) )
				);
				?>
			</p>
			<ol>
				<li>
					<?php
					echo wp_kses(
						__( 'Lazy loading in Core (available in WordPress 5.5+) is based on the HTML <code>loading</code> attribute.', 'crazy-lazy' ),
						array( 'code' => array() )
					);
					?>
					<?php
					if ( version_compare( $wp_version, '5.5', '>=' ) ) {
						echo wp_kses(
							sprintf(
								/* translators: WordPress version */
								__( 'As you are running WordPress %s, images are lazy loaded by default in <a href="https://caniuse.com/loading-lazy-attr">browsers supporting native lazy loading</a>.', 'crazy-lazy' ),
								$wp_version
							),
							array(
								'a'    => array( 'href' => array() ),
								'code' => array(),
							)
						);
					} else {
						echo esc_html(
							sprintf(
								/* translators: WordPress version */
								__( 'You are running WordPress %s, the feature is not available.', 'crazy-lazy' ),
								$wp_version
							)
						);
					}
					?>
				</li>
				<?php if ( is_plugin_active( 'lazy-loading-responsive-images/lazy-load-responsive-images.php' ) ) { ?>
					<li><?php esc_html_e( 'As Lazy Loader is active, you can deactivate and uninstall Crazy Lazy.', 'crazy-lazy' ); ?></li>
					<?php
				} else {
					$install_url = add_query_arg(
						array(
							's'    => 'florianbrinkmann',
							'tab'  => 'search',
							'type' => 'author',
						),
						admin_url( '/plugin-install.php' )
					);
					?>
					<li><?php esc_html_e( 'In case you still need a lazy loading plugin, we recommend to switch to Lazy Loader:', 'crazy-lazy' ); ?>
						<a href="<?php echo esc_attr( $install_url ); ?>">
							<?php esc_html_e( 'Install now.', 'crazy-lazy' ); ?>
						</a>
					</li>
				<?php } ?>
			</ol>
		</div>
		<?php
	}

	/**
	 * Load the textdomain for backward compatibility of older WordPress versions and to prevent a warning in GlotPress.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'crazy-lazy' );
	}

	/**
	 * Prepare content images for Crazy Lazy usage
	 *
	 * @since   0.0.1
	 * @change  1.0.0
	 *
	 * @param   string $content The original post content.
	 *
	 * @return  string The modified post content.
	 */
	public static function prepare_images( $content ) {
		/* No lazy images? */
		if ( strpos( $content, '-image' ) === false && strpos( $content, 'avatar-' ) === false && strpos( $content, 'attachment-' ) === false ) {
			return $content;
		}

		/* Replace images */
		return preg_replace_callback(
			'/(?P<all>                                                              (?# match the whole img tag )
				(?P<figure_opening><figure[^>]*?>)?                                 (?# the optional opening figure tag, if an image block is used )
				<img(?P<before>[^>]*?)                                              (?# the opening of the img and some optional attributes )
				(                                                                   (?# match a class attribute followed by some optional ones and the src attribute )
					class=["\'](?P<class1>[^>"\']*)["\']
					(?P<between1>[^>]*?)
					src=["\'](?P<src1>[^>"\']*)["\']
					|                                                               (?# match same as before, but with the src attribute before the class attribute )
					src=["\'](?P<src2>[^>"\']*)["\']
					(?P<between2>[^>]*?)
					class=["\'](?P<class2>[^>"\']*)["\']
					|                                                               (?# match images with a src attribute nut without a class attribute )
					src=["\'](?P<src3>[^>"\']*)["\']
				)
				(?P<after>[^>]*?)                                                   (?# match any additional optional attributes )
				(?P<closing>\/?)>                                                   (?# match the closing of the img tag with or without a self closing slash )
				(?P<figure_closing><\/figure>)?                                     (?# the optional closing figure tag, if an image block is used )
			)/x',
			array( 'CrazyLazy', 'replace_images' ),
			$content
		);
	}

	/**
	 * The callback function for the preg_match_callback to modify the img tags.
	 *
	 * @since   1.0.0
	 *
	 * @param array $matches The regex matches.
	 *
	 * @return string The modified content string.
	 */
	public static function replace_images( $matches ) {
		/* Empty gif */
		$null = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
		// Return unmodified image if the "data skip" attribute was found or the image has already been processed.
		if (
			false !== strpos( $matches['all'], 'data-crazy-lazy="exclude"' )
			|| false !== strpos( $matches['all'], 'data-skip-lazy' )
			|| false !== strpos( $matches['class1'] . $matches['class2'], 'crazy_lazy' )
			|| false !== strpos( $matches['class1'] . $matches['class2'], 'skip-lazy' )
			|| false !== strpos( $matches['figure_opening'], 'crazy_lazy' )
			|| false !== strpos( $matches['figure_opening'], 'skip-lazy' )
		) {
			return $matches['all'];
		} else {
			if ( ! isset( $matches['figure_closing'] ) ) {
				$matches['figure_closing'] = '';
			}

			return $matches['figure_opening'] . '<img ' . $matches['before']
				. ' style="display:none" '
				. ' class="crazy_lazy ' . $matches['class1'] . $matches['class2'] . '" src="' . $null . '" '
				. $matches['between1'] . $matches['between2']
				. ' data-src="' . $matches['src1'] . $matches['src2'] . $matches['src3'] . '" '
				. $matches['after']
				. $matches['closing'] . '>' . $matches['figure_closing'] . '<noscript>' . $matches['all'] . '</noscript>';
		}
	}


	/**
	 * Print lazy load scripts in footer
	 *
	 * @since   0.0.1
	 * @change  0.0.6
	 */
	public static function print_scripts() {
		/* Globals */
		global $wp_scripts;

		/* Check for jQuery */
		if ( ! empty( $wp_scripts ) && (bool) $wp_scripts->query( 'jquery' ) ) { /* hot fix for buggy wp_script_is() */
			self::print_jquery_lazyload();
		} else {
			self::print_javascript_lazyload();
		}
	}


	/**
	 * Call unveil lazy load jQuery plugin
	 *
	 * @since   0.0.5
	 * @change  0.0.9
	 */
	private static function print_jquery_lazyload() {
		wp_enqueue_script(
			'unveil.js',
			plugins_url(
				'/js/jquery.unveil.min.js',
				CRAZY_LAZY_BASE
			),
			array( 'jquery' ),
			'1.0.4',
			true
		);
	}

	/**
	 * Call pure javascript lazyload.js
	 *
	 * @since   0.0.5
	 * @change  0.0.9
	 */
	private static function print_javascript_lazyload() {
		wp_enqueue_script(
			'lazyload.js',
			plugins_url(
				'/js/lazyload.min.js',
				CRAZY_LAZY_BASE
			),
			array(),
			'1.0.4',
			true
		);
	}
}
