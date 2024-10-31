<?php
require_once 'Traits/DiscountTrait.php';

class Cart
{
    use DiscountTrait;

    private $flowers = [];

    public function addFlower(Flower $flower)
    {
        $this->flowers[] = $flower;
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->flowers as $flower) {
            $total += $flower->getPrice();
        }
        return $this->applyDiscount($total);
    }

    public function getCartDetails()
    {
        $cartDetails = [
            'items' => [],
            'total_price' => $this->getTotalPrice()
        ];

        foreach ($this->flowers as $flower) {
            $cartDetails['items'][] = [
                'name' => $flower->name,
                'price' => $flower->price,
                'quantity' => $flower->quantity,
                'description' => $flower->getDescription()
            ];
        }

        return $cartDetails;
    }
}
