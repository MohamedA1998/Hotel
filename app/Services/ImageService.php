<?php

namespace App\Services ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageService
{

    private $width , $height , $image , $path;

    public function __construct(public Request $request)
    {
        
    }    
    

    public function save(Model $model , $file , $storeIn)
    {
        if( !$this->request->hasFile($file) ){
            return ;
        }

        $this->image = $this->request->file($file);

        $this->path = $storeIn ;

        if( $model->images ){
            $this->DeleteFileFromStorage($model);

            $model->images->path = $this->ResizeImage() ;

            $model->images->save();
        }else{
            $model->images()->create([
                'path'  => $this->ResizeImage() 
            ]);
        }
    }


    public function size($width , $height )
    {
        $this->width = $width ;

        $this->height = $height ;

        return $this ;
    }


    protected function ResizeImage()
    {
        $imageName = $this->path . '/' . hexdec(uniqid()).'.'.$this->image->guessExtension();

        Image::make($this->image)->resize( $this->width , $this->height )
                ->save(storage_path('app/public/').$imageName);

        return $imageName ;
    }


    public function update(Model $model , $file , $storeIn)
    {
        return $this->save($model , $file , $storeIn);
    }


    public function delete(Model $model)
    {
        if( $model->images ){
            $this->DeleteFileFromStorage($model);

            return $model->images()->delete();
        }

        return ;
    }


    private function DeleteFileFromStorage(Model $model)
    {
        return Storage::delete($model->images->path) ;
    }

}