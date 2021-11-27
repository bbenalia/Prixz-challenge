<?php

require_once 'vendor/autoload.php';
require_once './config/woo.php';

use Automattic\WooCommerce\Client;

class WooCommerce
{
  private $store_url;
  private $woo_key;
  private $woo_key_secret;

  public function __construct()
  {
    $this->store_url = STORE_URL;
    $this->woo_key = WOO_KEY;
    $this->woo_key_secret = WOO_KEY_SECRET;
  }

  public function connect()
  {
    try {
      $this->wooCommerce = new Client(
        STORE_URL,
        WOO_KEY,
        WOO_KEY_SECRET,
        [
          'wp_api' => true,
          'version' => 'wc/v3'
        ]
      );

      return $this->wooCommerce;
    } catch (Throwable $error) {
      throw new Exception($error->getMessage());
    }
  }

  public function __destruct()
  {
    $this->wooCommerce = null;
  }
}
