<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('meta')->nullable();
            $table->text('google2fa_secret')->nullable();
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        # Create superamdin account 
        \DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@kkm.com',
            'password' => Hash::make('test'),
            'role_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
            'uid' => 'asd1y23iW&E(!623u1j2oi3ujqlwke',
        ]);

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
