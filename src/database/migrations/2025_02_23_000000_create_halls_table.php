<?php

use App\Enums\HallEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('concert_id')->index();
            $table->string('status')->default(HallEnum::INACTIVE_STATUS);
            $table->string('name');

            $table->foreign('concert_id')
                ->references('id')
                ->on('concerts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
