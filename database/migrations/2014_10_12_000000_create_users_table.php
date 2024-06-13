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
            $table->integer('bidang_id')->length(11);
            $table->string('name');
            $table->integer('role')->length(11);
            $table->string('email')->unique();
            $table->string('phone')->length(15);
            $table->string('wa')->length(15);
            $table->string('profil');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('created_by')->length(11);
            $table->integer('updated_by')->length(11);
            $table->integer('is_active')->length(11);
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
