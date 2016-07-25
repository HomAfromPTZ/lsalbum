<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar',255)->after('password');
            $table->string('background',255)->after('avatar');
            $table->text('description')->after('background');
            $table->string('vk', 255)->after('description');
            $table->string('facebook', 255)->after('vk');
            $table->string('twitter', 255)->after('facebook');
            $table->string('instagram', 255)->after('twitter');
            $table->string('google', 255)->after('instagram');
            $table->boolean('activated')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
