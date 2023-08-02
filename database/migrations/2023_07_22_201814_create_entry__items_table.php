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
        Schema::create('entry__items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demand_id');
            // $table->foreignId('asset_id');
            // $table->string('name');
            // $table->foreignId('category_id');
            // $table->foreignId('location_id');
            // $table->date('tgl');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('nilai');
            $table->integer('total');
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
        Schema::dropIfExists('entry__items');
    }
};
