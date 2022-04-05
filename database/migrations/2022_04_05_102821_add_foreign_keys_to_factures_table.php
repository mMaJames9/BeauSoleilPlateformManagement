<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysTofacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->foreign(['client_id'], 'FK_client_facture')->references(['id'])->on('clients')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->dropForeign('FK_client_facture');
        });
    }
}
