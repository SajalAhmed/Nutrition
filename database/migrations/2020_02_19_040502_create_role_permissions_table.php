<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role_id")->index();
            $table->unsignedBigInteger("permission_category_id")->index();
            $table->boolean("can_view")->default(0);
            $table->boolean("can_add")->default(0);
            $table->boolean("can_edit")->default(0);
            $table->boolean("can_delete")->default(0);
            $table->boolean("can_publish")->default(0);
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
        Schema::dropIfExists('role_permissions');
    }
}
