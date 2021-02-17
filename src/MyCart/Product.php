<?php

namespace MyCart;

class Product
{
    /**
     * @var ProductId
     */
    private $id;
    /**
     * @var ProductName
     */
    private $productName;
    /**
     * @var ProductPrice
     */
    private $price;
    /**
     * @var ProductOfferPrice
     */
    private $offerPrice;
    /**
     * @var QuantityForOfferPrice
     */
    private $quantityForOfferPrice;

    public function __construct(ProductId $id, ProductName $productName, ProductPrice $price, ProductOfferPrice $offerPrice, QuantityForOfferPrice $quantityForOfferPrice)
    {
        $this->checkOfferPricesIsLowerThanNormalPrice($price, $offerPrice);

        $this->id = $id;
        $this->productName = $productName;
        $this->price = $price;
        $this->offerPrice = $offerPrice;
        $this->quantityForOfferPrice = $quantityForOfferPrice;
    }

    private function checkOfferPricesIsLowerThanNormalPrice(ProductPrice $productPrice, ProductOfferPrice $productOfferPrice): void
    {
        if ($productOfferPrice->getValue() > $productPrice->getValue()) {
            throw new \ErrorException("Offer price can't be greater than normal price");
        }
    }

    /**
     * @return ProductId
     */
    public function getId(): string
    {
        return $this->id->getValue();
    }

    /**
     * @return ProductName
     */
    public function getProductName(): string
    {
        return $this->productName->getValue();
    }

    /**
     * @return ProductPrice
     */
    public function getPrice(): float
    {
        return $this->price->getValue();
    }

    /**
     * @return ProductOfferPrice
     */
    public function getOfferPrice(): float
    {
        return $this->offerPrice->getValue();
    }

    /**
     * @return QuantityForOfferPrice
     */
    public function getQuantityForOfferPrice(): int
    {
        return $this->quantityForOfferPrice->getValue();
    }


}
