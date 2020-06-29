<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlandetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plandetails', function (Blueprint $table) {
            $table->id();
            $table->integer("planid");
            $table->string("planname")->nullable();
            $table->integer("planprice")->nullable();
            $table->integer("plandays")->nullable();
            $table->integer("planproperty");
            $table->integer("planagent")->nullable();
            $table->enum("is_deleted",['0','1'])->default("0")->comment("0 for not delete , 1 for deleted");
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
        Schema::dropIfExists('plandetails');
    }
}