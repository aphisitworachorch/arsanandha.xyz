<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableThankfulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('faculty')){
            Schema::create('thankful', function (Blueprint $table) {
                $table->id();
                $table->string('name_surname')->nullable();
                $table->string('faculty_id');
                $table->foreign('faculty_id')->references('faculty_id')->on('faculty');
                $table->text('message_to')->nullable();
                $table->timestamps();
            });
        }
        Schema::table('thankful', function (Blueprint $table) {
            $table->string('in_mind')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thankful', function (Blueprint $table) {
            //
        });
    }
}
