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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('receiver');
            $table->string('voucher_number');
            $table->string('base_encode');
            $table->date('date')->default(now());
            $table->string('payment_type')->nullable()->default('cash');
            $table->foreignId('expense_section_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
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
        Schema::dropIfExists('payments');
    }
};
