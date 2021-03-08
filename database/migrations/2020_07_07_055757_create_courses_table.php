<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('picture')->nullable();
            $table->string('purpose_en')->nullable();
            $table->string('purpose_bn')->nullable();
            $table->string('method_en')->nullable();
            $table->string('method_bn')->nullable();
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->unique(['name_en', 'deleted_at']);
            $table->unique(['name_bn', 'deleted_at']);
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
        Schema::dropIfExists('courses');
    }
}
