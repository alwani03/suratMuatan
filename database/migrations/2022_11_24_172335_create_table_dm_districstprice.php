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
        Schema::create('dm_districstprice', function (Blueprint $table) {
            $table->id();
            $table->string('districtprice_code', 10)->unique();
            $table->string('branch_code', 10);
            $table->string('branch_dest_code', 10);
            $table->string('district_dest_code', 10);
            $table->string('service_code', 10);
            $table->string('goods_type_code', 10);
            $table->integer('weight');
            $table->float('price');
            $table->string('created_by')->default('ADMIN');
            $table->string('updated_by')->default('ADMIN');
            $table->boolean('is_active')->default(true); 
            $table->timestamps();

            $table->foreign('branch_code')->references('branch_code')->on('dm_branches');
            $table->foreign('branch_dest_code')->references('branch_code')->on('dm_branches');
            $table->foreign('district_dest_code')->references('district_code')->on('dm_districts');
            $table->foreign('service_code')->references('code_code')->on('dm_codes');
            $table->foreign('goods_type_code')->references('code_code')->on('dm_codes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm_districstprice');
    }
};
