<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('domain', 255)->nullable();
            $table->string('subdomain', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('facebook_page_id', 255)->nullable();
            $table->string('facebook_pixel', 255)->nullable();
            $table->string('google_analytics', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('email_contact', 255)->nullable();
            $table->string('site_title', 255)->nullable();
            $table->longText('site_keywords', 255)->nullable();
            $table->longText('site_description', 255)->nullable();
            $table->tinyInteger('plano_id')->nullable();
            $table->dateTime('next_expiration')->nullable();
            $table->dateTime('disabled_account')->nullable();
            $table->dateTime('delete_account')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->softDeletes();
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
        });
    }
}
