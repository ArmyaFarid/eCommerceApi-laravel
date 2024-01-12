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
        Schema::create('commande_articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('num_commande');
            $table->uuid('code_article');

            $table->integer('quantite');
            $table->decimal('prixTotal', 10, 2);

            $table->foreign('num_commande')->references('num_commande')
                ->on('commandes')->onDelete('cascade');
            $table->foreign('code_article')->references('code_article')
                ->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_articles');
    }
};
