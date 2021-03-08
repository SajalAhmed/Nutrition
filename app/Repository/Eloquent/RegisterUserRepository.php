<?php

namespace App\Repository\Eloquent;

use JWTAuth;
use App\Models\Division;
use App\Models\Affiliated;
use App\Models\Designation;
use App\Models\RegisterUser;
use App\Traits\ActionColumn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\VerificationMailEvent;
use App\Repository\EloquentInterface;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\RegisterUserInterface;

class RegisterUserRepository implements EloquentInterface,RegisterUserInterface
{
    use ActionColumn;
    public function all(){
        return RegisterUser::with("designation",'affiliated','upazilla')->latest()->get();
    }

    public function create($data){
        $user= RegisterUser::create([
            'name'=>$data->name,
            'email'=>$data->email,
            'phone_number'=>$data->phone_number,
            'affiliated_id'=>$data->affiliated_id,
            'gender'=>genderADC($data->gender),
            'organization'=>$data->organization,
            'designation_id'=>$data->designation_id,
            'designation_other'=>$data->designation_other,
            'age'=>$data->age,
            'password'=>Hash::make($data->password),
            'upazilla_id'=>$data->upazilla_id,
        ]);
        return $user;
    }

    public function findById($id){
        return RegisterUser::with("designation",'affiliated','upazilla','quiz')->findOrFail($id);
    }

    public function update($data, $id){
        $user=$this->findById($id);
        $user->name=$data->name;
        $user->email=$data->email;
        $user->phone_number=$data->phone_number;
        $user->affiliated_id=$data->affiliated_id;
        $user->gender=genderADC($data->gender);
        $user->organization=$data->organization;
        $user->designation_id=$data->designation_id;
        $user->designation_other=$data->designation_other;
        $user->age=$data->age;
        $user->upazilla_id=$data->upazilla_id;
        $user->save();
        return $user;
    }

    public function control($id){
        $user = $this->findById($id);
        $user->status=!$user->status;
        setMessage("message",'success',"Status Changed Successfully");
        return $user->save();
    }

    public function delete($id){
        $user = $this->findById($id);
        setMessage("message",'success',"User Delete Successfully");
        return $user->delete();
    }

    public function activeUser($email,$code){
    }

    public function login($data)
    {
        $credentials = request(['email', 'password']);
        $active = array("status" => 1);
        $credentials = array_merge($credentials, $active);
        return Auth::guard('api')->attempt($credentials);
    }

    public function passwordChange($data,$id)
    {
        $user=$this->findById($id);
        $user->password=Hash::make($data->password);
        $user->save();
        return $user;
    }

    public function getDivision()
    {
        return Cache::rememberForever('division', function () {
            return Division::with("districts")->orderBy("name","ASC")->get();
        });
    }

    public function getOnlyDivision()
    {
        return DB::table('divisions')->orderBy("name","ASC")->get();
    }
    public function getOnlyDistrict($division_id)
    {
        return DB::table('districts')->where("division_id",$division_id)->orderBy("name","ASC")->get();
    }
    public function getOnlyUpazilla($district_id)
    {
        return DB::table('upazillas')->where("district_id",$district_id)->orderBy("name","ASC")->get();
    }
    public function getAffiliteds()
    {
        return Cache::rememberForever('affiliteds', function () {
            return Affiliated::where("status",1)->get();
        });
    }
    public function getDesignation()
    {
       return Cache::rememberForever('designation', function () {
            return Designation::orderBy("position","asc")->where("status",1)->get();
        });
    }
    public function getAllDesignation()
    {
       return Cache::rememberForever('allDesignation', function () {
            return Designation::orderBy("position","asc")->get();
        });
    }
    public function datatableViewRegisterUser($data)
    {
        ini_set('memory_limit', '-1');
        $users=DB::table('register_users as RU')
            ->leftJoin("upazillas as U","RU.upazilla_id","=","U.id")
            ->join("districts as D","U.district_id","=","D.id")
            ->join("divisions as DV","D.division_id","=","DV.id")
            ->whereNull("RU.deleted_at")
            ->orderBy("id","desc")
            ->select("RU.*","D.name as district_name","DV.name as division_name","U.name as upazilla_name");

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
        $register_user=$users->get();
        $table= DataTables::of($register_user)
            ->addColumn('details', function ($register_user) {
                return '<button class="btn btn-primary waves-effect waves-light details" data-toggle="modal" data-id="'.$register_user->id.'" data-target="#con-close-modal"><i class="mdi mdi-format-list-bulleted-triangle"></i></button>';
            })
            ->editColumn('created_at', function ($register_user) {
                return date("d-m-Y h:i A",strtotime($register_user->created_at));
            });
        if(is_super_admin()){
            $table=$table->addColumn('action', function ($register_user) {
                    return $this->registerUserAction($register_user,"Super Admin");
                });
        }else if(hasPermission("register_users",PUBLISH)){
            $table=$table->addColumn('action', function ($register_user) {
                return $this->registerUserAction($register_user,"");
            });
        }

        $table=$table->rawColumns(['details','action'])
            ->make(true);

        return $table;
    }
}
