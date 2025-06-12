=== WC Default Tax Fallback ===
Contributors: dennisjoch
Donate link: https://coff.ee/dennisjoch
Tags: woocommerce, steuer, vat
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Setzt ein Fallback-Land für die Steuerberechnung, wenn WooCommerce das Kundenland nicht ermitteln kann.

== Beschreibung ==
WooCommerce ermittelt normalerweise das Herkunftsland des Kunden über IP-Geolokalisierung, Kundenkonto oder Lieferadresse. Ist keine dieser Quellen vorhanden *oder* existiert für das ermittelte Land keine Standard-Steuerrate (z. B. weil Sie nur nationale Steuern hinterlegt haben), zeigt WooCommerce **0 %** Steuern an – was zu falschen Preisen führen kann.

Dieses Plugin erlaubt Ihnen, ein „Fallback-Land“ festzulegen. Wird kein gültiges Land erkannt *oder* hat das erkannte Land keine Standardsteuer, verwendet WooCommerce das hier gewählte Land für die Steuerberechnung.

= Funktionen =
* Neues Einstellungsfeld unter **WooCommerce → Einstellungen → Steuer** direkt unterhalb von „Steuer berechnen basierend auf“
* Zur Auswahl stehen nur Länder, für die bereits eine Standard-Steuerrate angelegt wurde
* Volle Kompatibilität mit WooCommerce 6 bis 8
* Vollständig übersetzbar (Text-Domain: `wc-default-tax-fallback`)

== Installation ==
1. Laden Sie die ZIP-Datei im WordPress-Backend unter *Plugins → Installieren → Plugin hochladen* hoch **oder** entpacken Sie den Ordner `wc-default-tax-fallback` in das Verzeichnis `wp-content/plugins/`.
2. Aktivieren Sie das Plugin.
3. Navigieren Sie zu *WooCommerce → Einstellungen → Steuer* und wählen Sie Ihr Fallback-Land aus.

== Häufig gestellte Fragen ==

= Beeinflusst das Plugin bereits angelegte Bestellungen? =
Nein. Das Fallback greift nur bei der Preis- bzw. Steuerberechnung im Warenkorb / Checkout, wenn keine andere gültige Quelle für das Kundenland vorhanden ist.

= Werden personenbezogene Daten verarbeitet? =
Nein, das Plugin führt keinerlei Tracking durch und sendet keine Daten an Dritte.

== Screenshots ==
1. Neues Auswahlfeld „Fallback tax country“ in den WooCommerce-Steuereinstellungen.

== Changelog ==
= 1.0.0 =
* Erstveröffentlichung.

== Upgrade-Hinweise ==

== Credits ==
Entwickelt von Dennis Joch – https://deinseoexpert.de
