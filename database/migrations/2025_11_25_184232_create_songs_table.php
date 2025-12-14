<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id('song_id');
            $table->unsignedBigInteger('artist_id');
            $table->foreign('artist_id')
                ->references('artist_id')
                ->on('artists')
                ->onDelete('cascade');

            $table->string('song_title', 260)->notNull();
            $table->string('song_album', 50)->notNull();
            $table->longText('song_lyric')->notNull();
            $table->longText('song_chord')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
