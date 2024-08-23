<?php namespace app\Console;
use Illuminate\Http\Client\Response;

interface Rates {

    public function exchangeRate($response);
}