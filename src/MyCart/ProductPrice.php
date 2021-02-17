<?php


namespace MyCart;


class ProductPrice
{
    /**
     * @var float
     */
    private $value;

    /**
     * ProductPrice constructor.
     * @param float $value
     * @throws \ErrorException
     */
    public function __construct(float $value)
    {
        if(!is_numeric($value)) {
            throw new \ErrorException("Price must be a number");
        }

        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

}
