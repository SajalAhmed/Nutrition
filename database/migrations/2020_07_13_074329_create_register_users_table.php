<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_users', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("phone_number");
            $table->unsignedBigInteger("affiliated_id");
            $table->enum("gender",['1','2','3','4','5','6']);
            $table->string("organization");
            $table->unsignedBigInteger("designation_id");
            $table->string("age");
            $table->string("password");
            $table->boolean("status")->default(true);
            $table->unsignedBigInteger("upazilla_id")->index();
            $table->softDeletes();
            $table->unique(['email','deleted_at']);
            $table->unique(['phone_number','deleted_at']);
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
        Schema::dropIfExists('register_users');
    }
}
