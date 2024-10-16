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
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('faq_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->text('description');
            $table->timestamps();

            $table->unique(['faq_id', 'locale']);

            $table->foreign('faq_id')
                ->references('id')
                ->on('faqs')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_translations');
    }
};
