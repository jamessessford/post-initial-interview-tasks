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
        // Create complaints table containing an autoincrement id, numeric category and status, timestamp dateofcomplaint, string summary, fullbody, notes and name of logging user
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('category');
            $table->integer('status');
            $table->timestamp('dateofcomplaint');
            $table->string('summary');
            $table->string('fullbody');
            $table->string('notes');
            $table->integer('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete the table if it exists
        Schema::dropIfExists('complaints');
    }
};
