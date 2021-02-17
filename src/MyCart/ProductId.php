<?php


namespace MyCart;


class ProductId
{
    private $value;

    /**
     * ProductId constructor.
     * @param string $uuid
     * @throws \ErrorException
     */
    public function __construct(string $uuid)
    {
        if (!preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $uuid)) {
            throw new \ErrorException("No valid UUID");
        }

        $this->value = $uuid;
    }

    /**
     * @return string
     */
    public function getValue() :string
    {
        return $this->value;
    }
}
