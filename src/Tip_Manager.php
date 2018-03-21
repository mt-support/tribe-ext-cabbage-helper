<?php
namespace Tribe\MT_Support\Extensions\Cabbage_Helper;

class Tip_Manager {
	/** @var array */
	private $context = [];

	public function hook() {
		add_filter( 'cabbage_helper.tips', [ $this, 'add_tips' ], 10, 2 );
	}

	public function add_tips( array $tips, array $context ) {
		$this->context = $context;
		return array_merge( $tips, $this->all_pages(), $this->settings_screen() );
	}

	private function all_pages() {
		return [
			esc_html__( 'This is an event admin screen from which you can do lots of things.', 'cabbage-helper' )
		];
	}

	private function settings_screen() {
		return ( 'tribe-common' === $this->context['page'] ) ? array_merge(
			$this->general_settings_tips(),
			$this->events_pro_settings_tips()
		) : [];
	}

	private function general_settings_tips() {
		return [
			esc_html__( 'On this page you can adjust lots of interesting things via various settings tabs.', 'cabbage-helper' )
		];
	}

	private function events_pro_settings_tips() {
		return ( 'defaults' === $this->context['tab'] ) ? [
			esc_html__( 'All sorts of default content possibilities exist within this tab.', 'cabbage-helper' )
		] : [];
	}
}