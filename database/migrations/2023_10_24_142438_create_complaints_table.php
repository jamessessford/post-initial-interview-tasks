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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('user_id'); // Foreign key for the user who logged the complaint
            $table->string('summary');
            $table->text('full_text');
            $table->enum('status', [
                'not_acknowledged',
                'pending_investigation',
                'under_investigation',
                'resolved_justified',
                'resolved_unjustified',
            ])->default('not_acknowledged');
            $table->enum('complaint_type', ['complaint', 'dissatisfaction']); // Add 'complaint_type' field
            $table->timestamps();
    
            // Define foreign key relationship with users
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
