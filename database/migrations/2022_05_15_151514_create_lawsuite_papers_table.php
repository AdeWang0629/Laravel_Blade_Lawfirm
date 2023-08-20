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
        Schema::create('lawsuite_papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawsuite_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('subject')->nullable();
            $table->date('date')->default(now());
            $table->text('based_on_it');
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
        Schema::dropIfExists('lawsuite_papers');
    }
};
