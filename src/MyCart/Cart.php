<?php

namespace MyCart;

use MyCart\Product;
use MyCart\CartLine;

class Cart
{
    const MAX_PRODUCT_LINES = 10;

    private $cartLines = [];
    private $totalCartPrice = 0;

    public function __construct()
    {
    }

    /**
     * @param \MyCart\CartLine $cartLine
     * @return bool
     * @throws \ErrorException
     */
    public function addCartLine(CartLine $cartLine): bool
    {
        $existingProductInCartLineIndex = $this->getExistingProductInCartLineIndex($cartLine->getProduct());

        //If products exists update line with new data, else create new one line
        if ($existingProductInCartLineIndex !== null) {
            $this->cartLines[$existingProductInCartLineIndex] = $cartLine;
        } else {
            $this->checkMaxProductLines();
            $this->cartLines[] = $cartLine;
        }

        $this->totalCartPrice = $this->calculateTotalPrice();


        return true;
    }

    public function addCartLineBulk(array $cartLines) :bool
    {
        /**
         * @var Cartline $cartLine
         */
        foreach ($cartLines as $cartLine) {
            $this->addCartLine($cartLine);
        }

        return true;
    }

    /**
     * @param \MyCart\Product $product
     * @return int|string|null
     */
    private function getExistingProductInCartLineIndex(Product $product)
    {
        /**
         * @var CartLine $cartLine
         */
        foreach ($this->cartLines as $index => $cartLine) {
            if ($cartLine->getProductId() === $product->getId()) {
                return $index;
            }
        }

        return null;
    }

    /**
     * @throws \ErrorException
     */
    private function checkMaxProductLines() :void
    {
        if (count($this->cartLines) >= self::MAX_PRODUCT_LINES) {
            throw new \ErrorException("Cart has exceded different products limit " . self::MAX_PRODUCT_LINES);
        }
    }

    /**
     * @return float|int
     */
    private function calculateTotalPrice() :float
    {
        $total = 0;

        /**
         * @var CartLine $cartLine
         */
        foreach ($this->cartLines as $cartLine) {
            $total += $cartLine->getTotalPrice();
        }

        return $total;
    }

    /**
     * @return float
     */
    public function getTotalPrice() :float
    {
        return $this->totalCartPrice;
    }


    /**
     * @param \MyCart\Product $product
     * @return bool
     * @throws \ErrorException
     */
    public function deleteProductFromCart(Product $product): bool
    {
        $existingProductInCartLineIndex = $this->getExistingProductInCartLineIndex($product);

        if ($existingProductInCartLineIndex === null) {
            throw new \ErrorException('Product not found on cart');
        }

        array_splice($this->cartLines, $existingProductInCartLineIndex, 1);

        return true;
    }

    /**
     * @return array
     */
    public function getCartLines() : array
    {
        return $this->cartLines;
    }

    /**
     * @return int
     */
    public function getMaxCartLines() :int
    {
        return self::MAX_PRODUCT_LINES;
    }
}
