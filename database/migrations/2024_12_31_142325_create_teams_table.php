<?php

use App\Models\Church;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->string('church_name')->unique();
            $table->string('church_email')
                ->unique()
                ->nullable();
            $table->string('church_address');
            $table->foreignIdFor(User::class, 'church_owner_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->foreignIdFor(User::class, 'user_id')->constrained('users');
            $table->foreignIdFor(Church::class, 'church_id')->constrained('churches');
            $table->timestamps();
        });
    }
};
