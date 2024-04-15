<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('reseller_ID')->nullable()->after('phone');
            $table->string('company_name')->nullable()->after('reseller_ID');
            $table->boolean('status')->nullable()->after('company_name')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //

            $table->dropColumn('reseller_ID');
            $table->dropColumn('company_name');
            $table->dropColumn('status');

        });
    }
}
