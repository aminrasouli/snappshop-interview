<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_card_id')
                ->constrained('cards')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('destination_card_id')
                ->constrained('cards')
                ->restrictOnUpdate()
                ->restrictOnUpdate();
            $table->decimal('amount', 16, 0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
