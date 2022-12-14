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
        Schema::create('dm_districts', function (Blueprint $table) {
            $table->id();
            $table->string('district_code', 10)->unique();
            $table->string('district_name', 120);
            $table->string('district_postalcode', 10)->nullable();
            $table->string('branch_code', 10);
            $table->string('created_by')->default('ADMIN');
            $table->string('updated_by')->default('ADMIN');
            $table->boolean('is_active')->default(true); 
            $table->timestamps();

            $table->foreign('branch_code')->references('branch_code')->on('dm_branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm_districts');
    }
};
