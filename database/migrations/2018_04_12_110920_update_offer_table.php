<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->integer('remuneration')->nullable(false)->change();
            $table->string('contact_email')->nullable(false);
            $table->string('contact_phone')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('remuneration')->nullable(false)->change();
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_email');
        });
    }
}
