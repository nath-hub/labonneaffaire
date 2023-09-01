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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id');
            $table->string("title");
            $table->integer("price");
            $table->string("size")->nullable();
            $table->string("images")->nullable();
            $table->longText("description");
            $table->enum('state_product', ['OCCASION', 'NEUF']);
            $table->string("color")->nullable();
            $table->string("localization");
            $table->boolean('option_discutable')->default(0);
            $table->enum('state_property', ['MODERN', 'NON_MODERN'])->nullable();
            $table->enum('type_property', ['MEUBLE', 'NON_MEUBLE'])->nullable();
            $table->dateTime("date_publish");
            $table->string("job_type")->nullable();
            $table->enum('state_job', ['OPEN', 'CLOSE'])->nullable();
            $table->enum('availability', ['DISPONIBLE', 'INDISPONIBLE']);
            $table->enum('state_annonce', ['VALIDATE', 'REJECTED', "BLOCKED", "UNPROCESSED"]);
            
            $table->index(["comment_id"], "fk_annonce_comment");

            $table->foreign('comment_id')->references('id')->on('comments');

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
        Schema::dropIfExists('annonces');
    }
};
