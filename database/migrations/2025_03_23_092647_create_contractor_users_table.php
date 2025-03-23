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
        Schema::create('contractor_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('user_id');

            //indexes
            $table->index('contractor_id', 'contractor_user_contractor_idx');
            $table->index('user_id', 'contractor_user_user_idx');

            //foreign-keys
            $table->foreign('contractor_id', 'contractor_user_contractor_fk')->on('contractors')->references('id')->onDelete('cascade');
            $table->foreign('user_id', 'contractor_user_user_fk')->on('contractors')->references('id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractor_users');
    }
};
