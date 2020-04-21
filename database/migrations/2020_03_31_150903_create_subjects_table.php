<?php

use App\Subject;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('subjects', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->boolean('published')->default(true);
			$table->unsignedBigInteger('language_id')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('subjects');
	}
}
