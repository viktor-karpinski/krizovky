<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->default('0');
            $table->integer('size');
            $table->integer('percentage');
            $table->string('game', 1500);
            $table->foreignIdFor(User::class);
            $table->boolean('approved')->default(false);
            $table->integer('likes')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('plays')->default(0);
            $table->string('colors', 1500)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
