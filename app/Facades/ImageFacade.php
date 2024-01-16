<?php

namespace App\Facades ;

use App\Services\ImageService;
use Illuminate\Support\Facades\Facade;

class ImageFacade extends Facade {
    
    /**
     * 
     * @method SaveImageAs(Model $model , $file , $storeIn)
     */
    protected static function getFacadeAccessor()
    {
        return ImageService::class ;
    }

}