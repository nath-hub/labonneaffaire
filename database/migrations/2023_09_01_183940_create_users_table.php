<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('town')->nullable();
            $table->string('code')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('role', ["ADMIN", "USER"]);
            $table->enum('type_account', ['INDIVIDUAL', 'INTERPRISE']);
            $table->string('siren')->nullable();
            $table->string('commercial_register')->nullable();
            $table->string('name_enterprise')->nullable();
            $table->string('address')->nullable();
            $table->string('web_site')->nullable();
            $table->string('description')->nullable();
            $table->enum('state', ['ACTIF', 'INACTIF']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};