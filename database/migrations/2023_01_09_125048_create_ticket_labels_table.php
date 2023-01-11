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
        Schema::create('ticket_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->references('id')->on('tickets')->cascadeOnDelete();
            $table->foreignId('label_id')->references('id')->on('labels')->cascadeOnDelete();
            $table->unique(['ticket_id', 'label_id']);
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
        Schema::dropIfExists('ticket_labels');
    }
};
