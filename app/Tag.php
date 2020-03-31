<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model {

	protected $guarded = [];

	public function language(): BelongsTo {
		return $this->belongsTo(Language::class);
	}
}
