=== WC Default Tax Fallback ===
Contributors: dennisjoch
Donate link: https://coff.ee/dennisjoch
Tags: woocommerce, tax, vat
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Provide a fallback country for tax calculations when WooCommerce cannot identify the customer’s country.

== Description ==
WooCommerce normally determines the customer’s country via IP geolocation, the user account or the shipping address. If none of those sources is available *or* if the detected country has **no Standard tax rate defined**, WooCommerce will display **0 %** tax – which results in wrong prices.

This plugin lets you define a *fallback country*. Whenever WooCommerce cannot find a valid customer country *or* the detected country is missing a Standard tax rate, the taxes will be calculated based on the fallback country you choose.

= Features =
* New settings field in **WooCommerce → Settings → Tax** directly beneath “Calculate tax based on”
* Only shows countries that already have a Standard tax rate in your store
* Fully compatible with WooCommerce 6 – 8
* Completely translatable (text-domain: `wc-default-tax-fallback`)

== Installation ==
1. Upload the ZIP file via *Plugins → Add New → Upload Plugin* **or** extract the folder `wc-default-tax-fallback` into `wp-content/plugins/`.
2. Activate the plugin.
3. Go to *WooCommerce → Settings → Tax* and select your fallback country.

== Frequently Asked Questions ==

= Does the plugin affect existing orders? =
No. The fallback is only applied when taxes are calculated in cart / checkout if no other valid source for the customer’s country exists.

= Does the plugin process personal data? =
No, it doesn’t track anything and sends no data to third parties.

== Screenshots ==
1. New “Fallback tax country” select box inside WooCommerce tax settings.

== Changelog ==
= 1.0.0 =
* Initial release.

== Upgrade Notice ==

== Credits ==
Developed by Dennis Joch – https://deinseoexpert.de
