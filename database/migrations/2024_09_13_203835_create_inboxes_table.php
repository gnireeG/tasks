<?php

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
        Schema::create('inboxes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('username');
            $table->string('host');
            $table->string('port');
            $table->string('folder')->default('inbox');
            $table->string('subjectfilter')->nullable();
            $table->string('bodyfilter')->nullable();
            $table->string('fromfilter')->nullable();
            $table->boolean('delete_after_fetch')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->dateTime('last_fetched_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inboxes');
    }
};
