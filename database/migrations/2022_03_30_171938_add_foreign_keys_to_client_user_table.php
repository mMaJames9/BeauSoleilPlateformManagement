<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClientUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_user', function (Blueprint $table) {
            $table->foreign(['client_id', 'user_id'], 'FK_client_user')->references(['id'])->on('clients')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_user', function (Blueprint $table) {
            $table->dropForeign('FK_client_user');
        });
    }
}
