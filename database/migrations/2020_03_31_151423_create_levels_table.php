<?php

use App\Level;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void {
		Schema::create('levels', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->text('description')->nullable();
			$table->unsignedBigInteger('language_id')->default(1);
			$table->timestamps();
		});

		Level::create(['name' => 'Level 1']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void {
		Schema::dropIfExists('levels');
	}
}
