<?php


namespace MyCart;


class ProductName
{
    /**
     * @var string
     */
    private $value;

    /**
     * ProductName constructor.
     * @param string $value
     * @throws \ErrorException
     */
    public function __construct(string $value)
    {
        $this->checkLength($value);

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() :string
    {
        return $this->value;
    }

    private function checkLength($value): void
    {
        if(strlen($value) < 3 || strlen($value) > 255) {
            throw new \ErrorException('Product name must have from 3 to 255 characteres');
        }
    }

}
