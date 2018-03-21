<?php
/**
 * Plugin Name:     The Events Calendar Extension: Cabbage Helper
 * Description:     Prototype of cabbage integration in the context of The Events Calendar and its related plugins.
 * Version:         0.1.0
 * Extension Class: Tribe__Support_Extensions__Cabbage_Helper
 * Author:          Modern Tribe, Inc.
 * Author URI:      http://m.tri.be/1971
 * License:         GPL version 3 or any later version
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:     match-the-plugin-directory-name
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 */

// Do not load unless Tribe Common is fully loaded and our class does not yet exist.
if ( class_exists( 'Tribe__Extension' ) && version_compare( PHP_VERSION, '7.0', '>=' ) ) {
	/**
	 * Extension main class, class begins loading on init() function.
	 */
	class Tribe__Support_Extensions__Cabbage_Helper extends Tribe__Extension {
		/** @var Tribe\MT_Support\Extensions\Cabbage_Helper\Main */
		private $main;

		/** @var Tribe__Autoloader */
		private $class_loader;

		private $dir;
		private $url;

		public function construct() {
			$this->add_required_plugin( 'Tribe__Events__Main', '4.6' );
		}

		public function init() {
			$this->dir = __DIR__;
			$this->url = plugin_dir_url( __FILE__ );

			$this->class_loader();
			$this->main();

			do_action( 'cabbage_helper.initialized', $this );
		}

		/**
		 * @return Tribe__Autoloader
		 */
		public function class_loader() {
			if ( empty( $this->class_loader ) ) {
				$this->class_loader = new Tribe__Autoloader;
				$this->class_loader->set_dir_separator( '\\' );
				$this->class_loader->register_prefix(
					'Tribe\MT_Support\Extensions\Cabbage_Helper\\',
					__DIR__ . DIRECTORY_SEPARATOR . 'src'
				);
			}

			$this->class_loader->register_autoloader();
			return $this->class_loader;
		}

		/**
		 * @return Tribe\MT_Support\Extensions\Cabbage_Helper\Main|null
		 */
		public function main() {
			if ( empty( $this->main ) ) {
				// Avoid parse errors if loaded under PHP 5.2
				$class = 'Tribe\MT_Support\Extensions\Cabbage_Helper\Main';
				$this->main = new $class( $this->dir, $this->url );
				$this->main->hook();
			}

			return $this->main;
		}
	}
}