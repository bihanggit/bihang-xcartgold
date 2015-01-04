oklink/xcartgold-plugin
=======================

# Installation

1. Copy these files into your xcart/ directory (e.g. ~/www/xcart/ or ~/www/).  They will not overwrite any existing files.
2. Run modules/Oklink/install.sql on your Xcart database (e.g. "mysql -u [user] -p [xcartdb] < install.sql OR copy the contents into phpMyAdmin).

# Configuration

1. Create an API key and secret at [https://oklink.com](https://oklink.com "oklink").
2. In your XCart admin panel, go to Settings > Payment Methods > Payment Gateways.
3. Change Your Country to All Countries, select Oklink and click Add.
4. Click Payment Methods tab, check the box next to Oklink and click Apply Changes.
5. In the same Oklink section click Configure. 
6. Enter your API key and secret from step 1.
7. Choose the currency that corresponds to your store's currency from the drop-down list.
8. Click Update.


# Usage

When a shopper chooses the Oklink payment method, they will be redirected to oklink.com where they will pay an order.  Oklink will then notify your Xcart system that the order was paid for.  The customer will be presented with a button to return to your store.  

The order status in the admin panel will be "Processed" if payment has been confirmed. 

Note: This extension does not provide a means of automatically pulling a current BTC exchange rate for presenting BTC prices to shoppers.
