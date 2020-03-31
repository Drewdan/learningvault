<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void {
		Schema::create('lessons', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->text('description')->nullable();
			$table->unsignedBigInteger('subject_id');
			$table->unsignedBigInteger('level_id');
			$table->unsignedBigInteger('user_id');
			$table->boolean('show_author')->default(true);
			$table->boolean('published')->default(false);
			$table->unsignedBigInteger('language_id')->default(1);
			$table->timestamps();
			$table->dateTime('published_at')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void {
		Schema::dropIfExists('lessons');
	}
}
