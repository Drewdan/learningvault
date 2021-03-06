<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksheetsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void {
		Schema::create('worksheets', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('lesson_id');
			$table->string('original_name');
			$table->string('file');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void {
		Schema::dropIfExists('worksheets');
	}
}
