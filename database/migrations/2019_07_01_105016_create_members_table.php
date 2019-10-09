<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('division_id');
            $table->string('full_name');
            $table->tinyInteger('gender')->length(1)->default(0);
            $table->date('birthday');
            $table->string('hometown');
            $table->date('start_working_date');
            $table->string('deha_mail')->nullable();
            $table->string('person_mail');
            $table->string('mobile', 16)->nullable();
            $table->string('skype', 64)->nullable();
            $table->string('facebook', 128)->nullable();
            $table->string('current_accommodation');
            $table->double('experience', 18, 2)->nullable();
            $table->string('id_card_member', 20);
            $table->date('date_issued');
            $table->string('place_issued', 128);
            $table->tinyInteger('marital_status')->length(1)->default(0);
            $table->string('education')->nullable();
            $table->softDeletes()->nullable();
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
        Schema::dropIfExists('members');
    }
}
