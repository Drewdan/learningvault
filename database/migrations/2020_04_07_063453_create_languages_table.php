<?php

use App\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('languages', function (Blueprint $table) {
			$table->id();
			$table->string('language_name');
			$table->string('language_code');
			$table->timestamps();
		});

		Language::create([
			'id' => 1,
			'language_name' => 'English',
			'language_code' => 'en',
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('languages');
	}
}
