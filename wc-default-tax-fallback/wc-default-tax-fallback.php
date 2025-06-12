<?php
/**
 * Plugin Name: WC Default Tax Fallback
 * Description: Adds a configurable fallback country for tax calculation when WooCommerce cannot determine the customer's location (for example because of IP blockers) or when the detected country is not covered by your Standard tax rates. The fallback country can be selected in WooCommerce → Settings → Tax underneath the option "Calculate tax based on".
 * Author: Dennis Joch
 * Author URI: https://deinseoexpert.de
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.2
 * Tested up to: 6.8
 * WC requires at least: 6.0
 * WC tested up to: 8.7
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-default-tax-fallback
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) || exit;

// Load textdomain for translations.
add_action( 'init', function () {
    /*
     * Translation files should be placed in wp-content/languages/plugins/
     * as recommended by WordPress.org.
     */
    load_plugin_textdomain( 'wc-default-tax-fallback', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
} );

// Only continue if WooCommerce is active. Prevents fatal errors if someone activates the plugin without WC.
add_action( 'plugins_loaded', function () {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }

    if ( ! class_exists( 'WC_Default_Tax_Fallback' ) ) {
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	class WC_Default_Tax_Fallback {
		const OPTION_KEY = 'woocommerce_fallback_tax_country';

		public static function init() {
			add_filter( 'woocommerce_tax_settings', array( __CLASS__, 'add_settings_field' ), 20 );
			add_filter( 'woocommerce_admin_settings_sanitize_option', array( __CLASS__, 'sanitize_option' ), 10, 3 );
			add_filter( 'woocommerce_customer_taxable_address', array( __CLASS__, 'maybe_apply_fallback_to_taxable_address' ), 20, 2 );
			add_filter( 'woocommerce_customer_default_location', array( __CLASS__, 'maybe_apply_fallback_to_default_location' ), 20 );
		}

		public static function add_settings_field( $settings ) {
			$updated = array();
			foreach ( $settings as $setting ) {
				$updated[] = $setting;
				if ( isset( $setting['id'] ) && 'woocommerce_tax_based_on' === $setting['id'] ) {
					$updated[] = self::get_field_definition();
				}
			}
			return $updated;
		}

		protected static function get_field_definition() {
			return array(
				'title'    => __( 'Fallback tax country', 'wc-default-tax-fallback' ),
				'desc'     => __( 'Country to use when no valid customer country can be detected or the detected country has no Standard tax rate.', 'wc-default-tax-fallback' ),
				'id'       => self::OPTION_KEY,
				'type'     => 'select',
				'class'    => 'wc-enhanced-select',
				'css'      => 'min-width:150px;',
				'options'  => self::get_countries_with_standard_tax_rates(),
				'default'  => '',
				'autoload' => false,
			);
		}

		protected static function get_countries_with_standard_tax_rates() {
			global $wpdb;
			$codes = $wpdb->get_col( "SELECT DISTINCT tax_rate_country FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_class = ''" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB
			$countries = array( '' => __( '— Select country —', 'wc-default-tax-fallback' ) );
			$wc_countries = WC()->countries->get_countries();
			foreach ( $codes as $code ) {
				$code = strtoupper( $code );
				if ( isset( $wc_countries[ $code ] ) ) {
					$countries[ $code ] = $wc_countries[ $code ];
				}
			}
			asort( $countries );
			return $countries;
		}

		public static function sanitize_option( $value, $option, $raw_value ) { // phpcs:ignore Squiz.Commenting.FunctionComment.InvalidTypeHint
			if ( self::OPTION_KEY === $option['id'] ) {
				$allowed = array_keys( self::get_countries_with_standard_tax_rates() );
				$san = strtoupper( sanitize_text_field( $raw_value ) );
				return in_array( $san, $allowed, true ) ? $san : '';
			}
			return $value;
		}

		public static function maybe_apply_fallback_to_taxable_address( $address, $customer ) {
			$country = $address[0];
			if ( ! empty( $country ) && self::country_has_standard_rate( $country ) ) {
				return $address;
			}
			$fallback = get_option( self::OPTION_KEY, '' );
			if ( $fallback ) {
				$address[0] = $fallback;
			}
			return $address;
		}

		public static function maybe_apply_fallback_to_default_location( $location_string ) {
			list( $country ) = array_pad( explode( ':', $location_string ), 1, '' );
			if ( empty( $country ) ) {
				$fallback = get_option( self::OPTION_KEY, '' );
				if ( $fallback ) {
					return $fallback;
				}
			}
			return $location_string;
		}

		protected static function country_has_standard_rate( $country ) {
			$country = strtoupper( $country );
			static $cache = array();
			if ( isset( $cache[ $country ] ) ) {
				return $cache[ $country ];
			}
			global $wpdb;
			$result = (bool) $wpdb->get_var( $wpdb->prepare( "SELECT tax_rate_id FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_country = %s AND tax_rate_class = '' LIMIT 1", $country ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB
			$cache[ $country ] = $result;
			return $result;
		}
	}

	}

	// Initialise the plugin once the class is declared.
	WC_Default_Tax_Fallback::init();
} );
