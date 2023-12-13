<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CounterContract{
    public function increament(string $key,array $tags = null) : int;
}
