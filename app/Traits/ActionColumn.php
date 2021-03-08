<?php

namespace App\Traits;

trait ActionColumn
{
    public function courseModuleAction($model)
    {
        $url=url("");
        $return = [];
        if(hasPermission("course_module",EDIT)):
            $return["edit"] = <<<HTML
                <a  href="{$url}/admin/course-module/edit?course_module_id={$model->id}"  class="text-white btn btn-primary btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id=""><i class="fa fa-edit"></i></a>

HTML;
        endif;
        if(hasPermission("course_module",PUBLISH)):
            if($model->status==1):
                $return["publish"] = <<<HTML
                <a onclick="return confirm('Are You Sure?')" href="{$url}/admin/course-module/control?course_module_id={$model->id}" title="Enable" class="btn btn-success   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
HTML;
            else:
                $return["publish"] = <<<HTML
                <a onclick="return confirm('Are You Sure?')" href="{$url}/admin/course-module/control?course_module_id={$model->id}" title="Disable" class="btn btn-danger   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
HTML;
            endif;
        endif;
        if(is_super_admin()):
        $return["delete"] = <<<HTML
            <a onclick="return confirm('Are You Sure?')" href="{$url}/admin/course-module/delete?course_module_id={$model->id}" title="Delete" class="btn btn-danger  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
HTML;
        endif;

        return implode('', $return);
    }
    public function registerUserAction($model,$type)
    {
         $url=url("");
        $return = [];
            if($model->status==1):
                $return["publish"] = <<<HTML
                <a onclick="return confirm('Are You Sure?')" href="{$url}/admin/register-user/control?user_id={$model->id}" title="Enable" class="btn btn-success   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
HTML;
            else:
                $return["publish"] = <<<HTML
                <a onclick="return confirm('Are You Sure?')" href="{$url}/admin/register-user/control?user_id={$model->id}" title="Disable" class="btn btn-danger   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
HTML;
            endif;
        if($type=="Super Admin"):
        $return["delete"] = <<<HTML
            <a onclick="return confirm('Are You Sure?')" href="{$url}/admin/register-user/delete?user_id={$model->id}" title="Delete" class="btn btn-danger  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
HTML;
        endif;

        return implode('', $return);
    }
}
