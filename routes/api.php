<?php

use App\Models\RegisterUser;
use Illuminate\Http\Request;
use App\Components\Certificate;
use App\Components\ZipFile;
use App\Models\CourseModule;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['localization','xss'],'namespace' => 'API'], function () {

    Route::get('app-version', 'AppVersionController@index');
    Route::get('getcourse', 'CourseController@getCourse');
    Route::get('getdivison', 'RegisterUserController@getDivision');
    Route::get('affilateds', 'RegisterUserController@getAffiliteds')->name("affilateds");
    Route::get('designation', 'RegisterUserController@getDesignation')->name("designation");
    Route::post('registration', 'RegisterUserController@add')->name("registration");
    Route::post('registration-web', 'RegisterUserController@addWeb')->name("registrationWeb");
    Route::post('security-login', 'RegisterUserController@login')->name("security-login");
    Route::post('password-reset', 'PasswordResetController@create')->name("password-reset");
    Route::get('password-find/{token}', 'PasswordResetController@find')->name("password-find");
    Route::post('forgot-password-change', 'PasswordResetController@reset')->name("forgot-password-change");

    Route::get('search-course', 'CourseController@searchCourse')->name("search-course");
    Route::get('get-course-file', 'CourseController@get_course_file')->name("get-course-file");

});
Route::group(['middleware' => ['auth:api','localization','xss'],'namespace' => 'API'], function () {
    Route::post('security-logout', 'RegisterUserController@logout')->name("security-logout");
    Route::post('password-change', 'RegisterUserController@passwordChange')->name("password-change");
    Route::put('update-user', 'RegisterUserController@update')->name("update-user");
    Route::put('update-user-web', 'RegisterUserController@updateWeb')->name("update-user-web");
    Route::get('single-user', 'RegisterUserController@singleUser')->name("single-user");

    Route::get('get-course-module', 'CourseController@getCourseDetailsWithModule')->name("get-course-module");
    Route::post('course-enrolled', 'CourseController@enrolledCourse')->name("course-enrolled");
    Route::get('get-my-course', 'CourseController@getMyCourseDetailsWithModule')->name("get-my-course");

    Route::post('quiz-result-submit', 'QuizController@add')->name("quiz-result-submit");

    Route::post('module-progress-add', 'ModuleProgressController@add')->name("module-progress-add");

    Route::get('review-question', 'UserReviewController@index')->name("review-question");

    Route::post('user-review-submit', 'UserReviewController@add')->name("user-review-submit");

    Route::get('check-review', 'UserReviewController@checkUserReview')->name("check-review");


    Route::get('certificate-img', 'QuizController@certificate')->name("certificate-img");
    Route::get('certificate-check', 'QuizController@certificateCheck')->name("certificate-check");

});
Route::get('download',function(Request $request){
    $data=CourseModule::where("course_id",1)->get();
    // $data=array();
    $zip=new ZipFile($request);
    $zip->download($data);


});
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found'
    ], 404);
});
