<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReccuringToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('recurring')->default(0)->nullable();
            $table->string('interval_type')->nullable();
            $table->integer('interval')->nullable();
            $table->integer('recurring_limit')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('recurring');
            $table->dropColumn('interval_type');
            $table->dropColumn('interval');
            $table->dropColumn('recurring_limit');

        });
    }
}
