<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admin_role', function(Blueprint $table) {
            $table->increments('id');
            $table->string('admin_role_description', 191)->nullable();
            $table->string('admin_role_slug', 191);
            $table->timestamps();
        });

        Schema::create('admin_permission', function(Blueprint $table) {
            $table->increments('id');
            $table->string('admin_permission_description', 191)->nullable();
            $table->string('admin_permission_slug', 191);
            $table->boolean('status')->default(0)->comment('0 = No, 1 = Yes');
            $table->timestamps();
        });

        Schema::table('admins', function(Blueprint $table) {
            $table->integer('admin_role_id')->unsigned()->nullable();
            $table->foreign('admin_role_id')->references('id')->on('admin_role');
        });

        Schema::table('admin_permission', function(Blueprint $table) {
            $table->integer('admin_role_id')->unsigned()->nullable();
            $table->foreign('admin_role_id')->references('id')->on('admin_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admin_role');
        Schema::dropIfExists('admin_permission');

        Schema::table('admins', function(Blueprint $table) {
            $table->dropColumn('admin_role_id');
        });
        Schema::table('admin_permission', function(Blueprint $table) {
            $table->dropColumn('admin_role_id');
        });
    }

}
