<?php


namespace MyCart;

use phpDocumentor\Reflection\Types\Integer;

class ProductQuantity
{

    const MAX_QUANTITY = 50;

    /**
     * @var int
     */
    private $value;

    /**
     * ProductQuantity constructor.
     * @param int $value
     * @throws \ErrorException
     */
    public function __construct(int $value)
    {
        $this->mustLowerThanMaxQuantity($value);

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue() :int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @throws \ErrorException
     */
    private function mustLowerThanMaxQuantity (int $value) :void
    {
        if($value > self::MAX_QUANTITY) {
            throw new \ErrorException('Quantity must be an integer');
        }
    }

    /**
     * @return int
     */
    public function getMaxQuantity() :Integer
    {
        return self::MAX_QUANTITY;
    }

}
