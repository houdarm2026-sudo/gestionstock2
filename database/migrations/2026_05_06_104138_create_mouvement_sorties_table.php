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
        Schema::create('mouvement_sorties', function (Blueprint $table) {
            $table->id();
            $table->string('num_bon_sortie');
            $table->date('date_sortie');
            $table->string('qantite_sortie');
            $table->decimal('prix_sortie',10,2);
            $table->foreignId('article_id')->constrained('articles')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_sorties');
    }
};



