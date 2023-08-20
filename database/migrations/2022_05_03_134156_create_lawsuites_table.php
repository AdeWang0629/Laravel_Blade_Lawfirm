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
        Schema::create('lawsuites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('client_type_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('case_type_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->string('lawsuite_lawyer')->nullable();
            $table->string('lawsuite_subject')->nullable();
            $table->foreignId('case_stage_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('lawsuit_case_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('court_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->string('case_number')->unique();
            $table->string('base_encode');
            $table->string('court_case_number')->nullable();
            $table->string('contract_title')->nullable();
            $table->date('contract_date')->nullable()->default(now());
            $table->double('contract_amount', 8, 2)->nullable();
            $table->integer('vat')->unsigned()->default(0);
            $table->double('total_amount', 8, 2)->nullable();
            $table->text('contract_terms')->nullable();
            $table->text('judgment')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('lawsuites');
    }
};
