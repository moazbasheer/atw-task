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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // required first name
            $table->string('last_name'); // required last name
            $table->biginteger('company')->unsigned(); // required company id
            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade');
            // the reference of the company id in the companies table.
            $table->string('email')->nullable(); // non-required email
            $table->string('phone')->nullable(); // non-required phone
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
