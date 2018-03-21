<?php
namespace Tribe\MT_Support\Extensions\Cabbage_Helper;

use Tribe__Admin__Helpers as TEC_Screens;

class Main {
	const VERSION = '0.1.3';

	private $plugin_dir = '';
	private $plugin_url = '';

	public function __construct( string $plugin_dir, string $plugin_url ) {
		$this->plugin_dir = $plugin_dir;
		$this->plugin_url = $plugin_url;
		tribe_register( 'cabbage_helper', $this );
		tribe_register( 'cabbage_helper.tip_manager', new Tip_Manager );
		tribe( 'cabbage_helper.tip_manager' )->hook();
	}

	public function hook() {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_assets' ) );
	}

	public function add_admin_assets() {
		if ( ! TEC_Screens::instance()->is_screen() ) {
			return;
		}

		$context = [
			'page'    => $_GET['page'] ?? '',
			'pagenow' => $GLOBALS['pagenow'],
			'tab'     => $_GET['tab'] ?? '',
			'typenow' => $GLOBALS['typenow'],
		];

		wp_enqueue_style( 'cabbage_helper_styles', $this->plugin_url . '/assets/css/main.css' );
		wp_enqueue_script( 'cabbage_helper', $this->plugin_url . '/assets/js/main.js', 'jquery', false, true );
		wp_localize_script( 'cabbage_helper', 'cabbageHelperData', [
			'assetsUrl' => $this->plugin_url . '/assets',
			'logoUrl'   => $this->plugin_url . '/assets/images/cabbage-man.png',
			'context'   => $context,
			'tips'      => (array) apply_filters( 'cabbage_helper.tips', [], $context ),
			'i18n'      => [
				'cabbageHelper' => esc_html__( 'Cabbage Helper', 'cabbage-helper' )
			]
		] );
	}
}