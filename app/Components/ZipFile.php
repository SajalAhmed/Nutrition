<?php

namespace App\Components;

use App\Interfaces\FileInterface;
use ZipArchive;
use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class ZipFile implements FileInterface
{
    private $request='';
    function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function upload()
    {
        ini_set('max_execution_time', 3000);

        $folder_name="";
        $file_info = $this->request->file("zip_file_name");
        $file_name = time() . "C_".$this->request->course_id;
        $zip_file_name = $file_name.'.'. $file_info->getClientOriginalExtension();
        $this->request->file("zip_file_name")->storeAs("public/module",$zip_file_name);
        $zip = new ZipArchive;
        $path =storage_path("app/public/module/". $file_name);
        $res = $zip->open($this->request->file("zip_file_name"));
        if ($res === TRUE) {
            // extract it to the path we determined above
            $zip->extractTo($path);
            $folder_name=$file_name;
            $zip->close();
        }
        return $folder_name;
    }
    public function download($data)
    {
        // $files=array();
        // foreach ($data as $key => $file_name) {
        //     $files[]=storage_path("app/public/").$file_name->zip_file_name.".zip";
        // }
        // $zipname = 'file.zip';
        // $zip = new ZipArchive;
        // $zip->open($zipname, ZipArchive::CREATE);
        // foreach ($files as $file) {
        // $zip->addFile($file);
        // }
        // $zip->close();
        // header('Content-Type: application/zip');
        // header('Content-disposition: attachment; filename='.$zipname);
        // header('Content-Length: ' . filesize($zipname));
        // readfile($zipname);
    }
    public function generate($data)
    {
    }
}
