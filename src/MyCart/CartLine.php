<?php

namespace MyCart;

class CartLine
{
    private $product;
    private $quantity;
    private $currentProductPrice;

    /**
     * CartLine constructor.
     * @param Product $product
     * @param ProductQuantity $quantity
     */
    public function __construct(Product $product, ProductQuantity $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->currentProductPrice = $this->getCurrentProductPrice();
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->currentProductPrice * $this->quantity->getValue();
    }

    /**
     * @return float
     */
    private function getCurrentProductPrice(): float
    {
        return ($this->quantity->getValue() > $this->product->getQuantityForOfferPrice()) ?
            $this->product->getOfferPrice() :
            $this->product->getPrice();
    }

    /**
     * @return string
     */
    public function getProductId() : string
    {
        return $this->product->getId();
    }

    /**
     * @return Product
     */
    public function getProduct() : Product
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getProductPrice() :float
    {
        return $this->currentProductPrice;
    }



}
