<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->string('logo_url')->nullable()->after('nama_bank');
            $table->string('color_primary')->default('#3B82F6')->after('logo_url');
            $table->string('color_secondary')->default('#1E40AF')->after('color_primary');
        });
    }

    public function down(): void
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->dropColumn(['logo_url', 'color_primary', 'color_secondary']);
        });
    }
};