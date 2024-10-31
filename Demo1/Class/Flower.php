<?php

abstract class Flower
{
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    abstract public function getDescription();

    public function __toString()
    {
        return "{$this->name} - Harga: Rp. {$this->price} - Jumlah: {$this->quantity}";
    }

    public function getPrice()
    {
        return $this->price * $this->quantity;
    }
}
