<?php

use App\Enum\UserEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('last_login')->nullable();
            $table->string('username');
            $table->string('status')->default(UserEnum::INACTIVE_STATUS);
            $table->text('token')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
