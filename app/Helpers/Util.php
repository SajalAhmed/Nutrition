<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
/* role static id*/

define('SUPER_ADMIN', '1');
define('ADMIN', '2');

/* Permission */
define('ADD', 'can_add');
define('EDIT', 'can_edit');
define('VIEW', 'can_view');
define('DELETE', 'can_delete');
define('PUBLISH', 'can_publish');
if (!function_exists('logged_in_user_id')) {

    function logged_in_user_id()
    {
        $logged_in_id = 0;
        if (Auth::user()->id && Auth::user()->role->id) :
            $logged_in_id = Auth::user()->id;
        endif;
        return $logged_in_id;
    }
}
if (!function_exists('logged_in_name')) {

    function logged_in_name()
    {
        $logged_in_name = '';
        if (Auth::user()->id && Auth::user()->role->id) :
            if (logged_in_role_name() == 'Super Admin') :
                $logged_in_name = "Super Admin";
            else :
                $logged_in_name = Auth::user()->name;
            endif;
        endif;
        return $logged_in_name;
    }
}
if (!function_exists('logged_in_role_id')) {

    function logged_in_role_id()
    {
        $logged_in_role_id = 0;
        if (Auth::user()->role->id) :
            $logged_in_role_id = Auth::user()->role->id;
        endif;
        return $logged_in_role_id;
    }
}
if (!function_exists('logged_in_role_name')) {

    function logged_in_role_name()
    {
        $logged_in_role_name = '';
        if (Auth::user()->id && Auth::user()->role->id) :
            $logged_in_role_name = Auth::user()->role->name;
        endif;
        return $logged_in_role_name;
    }
}
if (!function_exists('is_admin')) {

    function is_admin()
    {
        if(logged_in_role_name()==="Admin")
        {
            return true;
        }
        return false;
    }
}
if (!function_exists('is_super_admin')) {

    function is_super_admin()
    {
        if(logged_in_role_name()==="Super Admin")
        {
            return true;
        }
        return false;
    }
}
if (!function_exists('textshorten')) {

    function textshorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        return $text = $text . " .....";
    }
}
if (!function_exists('hasPermission')) {

    function hasPermission($module, $permission)
    {
        $module = trim($module);

        $role_id = Auth::user()->role->id;

        $getrole = \App\Role::find($role_id);
        if ($getrole->name == "Super Admin") {
            return true;
        }
        $count = DB::table('permission_categories as PC')
            ->leftJoin('role_permissions as RP', 'PC.id', '=', 'RP.permission_category_id')
            ->where('PC.short_code', '=', $module)
            ->where('RP.role_id', '=', $role_id)
            ->where('RP.' . $permission, '=', 1)
            ->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('checkPermission')) {
    function checkPermission($module, $permission)
    {
        if (!hasPermission($module, $permission)) {
            setMessage("message", "warning", "Permission Denied!");
           return redirect()->route("dashboard");
        }
    }
}
if (!function_exists('hasActive')) {

    function hasActive($module)
    {
        $module = trim($module);
        $role_id = Auth::user()->role->id;
        $getrole = \App\Role::find($role_id);
        if ($getrole->name == "Super Admin") {
            return true;
        }
        $count = DB::table("permission_groups")
            ->where("short_code", "=", $module)
            ->where("is_active", "=", 1)
            ->first();
        if (isset($count)) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('setMessage')) {

    function setMessage($key, $class, $message)
    {
        session()->flash($key, $message);
        session()->flash("class", $class);
        // session()->flash($key,'<div class="alert alert-'.$class.'">'.$message.'</div>');
        return true;
    }
}
if (!function_exists('active_link')) {

    function set_Topmenu($top_menu_name)
    {
        $session_top_menu = session('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Submenu($sub_menu_name)
    {
        $session_sub_menu = session('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }
}
if (!function_exists('debug_r')) {

    function debug_r($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        die();
    }
}
if (!function_exists('debug_v')) {

    function debug_v($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }
}

if (!function_exists('e2b')) {

    function e2b($value)
    {
        $eng = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bang = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

        return str_replace($eng, $bang, $value);
    }
}
if (!function_exists('genderADC')) {

    function genderADC($value)
    {
        switch ($value) {
            case 'Male':
            case 'পুরুষ':
                return 1;
            case 'Female':
            case 'মহিলা':
                return 2;
            case 'Others':
            case 'অন্যান্য':
            default:
                return 3;
        }
    }
}
if (!function_exists('genderDAC')) {

    function genderDAE($value)
    {
        switch ($value) {
            case 1:
                return "Male";
            case 2:
                return 'Female';
            case 3:
                return 'Others';
            default:
                return 'Others';
        }
    }
}
if (!function_exists('genderDAC')) {

    function genderDAB($value)
    {
        switch ($value) {
            case 1:
                return "পুরুষ";
            case 2:
                return 'মহিলা';
            case 3:
                return 'অন্যান্য';

            default:
                return 'অন্যান্য';
        }
    }
}
