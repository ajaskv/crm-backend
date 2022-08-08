<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailchimpToEmailConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_configs', function (Blueprint $table) {
            $table->string('mailchimp_api_key')->nullable();
            $table->string('mailchimp_list_id')->nullable();
            $table->string('mailchimp_from_email')->nullable();
            $table->string('mailchimp_from_name')->nullable();
            $table->string('mailchimp_to_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_configs', function (Blueprint $table) {
            $table->dropColumn('mailchimp_api_key');
            $table->dropColumn('mailchimp_list_id');
            $table->dropColumn('mailchimp_from_email');
            $table->dropColumn('mailchimp_from_name');
            $table->dropColumn('mailchimp_to_name');
        });
    }
}
