<?php

use App\UserType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->timestamps();
            $table->softDeletes();
        });
        
        date_default_timezone_set('America/Mexico_City');
        $now = date('Y-m-d H:i:s');
        UserType::insert([
            ['id' => 1,'name' => 'admin', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2,'name' => 'user', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
