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
        Schema::create('tx_cargo_manifest', function (Blueprint $table) {
            $table->id();
            $table->string('cn_no', 30)->unique();
            $table->date('cn_date');
            $table->string('cn_service', 10);
            $table->string('cn_goods_type', 10);
            $table->string('cn_branch_code', 10);
            $table->integer('cn_qty');
            $table->integer('cn_weight');
            $table->float('cn_freightcharge_amount');
            $table->string('cn_branchdestination_code', 10);
            $table->string('cn_destcity', 10);
            $table->string('cn_transactionstatus', 10);
            $table->string('cn_shipper_name', 30);
            $table->string('cn_shipper_adress', 120);
            $table->string('cn_shipper_phone', 30);
            $table->string('cn_shipper_email', 30)->nullable();
            $table->string('cn_receiver_name', 30);
            $table->string('cn_receiver_adress', 120);
            $table->string('cn_receiver_phone', 30);
            $table->string('cn_receiver_email', 30)->nullable();
            $table->string('created_by')->default('ADMIN');
            $table->string('updated_by')->default('ADMIN');
            $table->boolean('is_active')->default(true); 
            $table->timestamps();

            $table->foreign('cn_service')->references('code_code')->on('dm_codes');
            $table->foreign('cn_goods_type')->references('code_code')->on('dm_codes');
            $table->foreign('cn_branch_code')->references('branch_code')->on('dm_branches');
            $table->foreign('cn_branchdestination_code')->references('branch_code')->on('dm_branches');
            $table->foreign('cn_destcity')->references('district_code')->on('dm_districts');
            $table->foreign('cn_transactionstatus')->references('code_code')->on('dm_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tx_cargo_manifest');
    }
};
