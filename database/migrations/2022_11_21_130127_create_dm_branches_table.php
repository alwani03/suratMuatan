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
        Schema::create('dm_branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code', 10)->unique();
            $table->string('branch_name', 30);
            $table->string('branch_address', 120)->nullable();
            $table->string('branch_phone', 120)->nullable();
            $table->string('created_by')->default('ADMIN');
            $table->string('updated_by')->default('ADMIN');
            $table->boolean('is_active')->default(true); 
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
        Schema::dropIfExists('dm_branches');
    }
};
