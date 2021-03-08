<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id")->index();
            $table->string("title_en");
            $table->string("title_bn");
            $table->integer("minute_en")->default(0);
            $table->string("minute_bn")->nullable();
            $table->string("zip_file_name")->nullable();
            $table->boolean("status")->default(false)->index();
            $table->softDeletes();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_modules');
    }
}
