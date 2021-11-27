<?php

abstract class Model
{

    function __construct()
    {
        $this->woo = new WooCommerce();
    }
}
