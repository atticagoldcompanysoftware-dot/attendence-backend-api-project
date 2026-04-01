<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->decimal('check_out_latitude', 10, 7)->nullable()->after('longitude');
            $table->decimal('check_out_longitude', 10, 7)->nullable()->after('check_out_latitude');
        });

        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn('branchId');
        });
    }

    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->string('branchId')->nullable()->after('empId');
        });

        DB::table('attendance')->update([
            'branchId' => DB::raw('check_in_branch_id'),
        ]);

        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn(['check_out_latitude', 'check_out_longitude']);
        });
    }
};
