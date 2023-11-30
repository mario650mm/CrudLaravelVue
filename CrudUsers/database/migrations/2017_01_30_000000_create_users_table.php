<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->string('image',100)->nullable();
            $table->integer('user_type_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_type_id')->references('id')
                ->on('user_types')->onDelete('set null')->onUpdate('set null');

        });
        
        date_default_timezone_set('America/Mexico_City');
        $now = date('Y-m-d H:i:s');

        User::insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
