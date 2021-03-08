<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DivisionResource;
use App\Repository\RegisterUserInterface;
use App\Http\Resources\AffiliatedResource;
use App\Http\Resources\DesignationResource;
use App\Http\Resources\UserRegisterResource;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserRegistrationWeb;

class RegisterUserController extends Controller
{
    private $registerUserRepository="";

    public function __construct(RegisterUserInterface $registerUserRepository) {
        $this->registerUserRepository = $registerUserRepository;
    }

    public function getDivision()
    {
        $divisions=$this->registerUserRepository->getDivision();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Divisions'],
            'data'=>DivisionResource::collection($divisions)
        ],200);
    }
    public function getAffiliteds()
    {
        $affiliteds=$this->registerUserRepository->getAffiliteds();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Affiliated'],
            'data'=>AffiliatedResource::collection($affiliteds)
        ],200);
    }
    public function getDesignation()
    {
        $getdesignation=$this->registerUserRepository->getDesignation();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Designation'],
            'data'=>DesignationResource::collection($getdesignation)
        ],200);
    }
    public function singleUser()
    {
        $user=$this->registerUserRepository->findById(Auth::id());
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['User Profile'],
            'data'=>new UserRegisterResource($user)
        ],200);
    }
    public function add(UserRegistrationRequest $request)
    {
        $user=$this->registerUserRepository->create($request);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'token'=>$token,
            'message'=>['New User'],
            'data'=>new UserRegisterResource($user)
        ],200);
    }
    public function update(UserRegistrationRequest $request)
    {
        $user=$this->registerUserRepository->update($request,Auth::id());
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Update User'],
            'data'=>new UserRegisterResource($user)
        ],200);
    }
    
     public function addWeb(UserRegistrationWeb $request)
    {
        $user=$this->registerUserRepository->create($request);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'token'=>$token,
            'message'=>['New User'],
            'data'=>new UserRegisterResource($user)
        ],200);
    }
    public function updateWeb(UserRegistrationWeb $request)
    {
        $user=$this->registerUserRepository->update($request,Auth::id());
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Update User'],
            'data'=>new UserRegisterResource($user)
        ],200);
    }

    public function login(LoginRequest $request)
    {
        $token=$this->registerUserRepository->login($request);
        if($token)
        {
            return response()->json([
                'status'=>true,
                'code'=>200,
                'token'=>$token,
                'message'=>['Login Successfully'],
                'data'=> new UserRegisterResource($this->guard()->user())
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'code'=>404,
                'token'=>$token,
                'message'=>['Email Or Password Invalid'],
                'data'=> null
            ],200);
        }
    }

    public function passwordChange(PasswordRequest $request)
    {
        $user=$this->registerUserRepository->passwordChange($request,Auth::id());
        if($user)
        {
            return response()->json([
                'status'=>true,
                'code'=>200,
                'message'=>['Password Changed Successfully'],
                'data'=>new UserRegisterResource($user)
            ],200);
        }
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Successfully logged out'],
            'data'=> null
        ],200);
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
