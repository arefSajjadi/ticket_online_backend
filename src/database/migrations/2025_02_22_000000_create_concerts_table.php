<?php

use App\Enum\ConcertEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('date')->nullable();
            $table->string('status')->default(ConcertEnum::INACTIVE_STATUS);
            $table->string('title');
            $table->integer('capacity');
            $table->unsignedInteger('cost')->default(0);
            $table->text('address');
            $table->text('file');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
