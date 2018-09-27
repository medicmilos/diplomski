<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryItemLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_likes', function (Blueprint $table) {
            $table->unsignedInteger('item_id');
            $table->date('date_liked');
            $table->string('unique_id');
            $table->string('ip_address');
            $table->timestamps();

            //$table->foreign('item_id')->references('id')->on('gallery_items');

            $table->primary(['unique_id', 'ip_address', 'date_liked', 'item_id'], 'gallery_likes_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
