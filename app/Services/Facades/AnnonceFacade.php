<?php

namespace App\Services\Facades;

use App\Services\AnnonceService;
use Illuminate\Support\Facades\Facade;

class AnnonceFacade extends Facade
{
    /**
     * Returning service name
     *
     * @return string
     */

     protected static function getFacadeAccessor()
     {
        return AnnonceService::class;
     }

}