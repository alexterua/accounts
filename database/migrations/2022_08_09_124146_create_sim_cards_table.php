<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->integer('iccid');
            $table->unsignedSmallInteger('is_active')->default(0);
            $table->integer('imei');
            $table->string('notes');

            $table->index('account_id', 'account_sim_card_idx');
            $table->foreign('account_id', 'account_sim_card_fk')->on('accounts')->references('id');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sim_cards');
    }
};
