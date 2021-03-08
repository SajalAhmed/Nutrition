<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("register_user_id")->index();
            $table->unsignedBigInteger("course_module_id")->index();
            $table->integer("complete_percent")->default(0);
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
        Schema::dropIfExists('module_progress');
    }
}
