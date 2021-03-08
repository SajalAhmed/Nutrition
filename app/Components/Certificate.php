<?php

namespace App\Components;
use App\Interfaces\UploadInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class Certificate implements UploadInterface
{
    public function upload(){}

    public function download($data){
        // if (App::isLocale('en')) {
        //     $name = $data->user->name;
        //     $designation = $data->user->designation->name_en;
        //     $address =$data->user->affiliated->name_en.",". $data->user->upazilla->name.",".$data->user->upazilla->district->name.",".$data->user->upazilla->district->division->name;
        //     $date =date("d F Y",strtotime($data->created_at));
        //     $lang = "en";
        //     $font=public_path("certificate/template/times.ttf");
        // }
        // else{

        // }
        $name = $data->user->name;
        $designation = $data->user->designation->name_en=="Other" ? $data->user->designation_other:$data->user->designation->name_bn;
        $address = $data->user->affiliated->name_bn.", ". $data->user->upazilla->bn_name.", ".$data->user->upazilla->district->bn_name.", ".$data->user->upazilla->district->division->bn_name;
        $date = e2b(date("d F Y",strtotime($data->created_at)))." ইং";
        $lang = "bn";
        $font=public_path("certificate/template/kalpurush.ttf");
        $image_name=time().'_'.Auth::id();

        if($data->download== "true"){
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$name.".jpg".'"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
        }
        $path=public_path("certificate/template/certificate_$lang.jpg");


        $w_file = public_path("certificate_image/".Str::random(6) . "_" . $image_name . ".png");
        $x_file = public_path("certificate_image/".Str::random(6) . "_" . $image_name . ".png");
        $y_file = public_path("certificate_image/".Str::random(6) . "_" . $image_name.  ".jpg");
        $z_file = public_path("certificate_image/".Str::random(6) . "_" . $image_name.  ".jpg");

        $img_path = public_path("certificate/template/certificate_$lang.jpg");


        $bn_text_0 = "<span size='50000'>   ".$name."</span>\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

        $bn_text_1 = "\n\n" . "<span size='24000'>     ".$designation."</span>";
        $bn_text_1 .= "\n" . "<span size='18000'>     ".$address."</span>";
        $bn_text_1 .= "\n\n\n\n\n\n\n\n" . "<span size='24000'>     ".$date."</span>\n\n\n\n\n\n\n\n\n\n";

        exec("convert -gravity center pango:\"".$bn_text_0."\" -transparent white ".$w_file);
        exec("convert -gravity center pango:\"".$bn_text_1."\" -transparent white ".$x_file);
        exec("convert ".$img_path." ".$w_file." -gravity center -composite -matte ".$y_file);
        exec("convert ".$y_file." ".$x_file." -gravity center -composite -matte ".$z_file);


        // $bn_text = ".\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n<span size='50000'>".$name."</span>";
        // $bn_text .= "\n\n" . "<span size='24000'>".$designation."</span>";
        // $bn_text .= "\n" . "<span size='18000'>".$address."</span>";
        // $bn_text .= "\n\n\n\n\n\n\n\n" . "<span size='24000'>".$date."</span>";

        // exec("convert -gravity center pango:\"".$bn_text."\" -transparent white ".$x_file);
        // exec("convert ".$img_path." ".$x_file." -gravity north -composite -matte ".$y_file);

        header('Content-Type: image/jpg');
        $image = file_get_contents($z_file);
        unlink($w_file);
        unlink($x_file);
        unlink($y_file);
        unlink($z_file);
        return $image;

    }
}
