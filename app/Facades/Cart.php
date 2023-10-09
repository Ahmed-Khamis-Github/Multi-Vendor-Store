<?php
namespace App\Facades ;

use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Facade;

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    class Cart extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return CartRepository::class;
        }
    }

    ?>