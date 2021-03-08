<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_module_id")->index();
            $table->string("title_en");
            $table->string("title_bn");
            $table->boolean("status")->default(false)->index();
            $table->softDeletes();
            $table->unique(['title_en','course_module_id','deleted_at']);
            $table->unique(['title_bn','course_module_id','deleted_at']);
            $table->foreign('course_module_id')->references('id')->on('course_modules');
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
        Schema::dropIfExists('module_sessions');
    }
}
