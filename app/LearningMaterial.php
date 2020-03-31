<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class LearningMaterial extends Model {

	protected $guarded = [];

	public function lesson(): BelongsTo {
		return $this->belongsTo(Lesson::class);
	}

	public function getSizeAttribute() {
		return number_format(Storage::size($this->file) / 1024, 2);
	}
}
