<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Lesson extends Model {

	use HasSlug;

	protected $fillable = [
		'name',
		'description',
		'level_id',
		'show_author',
	];

	protected $casts = [
		'show_author' => 'boolean',
		'published' => 'boolean',
		'published_at' => 'datetime',
	];

	/**
	 * Get the options for generating the slug.
	 */
	public function getSlugOptions(): SlugOptions {
		return SlugOptions::create()
			->generateSlugsFrom('name')
			->saveSlugsTo('slug');
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'slug';
	}

	public function language(): BelongsTo {
		return $this->belongsTo(Language::class);
	}

	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	public function level(): BelongsTo {
		return $this->belongsTo(Level::class);
	}

	public function subject(): BelongsTo {
		return $this->belongsTo(Subject::class);
	}

	public function learningMaterials(): HasMany {
		return $this->hasMany(LearningMaterial::class);
	}

	public function worksheets(): HasMany {
		return $this->hasMany(Worksheet::class);
	}

	public function scopePublished($query) {
		return $query->where('published', '=', true);
	}

	public function scopeBelongsToUser($query) {
		return $query->where('user_id', Auth::user()->id);
	}
}
