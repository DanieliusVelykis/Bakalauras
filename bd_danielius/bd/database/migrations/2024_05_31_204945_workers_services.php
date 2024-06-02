<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('workers_services', function (Blueprint $table) {
            $table->id();
            $table->string('workerId');
            $table->string('workerPrice');
            $table->string('workerServiceTitle');
            $table->string('workserServiceDescription');
            $table->string('workerServiceType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
