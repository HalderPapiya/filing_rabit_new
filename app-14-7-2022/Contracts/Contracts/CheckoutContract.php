<?php

namespace App\Contracts;

interface CheckoutContract
{
    public function viewCart();
    public function addressData();
    public function create(array $data);
}