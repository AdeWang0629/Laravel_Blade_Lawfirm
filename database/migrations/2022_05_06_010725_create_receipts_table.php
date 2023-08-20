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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('receipt_number');
            $table->string('base_encode');
            $table->date('date')->default(now());
            $table->string('payment_type')->nullable()->default('cash');
            $table->foreignId('client_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lawsuite_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('consultation_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('debit', 8, 2);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('receipts');
    }
};
