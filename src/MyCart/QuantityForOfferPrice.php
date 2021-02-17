<?php


namespace MyCart;


class QuantityForOfferPrice
{
    /**
     * @var int
     */
    private $value;

    /**
     * QuantityForOfferPrice constructor.
     * @param int $value
     * @throws \ErrorException
     */
    public function __construct(int $value)
    {
        if(!is_int($value)) {
            throw new \ErrorException("Minium quantiy for offer price must be an integer");
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
