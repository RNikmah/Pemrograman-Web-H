<?php

trait DiscountTrait
{
    private $discount = 0.1; // 10% diskon

    public function applyDiscount($amount)
    {
        return $amount - ($amount * $this->discount);
    }
}
