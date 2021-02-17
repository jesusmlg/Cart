<?php


use MyCart\Cart;
use MyCart\CartLine;
use MyCart\Product;
use MyCart\ProductId;
use MyCart\ProductName;
use MyCart\ProductOfferPrice;
use MyCart\ProductPrice;
use MyCart\ProductQuantity;
use MyCart\QuantityForOfferPrice;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testCartGetNormalPriceIfLowerThanQuantityForOfferPrice()
    {
        $cart = new Cart();
        $product = $this->getJackDanieldsProduct();

        $productLine = new CartLine(
            $product,
            new ProductQuantity(2)
        );

        $cart->addCartLine($productLine);

        $this->assertEquals(20.00, $cart->getTotalPrice());
    }

    public function testCartGetOfferPriceIfGreaterThanQuantityForOfferPrice()
    {
        $cart = new Cart();
        $product = $this->getJackDanieldsProduct();

        $productLine = new CartLine(
            $product,
            new ProductQuantity(4)
        );

        $cart->addCartLine($productLine);

        $this->assertEquals(20.00, $cart->getTotalPrice());

    }

    public function testAddProductExistingOnCar()
    {
        $cart = new Cart();
        $product = $this->getJackDanieldsProduct();

        $productLine = new CartLine(
            $product,
            new ProductQuantity(4)
        );

        $cart->addCartLine($productLine);

        $this->assertEquals(20.00, $cart->getTotalPrice());

        $productLine = new CartLine(
            $product,
            new ProductQuantity(6)
        );

        $cart->addCartLine($productLine);

        $this->assertEquals(30.00, $cart->getTotalPrice());
        $this->assertEquals(1, count($cart->getCartLines()));
    }

    public function testCantAddMoreThanQuantityLimitProductsException()
    {
        $this->expectException(ErrorException::class);

        $cart = new Cart();
        $product = $this->getJackDanieldsProduct();

        $productLine = new CartLine(
            $product,
            new ProductQuantity(51)
        );
    }

    public function testCartCantNotAcceptMoreThanLimitCartLines()
    {
        $cart = new Cart();
        $maxCartLines = $cart->getMaxCartLines();

        for($i=0; $i < $maxCartLines; $i++) {
            $product = $this->getRandomProduct();
            $cartLine = new CartLine($product, new ProductQuantity(1));
            $cart->addCartLine($cartLine);
        }

        $this->assertEquals($maxCartLines, count($cart->getCartLines()));

        $this->expectException(ErrorException::class);

        $product = $this->getRandomProduct();
        $cartLine = new CartLine($product, new ProductQuantity(1));
        $cart->addCartLine($cartLine);
    }

    public function testCanDeleteAProduct()
    {
        $cart = new Cart();
        $product = $this->getJackDanieldsProduct();

        $productLine = new CartLine($product, new ProductQuantity(1));
        $cart->addCartLine($productLine);

        $this->assertEquals(1, count($cart->getCartLines()));
        $cart->deleteProductFromCart($product);
        $this->assertEquals(0, count($cart->getCartLines()));
    }

    public function testCantDeleteNotExistingProduct()
    {
        $this->expectException(ErrorException::class);

        $cart = new Cart();
        $product = $this->getRandomProduct();

        $productLine = new CartLine($product, new ProductQuantity(1));
        $cart->addCartLine($productLine);
        $cart->deleteProductFromCart($this->getJackDanieldsProduct());
    }

    public function testCartBulkInsert()
    {
        $productsCartLineArray = $this->getRandomArrayProducts(4);
        $cartLines = $this->getRandomArrayCartLines($productsCartLineArray);

        $cart = new Cart();
        $cart->addCartLineBulk($cartLines);

        $this->assertEquals(4, count($cart->getCartLines()));

    }

    private function getJackDanieldsProduct() : Product
    {
        return new Product(
            new ProductId('03d2cce9-a8ee-4ad3-a575-512934ca561d'),
            new ProductName('Jack Danields Honey'),
            new ProductPrice(10.00),
            new ProductOfferPrice(5.00),
            new QuantityForOfferPrice(3)
        );
    }



    private function getRandomProduct() : Product
    {
        $faker = Faker\Factory::create();

        return new Product(
            new ProductId(\Ramsey\Uuid\Uuid::uuid4()),
            new ProductName($faker->text(40)),
            new ProductPrice($normalPrice = $faker->randomFloat(2, 6, 15)),
            new ProductOfferPrice($normalPrice - 3),
            new QuantityForOfferPrice($faker->numberBetween(4, 10))
        );
    }

    private function getRandomArrayProducts(int $elements): array
    {
        $products = [];

        for($i = 0 ; $i < $elements; $i++) {
            $products[] = $this->getRandomProduct();
        }

        return $products;
    }

    private function getRandomArrayCartLines(array $products): array
    {
        $cartLines = [];

        /**
         * @var Product $product
         */
        foreach ($products as $product) {
            $cartLines[] = new CartLine($product, new ProductQuantity(random_int(1, 9)));
        }

        return $cartLines;
    }


}
