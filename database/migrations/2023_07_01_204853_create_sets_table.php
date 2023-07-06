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
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('training_day_id');
            $table->integer('reps');
            $table->integer('weight');
            $table->timestamps();

            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('training_day_id')->references('id')->on('training_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sets', function (Blueprint $table) {
            // Удаление внешнего ключа перед удалением таблицы
            $table->dropForeign(['exercise_id']);
            $table->dropForeign(['training_day_id']);
        });

        Schema::dropIfExists('sets');
    }
};
