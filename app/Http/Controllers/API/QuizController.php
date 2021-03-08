<?php

namespace App\Http\Controllers\API;

use App\Components\Certificate;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Http\Resources\QuizResource;
use App\Repository\QuizRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    private $quizRepository="";

    public function __construct(QuizRepositoryInterface $quizRepository) {
        $this->quizRepository = $quizRepository;
    }

   public function add(QuizRequest $request)
   {
         $quiz_result=$this->quizRepository->create($request);
         if($quiz_result){
            return response()->json([
                'status'=>true,
                'code'=>200,
                'message'=>['Quiz Result'],
                'data'=>new QuizResource($quiz_result)
            ],200);
         }

        return response()->json([
            'status'=>false,
            'code'=>404,
            'message'=>['Need quiz'],
            'data'=>null
        ],200);
   }
   public function certificate()
   {
       $data['course_id']=request()->input("course_id");
       $data['download']=request()->input("download");
       $quiz_result=$this->quizRepository->certificate($data);
       if($quiz_result==null)
       {
        return null;
       }
       if($quiz_result=="fail")
       {
        return null;
       }
       echo $quiz_result;
   }
   public function certificateCheck()
   {
       $data['course_id']=request()->input("course_id");
       $data['download']=request()->input("download");
       $quiz_result=$this->quizRepository->certificateCheck($data);
       if($quiz_result==null)
       {
        return response()->json([
            'status'=>false,
            'code'=>404,
            'message'=>['Not Valid'],
            'data'=>null
        ],200);
       }
       if($quiz_result=="fail")
       {
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message'=>['Fails'],
                'data'=>null
            ],200);
       }
       return response()->json([
        'status'=>true,
        'code'=>200,
        'message'=>['Valid'],
        'data'=>[
            "id"=>$quiz_result->id,
            "register_user_id"=>$quiz_result->register_user_id,
            "course_module_id"=>$quiz_result->course_module_id,
            "gain_point"=>$quiz_result->gain_point,
            "percentage"=>$quiz_result->percentage,
        ]
    ],200);
   }
}
