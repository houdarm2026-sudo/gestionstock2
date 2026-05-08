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
        Schema::create('mouvement_entrees', function (Blueprint $table) {
            $table->id();
            $table->string('num_bon_entree')->unique();
            $table->date('date_entree');
            $table->integer('qantite_entree');
            $table->decimal('prix_entree',10,2);
            $table->foreignId('article_id')->constrained('articles')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_entrees');
    }
};


