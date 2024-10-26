# WooCommerce Price Changer Plugin

A simple WordPress plugin that updates all WooCommerce product prices, setting the decimal portion to `.99` while keeping the integer part (`XX`). It updates both regular and sale prices, making the new prices immediately visible across your WooCommerce store.

## Features

- Changes all WooCommerce product prices to end in `.99`.
- Updates both the regular and sale prices for each product.
- Ensures that updated prices are displayed consistently on all WooCommerce pages (shop, product listings, etc.).

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher

## Installation

1. Download the plugin files and upload the `woocommerce-price-changer` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Ensure WooCommerce is installed and active.

## Usage

1. In the WordPress admin dashboard, go to **Price Change** from the main menu.
2. Click **Change Prices** to update all product prices, setting the decimal portion to `.99`.

*Note*: This action will only change prices if they already exist; products without prices set will remain unchanged.

## Code Example

```php
// Update WooCommerce product prices to end in .99 (keeping integer part)
$product->set_regular_price($new_regular_price);
$product->set_sale_price($new_sale_price);
$product->save();
```
## Screenshots
1. **Price Change Admin Page**  
   ![Price Change Admin Page](https://raw.githubusercontent.com/duckyname/wooc-price-changer-99/refs/heads/main/assets/Screenshot%202024-10-26%20193221.png))

2. **Updated Product Prices**  
   ![Updated Product Prices](https://raw.githubusercontent.com/duckyname/wooc-price-changer-99/refs/heads/main/assets/screenshot-before-after.png))
