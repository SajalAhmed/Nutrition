<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserReviewRequest;
use App\Http\Resources\ReviewQuestionResource;
use App\Models\ReviewQuestion;
use App\Repository\UserReviewInterface;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    private $userReviewInterface="";

    public function __construct(UserReviewInterface $userReviewInterface) {
        $this->userReviewInterface = $userReviewInterface;
    }
    public function index()
    {
        $review_question=$this->userReviewInterface->getReviewQuestion();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Review Question'],
            'data'=>ReviewQuestionResource::collection($review_question)
        ],200);
    }

    public function add(UserReviewRequest $request)
    {
        $user_review=$this->userReviewInterface->create($request);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Review Add'],
            'data'=>null
        ],200);
    }
    public function checkUserReview()
    {
        $user_review=$this->userReviewInterface->checkUserReview();
        if($user_review==null)
        {
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message'=>['Review Not Exits'],
                'data'=>null
            ],200);
        }
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Review Exits'],
            'data'=>$user_review
        ],200);
    }
}
