<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model {

	protected $guarded = [];

	public function lessons(): HasMany {
		return $this->hasMany(Lesson::class);
	}

	public function subjects(): HasMany {
		return $this->hasMany(Subject::class);
	}

	public function levels(): HasMany {
		return $this->hasMany(Level::class);
	}

	public function tags(): HasMany {
		return $this->hasMany(Tag::class);
	}
}
