<?php

namespace App\Repository\Eloquent;

use App\Repository\DashboardInterface;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardInterface
{
    private $data=array();
    public function getAnalytics($data)
    {
        $this->data['getRegisterUser']=$this->registerUserCount($data);
        $this->data['getTrainedUser']=$this->trainedUserCount($data);
        $this->data['quizTestPassUser']=$this->quizTestPassUserCount($data);
        $this->data['certificateDownloadUser']=$this->certificateDownloadUserCount($data);
        return $this->data;
    }
    public function registerUserCount($data)
    {
        $users=DB::table('register_users as RU')
            ->leftJoin("upazillas as U","RU.upazilla_id","=","U.id")
            ->join("districts as D","U.district_id","=","D.id")
            ->join("divisions as DV","D.division_id","=","DV.id")
            ->whereNull("RU.deleted_at")
            ->select("RU.*","D.name as district_name","DV.name as division_name","U.name as upazilla_name");

        if($data->upazilla_id)
        {
            $users=$users->where("U.id",$data->upazilla_id);
        }
        if($data->district_id)
        {
            $users=$users->where("D.id",$data->district_id);
        }
        if($data->division_id)
        {
            $users=$users->where("DV.id",$data->division_id);
        }
        return $users->count();

    }
    public function trainedUserCount($data)
    {
        $users=DB::table('register_users as RU')
            ->leftJoin("upazillas as U","RU.upazilla_id","=","U.id")
            ->join("enrolled_courses as EC","RU.id","=","EC.register_user_id")
            ->join("districts as D","U.district_id","=","D.id")
            ->join("divisions as DV","D.division_id","=","DV.id")
            ->whereNull("RU.deleted_at")
            ->select("RU.*","D.name as district_name","DV.name as division_name","U.name as upazilla_name");

        if($data->upazilla_id)
        {
            $users=$users->where("U.id",$data->upazilla_id);
        }
        if($data->district_id)
        {
            $users=$users->where("D.id",$data->district_id);
        }
        if($data->division_id)
        {
            $users=$users->where("DV.id",$data->division_id);
        }
        return $users->count();

    }
    public function quizTestPassUserCount($data)
    {
        $users=DB::table('register_users as RU')
            ->leftJoin("upazillas as U","RU.upazilla_id","=","U.id")
            ->join("quiz_results as QR","RU.id","=","QR.register_user_id")
            ->join("districts as D","U.district_id","=","D.id")
            ->join("divisions as DV","D.division_id","=","DV.id")
            ->whereNull("RU.deleted_at")
            ->where("QR.percentage",">=",80)
            ->select("RU.*","D.name as district_name","DV.name as division_name","U.name as upazilla_name");

        if($data->upazilla_id)
        {
            $users=$users->where("U.id",$data->upazilla_id);
        }
        if($data->district_id)
        {
            $users=$users->where("D.id",$data->district_id);
        }
        if($data->division_id)
        {
            $users=$users->where("DV.id",$data->division_id);
        }
        return $users->count();

    }
    public function certificateDownloadUserCount($data)
    {
        $users=DB::table('register_users as RU')
            ->leftJoin("upazillas as U","RU.upazilla_id","=","U.id")
            ->join("certificate_downloads as CD","RU.id","=","CD.register_user_id")
            ->join("districts as D","U.district_id","=","D.id")
            ->join("divisions as DV","D.division_id","=","DV.id")
            ->whereNull("RU.deleted_at")
            ->select("RU.*","D.name as district_name","DV.name as division_name","U.name as upazilla_name");

        if($data->upazilla_id)
        {
            $users=$users->where("U.id",$data->upazilla_id);
        }
        if($data->district_id)
        {
            $users=$users->where("D.id",$data->district_id);
        }
        if($data->division_id)
        {
            $users=$users->where("DV.id",$data->division_id);
        }
        return $users->count();

    }
}
