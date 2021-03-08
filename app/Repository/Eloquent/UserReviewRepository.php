<?php

namespace App\Repository\Eloquent;

use App\Models\ReviewQuestion;
use App\Models\UserReview;
use App\Repository\EloquentInterface;
use App\Repository\UserReviewInterface;
use Illuminate\Support\Facades\Auth;

class UserReviewRepository implements EloquentInterface,UserReviewInterface
{
    public function all(){}

    public function create($data){
        $insert_data=[];
        foreach($data->review_question_answer_id as $key=>$value)
        {
            $insert_data[$key]['review_question_answer_id']=$value;
            $insert_data[$key]['created_at']=date("Y-m-d H:i:s");
            $insert_data[$key]['updated_at']=date("Y-m-d H:i:s");
            $insert_data[$key]['register_user_id']=Auth::id();
        }
        return UserReview::insert($insert_data);
    }

    public function findById($id){}

    public function update($data, $id){}

    public function control($id){}

    public function delete($id){}

    public function getReviewQuestion()
    {
        return ReviewQuestion::with('answers')->get();
    }
    public function checkUserReview()
    {
        return UserReview::where("register_user_id",Auth::id())->first();
    }
}
