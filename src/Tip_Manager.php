<?php
namespace Tribe\MT_Support\Extensions\Cabbage_Helper;

class Tip_Manager {
	public function hook() {
		add_filter( 'cabbage_helper.tips', [ $this, 'add_tips' ], 10, 2 );
	}

	public function add_tips( array $tips, array $context ) {
		// General advice
		$tips[] = esc_html__( 'This is an event admin screen from which you can do lots of things.', 'cabbage-helper' );

		// Adice specifically relating to the settings tabs
		if ( 'tribe-common' === $context['page'] ) {
			$tips[] = esc_html__( 'On this page you can adjust lots of interesting things via various settings tabs.', 'cabbage-helper' );
		}

		return $tips;
	}
}