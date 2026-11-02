<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historico_status', function (Blueprint $table) {
            $table->string('status_anterior', 30)->nullable();
            $table->string('status_novo', 30)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('historico_status', function (Blueprint $table) {
            $table->dropColumn([
                'status_anterior',
                'status_novo',
            ]);
        });
    }
};
