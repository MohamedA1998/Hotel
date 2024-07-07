<?php

namespace App\Services ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

// Handel All Input Name To (image) and (images) in multiImage
class ImageService
{
    private $width , $height , $image , $path;
    
    public function __construct(public Request $request){}

    public function size($width , $height)
    {
        $this->width = $width ;

        $this->height = $height ;

        return $this ;
    }

    protected function UploadTo()
    {
        $imageName = $this->path . '/' . hexdec(uniqid()).'.'.$this->image->guessExtension();

        Image::make($this->image)->resize( $this->width , $this->height )
                ->save(storage_path('app/public/').$imageName);

        return $imageName ;
    }
    
    public function save($storeIn):string
    {
        $iamgeArray = [];
        
        $this->path = $storeIn ;

        Storage::exists($storeIn) ?: Storage::createDirectory($storeIn);
        
        if( $this->request->hasFile('image') ){
            $this->image = $this->request->file('image');
            
            $iamgeArray[] = $this->UploadTo() ;
        }
        
        if(isset($this->request->images) && !empty($this->request->images)){
            foreach( $this->request->images as $image ){
                $this->image = $image;
                $iamgeArray[] = $this->UploadTo() ;
            }
        }

        return count($iamgeArray) == 1 ? $iamgeArray[0] : implode(',' , $iamgeArray) ?? '' ;
    }

    public function update(Model $model , $storeIn)
    {
        $images = '';

        if(empty($model->image)){
            $images = $this->save($storeIn);
        }

        if(!empty($model->image)){
            $images = explode(',', $model->image , 2);

            if( $this->request->hasFile('image') ){
                $this->delete($images[0]);
                $images[0] = $this->save($storeIn);
            }

            if(isset($this->request->images) && !empty($this->request->images)){
                foreach( $this->exceptFirst($model->image) as $image ){
                    $this->delete($image);
                }

                $images[1] = $this->save($storeIn);
            }

            $images = implode(',', $images);
        }

        $model->forceFill(['image' => $images])->save();

        return ;
    }

    public function delete($column)
    {
        $images = explode(',' , $column) ;

        if(is_array($images)){
            foreach($images as $image){
                Storage::delete($image);
            }

            return ;
        }

        Storage::delete($column);
    }

    public function deleteByIndex(Model $model , $index)
    {
        $images = explode(',',$model->image);

        $this->delete($images[$index]);

        unset($images[$index]);

        $model->forceFill(['image'=> implode(',', $images)])->save();
    }

    public function image($column , $dir = 'storage/'): Array|String
    {
        $images = array_map(
            fn($img) => Str::startsWith($img , 'https') ? $img : asset("{$dir}{$img}") ,
            explode(',', empty($column) ? 'no_image.jpg' : $column)
        );

        return count($images) == 1 ? $images[0]:  $images;
    }

    public function first($column):string
    {
        if(is_array($this->image($column))){
            return $this->image($column)[0];
        }

        return $this->image($column);
    }

    public function exceptFirst($column):array
    {
        if(is_array($this->image($column))){
            return array_slice($this->image($column) , 1,count($this->image($column))-1, true);
        }

        return [$this->image($column)];
    }

    public function last($column):string
    {
        if(is_array($this->image($column))){
            return $this->image($column)[-1];
        }

        return $this->image($column);
    }
}