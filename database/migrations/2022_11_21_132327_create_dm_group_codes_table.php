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
        Schema::create('dm_group_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code_code', 10)->unique();
            $table->string('code_name', 60);
            $table->string('code_descr', 120)->nullable();
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
        Schema::dropIfExists('dm_group_codes');
    }
};
