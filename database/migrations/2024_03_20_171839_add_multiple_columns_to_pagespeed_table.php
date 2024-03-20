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
        Schema::table('pagespeeds', function (Blueprint $table) {
            //
            $table->decimal('FCP_mobile', 10,2)->nullable();
            $table->decimal('TBT_mobile', 10,2)->nullable();
            $table->decimal('LCP_mobile', 10,2)->nullable();
            $table->decimal('CLS_mobile', 10,4)->nullable();
            $table->decimal('TTI_mobile', 10,2)->nullable();
            $table->decimal('size_mobile', 10,2)->nullable();

            //add the above columns again, but change mobile to desktop
            $table->decimal('FCP_desktop', 10,2)->nullable();
            $table->decimal('TBT_desktop', 10,2)->nullable();
            $table->decimal('LCP_desktop', 10,2)->nullable();
            $table->decimal('CLS_desktop', 10,4)->nullable();
            $table->decimal('TTI_desktop', 10,2)->nullable();
            $table->decimal('size_desktop', 10,2)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagespeeds', function (Blueprint $table) {
            //drop columns
            $table->dropColumn('FCP_mobile');
            $table->dropColumn('TBT_mobile');
            $table->dropColumn('LCP_mobile');
            $table->dropColumn('CLS_mobile');
            $table->dropColumn('TTI_mobile');
            $table->dropColumn('size_mobile');

            //drop columns
            $table->dropColumn('FCP_desktop');
            $table->dropColumn('TBT_desktop');
            $table->dropColumn('LCP_desktop');
            $table->dropColumn('CLS_desktop');
            $table->dropColumn('TTI_desktop');
            $table->dropColumn('size_desktop');



        });
    }
};
