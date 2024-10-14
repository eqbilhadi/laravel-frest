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
        Schema::create('com_menus_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('com_menus')->cascadeOnDelete();
            
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('com_roles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('com_menus_has_roles');
    }
};
