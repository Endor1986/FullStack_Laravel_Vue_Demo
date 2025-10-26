<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void {
    Schema::create('courses', function (Blueprint $t) {
        $t->id();
        $t->string('title',160)->index();
        $t->text('description')->nullable();
        $t->dateTime('starts_at')->index();
        $t->unsignedInteger('price_cents')->default(0)->index();
        $t->boolean('is_active')->default(true)->index();
        $t->timestamps();
    });
}
public function down(): void {
    Schema::dropIfExists('courses');
}

};
