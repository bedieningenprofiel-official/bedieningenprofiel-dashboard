<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('localizations', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('locale');
            $table->boolean('selected')->default(false);
            $table->foreignIdFor(User::class, 'user_id')
                ->nullable()
                ->constrained();
            $table->timestamps();
        });
    }
};
