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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('id_number')->unique();
            $table->string('cr_number')->unique();
            $table->string('nationality')->nullable();
            $table->string('po_box')->nullable();
            $table->string('mobile')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('city');
            $table->text('address')->nullable();
            $table->string('password')->nullable();
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
