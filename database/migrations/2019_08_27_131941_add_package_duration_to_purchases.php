<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackageDurationToPurchases extends Migration
{

    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('package_duration')->after('subject_id');
        });
    }

    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn(['package_duration']);
        });
    }
}
