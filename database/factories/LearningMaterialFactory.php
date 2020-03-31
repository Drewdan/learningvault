<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LearningMaterial;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$factory->define(LearningMaterial::class, function (Faker $faker) {
	$fileName = 'files/' . $faker->word . '.txt';
	Storage::put($fileName, $faker->sentence, 'public');
	return [
		'lesson_id' => 1,
		'original_name' => Str::slug($faker->sentence),
		'file' => $fileName,
	];
});
