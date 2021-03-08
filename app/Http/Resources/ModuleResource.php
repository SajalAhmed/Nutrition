<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use App\Http\Resources\SessionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(file_exists(storage_path()."/app/public/".$this->zip_file_name.'.zip')) {
            $file_size=(File::size(storage_path()."/app/public/".$this->zip_file_name.".zip") / 1024) / 1024;
            $file_size=sprintf('%.2f', $file_size);
        }else{
            $file_size=0;
        }
        if (App::isLocale('en')) {
            return [
                "id"=>$this->id,
                "title"=>$this->title_en,
                "minute"=>$this->minute_en,
                "file_url"=>asset("storage/".$this->zip_file_name."/index.html"),
                "download_file_url"=>asset("storage/".$this->zip_file_name.".zip"),
                "download_file_size"=>$file_size,
                "sessions"=>SessionResource::collection($this->sessions),
            ];
        }else{
            return [
                "id"=>$this->id,
                "title"=>$this->title_bn,
                "minute"=>$this->minute_bn,
                "file_url"=>asset("storage/".$this->zip_file_name."/index.html"),
                "download_file_url"=>asset("storage/".$this->zip_file_name.".zip"),
                "download_file_size"=>$file_size,
                "sessions"=>SessionResource::collection($this->sessions),
            ];
        }
    }
}
