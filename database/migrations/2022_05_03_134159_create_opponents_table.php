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
        Schema::create('opponents', function (Blueprint $table) {
            $table->id();
            $table->string('opponent_name');
            $table->string('opponent_phone')->nullable();
            $table->string('opponent_address')->nullable();
            $table->string('opponent_section')->nullable();
            $table->string('opponent_city')->nullable();
            $table->string('opponent_lawyer')->nullable();
            $table->string('opponent_lawyer_phone')->nullable();
            $table->foreignId('lawsuite_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('opponents');
    }
};
