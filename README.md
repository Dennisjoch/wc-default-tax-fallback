# WC Default Tax Fallback

[![WordPress Tested Up To Version](https://img.shields.io/badge/WordPress-6.8-blue.svg?logo=wordpress&logoColor=white)](https://wordpress.org/) [![WooCommerce](https://img.shields.io/badge/WooCommerce-6.0%20%E2%86%92%208.x-blueviolet?logo=woocommerce&logoColor=white)](https://woocommerce.com/) [![GPL-2.0-or-later](https://img.shields.io/badge/License-GPLv2+-brightgreen.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

> **Stop WooCommerce from showing 0 % tax.**  When the customer’s country cannot be detected **or** has no *Standard* tax rate, this lightweight plugin uses a country of your choice as fallback.

---

## ✨ Features

✅ Adds a new select field to **WooCommerce → Settings → Tax** right below *Calculate tax based on*  
✅ Lists only countries that already have a Standard tax rate in your store  
✅ Works out of the box once the fallback country is selected  
✅ Fully translatable (text-domain `wc-default-tax-fallback`)

---

## 📋 Table of Contents

1. [Requirements](#-requirements)  
2. [Installation](#-installation)  
3. [Screenshots](#-screenshots)  
4. [Contributing](#-contributing)  
5. [License](#-license)  
6. [Author](#-author)

---

## 📦 Requirements

* WordPress **5.8** or higher
* WooCommerce **6.0** – **8.x**
* PHP **7.2** or higher

---

## 🚀 Installation

1. Upload the folder `wc-default-tax-fallback` to `wp-content/plugins/` **or** install the ZIP via *Plugins → Add New → Upload Plugin* in your WordPress admin.  
2. Activate the plugin.  
3. Go to *WooCommerce → Settings → Tax* and pick your fallback country.

---

## 🖼️ Screenshots

| Settings page |
| :---: |
| ![Settings screenshot]([https://github.com/Dennisjoch/wc-default-tax-fallback/blob/efef12319ad3c0762e902633ab5c1a6ffd7aef98/assets/banner-1544x500.png]

(_The screenshot is stored in `.github/screenshot-settings.png` for GitHub; WordPress.org uses the banner/icon assets._)

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

```bash
# Clone
git clone [https://github.com/Dennisjoch/wc-default-tax-fallback.git](https://github.com/Dennisjoch/wc-default-tax-fallback.git)

# (Optional) Install dev dependencies for code style checks
composer install

# Run PHPCS
composer phpcs
```

---

## 📄 License

Distributed under the **GPL-2.0-or-later** license. See [`LICENSE`](https://www.gnu.org/licenses/gpl-2.0.html) for more information.

---

## 🙋 Author

Made with ☕ by **Dennis Joch** – <https://deinseoexpert.de>.  
If you like the plugin, you can [buy me a coffee](https://coff.ee/dennisjoch) ☕.
