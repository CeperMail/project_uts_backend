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
        //membuat tabel pegawai
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('gender');
            $table->string('phone');
            $table->text('address');
            $table->string('email');
            $table->string('status');
            $table->date('hired_on');
            $table->timestamps();

            //untuk memastikan gender hanya berisi L atau P
            $table->check('gender IN ("L", "P")');
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
