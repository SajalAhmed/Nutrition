<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//   return redirect()->to('https://adolescent.nnsop.org/public/web');
// });
Route::get('/', function () {
    return redirect()->route("login");
});

Auth::routes(['register' => false]);

//available for all
Route::group(['middleware' => ['auth','prevent-back-history','xss']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/get-analytics', 'DashboardController@getAnalytics')->name('getAnalytics');
    Route::get('/password-change', 'PasswordController@index')->name('password_change');
    Route::post('/password-change', 'PasswordController@changePassword')->name('password_change');
});
//permission route
Route::group(['middleware' => ['auth','prevent-back-history','xss'], 'namespace' => 'Permission'], function () {

    Route::get('/role-permission', 'RoleController@index')->name("role");
    Route::post('/role', 'RoleController@store');
    Route::get('/role/edit/{role_id}', 'RoleController@edit');
    Route::get('/role/delete/{role_id}', 'RoleController@delete');
    Route::get('/assign-permission/{role_id}', 'RoleController@assignPermission');
    Route::post('/assign-permission/{role_id}', 'RoleController@assignPermission');

    Route::get('/module', 'ModuleController@index')->name("module");
    Route::post('/module/add_parent', 'ModuleController@add_parent');
    Route::get('/module/get_subparent', 'ModuleController@get_subparent');
    Route::post('/module/add', 'ModuleController@add');
    Route::post('/module/control', 'ModuleController@control');
    Route::get('/module/edit/{id?}/{cat_id?}/{msg?}', 'ModuleController@edit');
    Route::post('/module/edit/{id?}/{cat_id?}/{msg?}', 'ModuleController@edit');
    Route::get('/module/delete/{id?}/{cat_id?}/{msg?}', 'ModuleController@delete');
    Route::post('/module/moduleUpdate/', 'ModuleController@moduleUpdate');

    Route::get('/users', 'UserController@index')->name("users");
    Route::get('/users/view', 'UserController@view');
    Route::post('/users', 'UserController@add');
    Route::get('/user/control/{user_id}', 'UserController@control');
    Route::get('/user/user-edit/{user_id}', 'UserController@userEdit');
    Route::post('/user/edit/{user_id}', 'UserController@userUpdate');
});

//admin route
Route::group(['middleware' => ['auth','prevent-back-history','xss'], 'namespace' => 'Admin', "prefix" => "admin", "as" => "admin."], function () {

    Route::get('/course', 'CourseController@index')->name("course");
    Route::post('/course', 'CourseController@add')->name("course");
    Route::get('/course/edit', 'CourseController@edit')->name("courseEdit");
    Route::put('/course/update', 'CourseController@update')->name("courseUpdate");
    Route::get('/course/control', 'CourseController@control')->name("courseControl");
    Route::get('/course/delete', 'CourseController@delete')->name("courseDelete");
    Route::get('/course/details', 'CourseController@details')->name("coursedetails");
    Route::get('/course-complete', 'CourseCompleteReport@index')->name("courseComplete");
    Route::get('/course-complete/view', 'CourseCompleteReport@view')->name("courseCompleteUserView");
    Route::get('/course-complete/details', 'CourseCompleteReport@details')->name("completeRegisterUserDetails");

    Route::get('/course-module', 'CourseModuleController@index')->name("courseModule");
    Route::post('/course-module', 'CourseModuleController@add')->name("courseModule");
    Route::get('/course-module-view', 'CourseModuleController@view')->name("courseModuleView");
    Route::get('/course-module/edit', 'CourseModuleController@edit')->name("courseModuleEdit");
    Route::post('/course-module/update', 'CourseModuleController@update')->name("courseModuleUpdate");
    Route::get('/course-module/control', 'CourseModuleController@control')->name("courseModuleControl");
    Route::get('/course-module/delete', 'CourseModuleController@delete')->name("courseModuleDelete");
    Route::get('/course-module/details', 'CourseModuleController@details')->name("courseModuledetails");


    Route::get('/register-user', 'RegisterUserController@index')->name("registerUser");
    Route::get('/register-user/details', 'RegisterUserController@details')->name("registerUserDetails");
    Route::get('/register-user/view', 'RegisterUserController@view')->name("registerUserView");
    Route::get('/register-user/control', 'RegisterUserController@control')->name("registerUserControl");
    Route::get('/register-user/delete', 'RegisterUserController@delete')->name("registerUserDelete");


    Route::get('/dstrict-by-id', 'RegisterUserController@getOnlyDistrict')->name("districtById");
    Route::get('/upazilla-by-id', 'RegisterUserController@getOnlyUpazilla')->name("upzillaById");

    Route::get('/app-version', 'AppVersionController@index')->name("appVersion");
    Route::post('/app-version', 'AppVersionController@add')->name("appVersion");


});
 Route::get('/filesize',function(){
      $file_size=(File::size(storage_path()."/app/public/course/1600085862C.zip") / 1024) / 1024;
             $file_size=sprintf('%.2f', $file_size);
        if(file_exists(storage_path()."/app/public/course/1600085862C.zip")) {
            $file_size=(File::size(storage_path()."/app/public/course/1600085862C.zip") / 1024) / 1024;
             $file_size=sprintf('%.2f', $file_size);
        }else{
            $file_size=0;
        }
             echo $file_size;
 });
