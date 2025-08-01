<?php

use App\Enums\HallEnum;
use App\Enums\SeatEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('hall_id')->index();
            $table->string('status')->default(SeatEnum::UNAVAILABLE_STATUS);
            $table->integer('block');
            $table->integer('row');
            $table->integer('column');
            $table->unsignedBigInteger('cost')->default(0);

            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
