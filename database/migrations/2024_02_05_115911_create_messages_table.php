<?php

use App\Models\User;
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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('contenue');
            $table->foreignIdFor(User::class)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('create_messages_table', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('messages');
            Schema::enableForeignKeyConstraints();
        });
    }
};
