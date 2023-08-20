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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('consultation_subject')->nullable();
            $table->double('contract_amount', 8, 2)->nullable();
            $table->string('consultation_number')->unique();
            $table->string('base_encode');
            $table->integer('vat')->unsigned()->default(0);
            $table->double('total_amount', 8, 2)->nullable();
            $table->date('contract_date')->nullable()->default(now());
            $table->text('contract_terms')->nullable();
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
        Schema::dropIfExists('consultations');
    }
};
