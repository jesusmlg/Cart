<?php


namespace MyCart;


class ProductOfferPrice
{
    /**
     * @var float
     */
    private $value;

    /**
     * ProductOfferPrice constructor.
     * @param float $value
     * @throws \ErrorException
     */
    public function __construct(float $value)
    {
        if(!is_numeric($value)) {
            throw new \ErrorException("Offer Price must be a number");
        }

        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue() :float
    {
        return $this->value;
    }
}
