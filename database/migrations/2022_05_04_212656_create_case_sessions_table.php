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
        Schema::create('case_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->boolean('all_day')->nullable()->default(true);
            $table->string('bg_color')->nullable();
            $table->text('session_details')->nullable();
            $table->foreignId('court_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('lawsuite_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('case_sessions');
    }
};
