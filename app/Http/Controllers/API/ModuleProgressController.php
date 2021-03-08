<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleProgressRequest;
use App\Repository\ModuleProgressInterface;
use Illuminate\Http\Request;

class ModuleProgressController extends Controller
{
    private $moduleProgressRepository="";

    public function __construct(ModuleProgressInterface $moduleProgressRepository) {
        $this->moduleProgressRepository = $moduleProgressRepository;
    }

    public function add(ModuleProgressRequest $request)
    {
        $moduleProgess=$this->moduleProgressRepository->create($request);
        if($moduleProgess==null)
        {
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message'=>['Need Module Not Quiz'],
                'data'=>null
            ],200);
        }
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Module Progress Add'],
            'data'=>$moduleProgess
        ],200);
    }
}
