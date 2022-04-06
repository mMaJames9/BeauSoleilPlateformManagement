<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFactureServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facture_service', function (Blueprint $table) {
            $table->foreign(['service_id', 'facture_id'], 'FK_facture_service')->references(['id'])->on('services')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facture_service', function (Blueprint $table) {
            $table->dropForeign('FK_facture_service');
        });
    }
}
