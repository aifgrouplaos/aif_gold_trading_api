<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tblcustomer', function (Blueprint $table) {
        
            // $table->string('name');
            // $table->string('tel');
            $table->integer('cid');
            $table->string('cus_code');
            $table->string('cus_name');
            $table->string('cus_address');
            $table->string('create_date');
            $table->string('updated_at');
            $table->integer('userid');
            // 'cus_code', 
            // 'cus_name',
            // 'cus_address',
            // 'cus_contact',
            // 'create_date', 
            // 'updated_at', 
            // 'userid'
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblcustomer');
    }
};
