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
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->foreignId('receipt_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('credit', 8, 2)->nullable();
            $table->decimal('debit', 8, 2)->nullable();
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
        Schema::dropIfExists('fund_accounts');
    }
};
