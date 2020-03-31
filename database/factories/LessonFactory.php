<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LearningMaterial;
use App\Lesson;
use App\Worksheet;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Date;

$factory->define(Lesson::class, function (Faker $faker) {
	return [
		'name' => $faker->word,
		'description' => $faker->sentence,
		'subject_id' => rand(1, 10),
		'level_id' => rand(1, 5),
		'user_id' => 1,
		'published' => true,
		'published_at' => Date::now(),
	];
});

$factory->afterCreating(Lesson::class, function ($lesson, $faker) {
	$lesson->worksheets()->save(factory(Worksheet::class)->make());
	$lesson->learningMaterials()->save(factory(LearningMaterial::class)->make());
});
