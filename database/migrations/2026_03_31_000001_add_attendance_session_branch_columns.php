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
            $table->string('check_in_branch_id')->nullable()->after('branchId');
            $table->string('check_out_branch_id')->nullable()->after('check_in_branch_id');
        });

        DB::table('attendance')->update([
            'check_in_branch_id' => DB::raw('branchId'),
        ]);

        DB::table('attendance')
            ->whereNotNull('check_out_date')
            ->whereNotNull('check_out_time')
            ->update([
                'check_out_branch_id' => DB::raw('branchId'),
            ]);
    }

    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn(['check_in_branch_id', 'check_out_branch_id']);
        });
    }
};
