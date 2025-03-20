<?php

use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'team_id')
                ->nullable()
                ->constrained();
            $table->string('name');
            $table->json('permissions');
            $table->timestamps();
        });
    }
};
