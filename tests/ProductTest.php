<?php


use MyCart\Product;
use MyCart\ProductId;
use MyCart\ProductName;
use MyCart\ProductOfferPrice;
use MyCart\ProductPrice;
use MyCart\QuantityForOfferPrice;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductCanBeCreated()
    {
        $cart = new Product(
            new ProductId('03d2cce9-a8ee-4ad3-a575-512934ca561d'),
            new ProductName('Jack Danields Honey'),
            new ProductPrice(18.95),
            new ProductOfferPrice(15.99),
            new QuantityForOfferPrice(3)
        );

        $this->assertInstanceOf(Product::class, $cart);
    }
}
