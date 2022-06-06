<?php

namespace App\Services\Contracts;
use Illuminate\Http\Request;

interface ValutesInfoServiceInterface
{
    public function takeXml($date);
}
