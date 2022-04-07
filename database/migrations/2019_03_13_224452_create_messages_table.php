<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_status');
            $table->integer('to_status');
            $table->integer('seen')->default(0);
            $table->string('subject');
            $table->text('body');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('admin_id')->unsigned()->index()->nullable();  
            $table->integer('sub_id')->unsigned()->index()->nullable();
            $table->foreign('sub_id')->references('id')->on('subs')->onDelete('cascade');          
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
}
