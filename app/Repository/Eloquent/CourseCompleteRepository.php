<?php


namespace App\Repository\Eloquent;


use App\Repository\CourseCompleteInterFace;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CourseCompleteRepository implements CourseCompleteInterFace
{

    public function datatableView($data)
    {
        ini_set('memory_limit', '-1');
        $users=DB::table('register_users as RU')
            ->leftJoin("enrolled_courses as EC","RU.id","=","EC.register_user_id")
            ->leftJoin("quiz_results as QR","EC.register_user_id","=","QR.register_user_id")
            ->leftJoin("designations as DG","RU.designation_id","=","DG.id")
            ->leftJoin("upazillas as U","RU.upazilla_id","=","U.id")
            ->join("districts as D","U.district_id","=","D.id")
            ->join("divisions as DV","D.division_id","=","DV.id")
            ->whereNull("RU.deleted_at")
            ->orderBy("QR.id","desc")
            ->select("RU.*","D.name as district_name","DV.name as division_name","U.name as upazilla_name",'QR.created_at as course_complete_date','EC.created_at as start_date','DG.name_en as designation');

        if($data->upazilla_id && $data->upazilla_id!="null")
        {
            $users=$users->where("U.id",$data->upazilla_id);
        }
        if($data->district_id && $data->district_id!="null")
        {
            $users=$users->where("D.id",$data->district_id);
        }
        if($data->division_id && $data->division_id!="null")
        {
            $users=$users->where("DV.id",$data->division_id);
        }
        if($data->designation_id && $data->designation_id!="null")
        {
            $users=$users->where("RU.designation_id",$data->designation_id);
        }
        if($data->month && $data->month!="null")
        {
            $users=$users->whereMonth("QR.created_at",$data->month);
        }
        if($data->year && $data->year!="null")
        {
            $users=$users->whereYear("QR.created_at",$data->year);
        }
        if($data->from_date && $data->to_date)
        {
            $users=$users->whereDate("QR.created_at",">=",date("Y-m-d",strtotime($data->from_date)));
            $users=$users->whereDate("QR.created_at","<=",date("Y-m-d",strtotime($data->to_date)));
        }
        $register_user=$users->get();
        $table= DataTables::of($register_user)
             ->addIndexColumn()
            ->addColumn('details', function ($register_user) {
                return '<button class="btn btn-primary waves-effect waves-light details" data-toggle="modal" data-id="'.$register_user->id.'" data-target="#con-close-modal"><i class="mdi mdi-format-list-bulleted-triangle"></i></button>';
            })
            ->addColumn('registration_date', function ($register_user) {
                return date("d-m-Y",strtotime($register_user->created_at));
            })
            ->addColumn('start_date', function ($register_user) {
                return $register_user->start_date?date("d-m-Y",strtotime($register_user->start_date)):"";
            })
            ->addColumn('course_complete_date', function ($register_user) {
                return $register_user->course_complete_date?date("d-m-Y",strtotime($register_user->course_complete_date)):"";
            })
            ->addColumn('designation', function ($register_user) {
                return $register_user->designation=="Other"?$register_user->designation_other:$register_user->designation;
            })
            ->addColumn('division_name', function ($register_user) {
                return $register_user->division_name;
            })
            ->addColumn('district_name', function ($register_user) {
                return $register_user->district_name;
            })
            ->addColumn('upazilla_name', function ($register_user) {
                return $register_user->upazilla_name;
            })
            ->editColumn('created_at', function ($register_user) {
                return date("d-m-Y h:i A",strtotime($register_user->created_at));
            });

        $table=$table->rawColumns(['details'])
            ->make(true);

        return $table;
    }
}
