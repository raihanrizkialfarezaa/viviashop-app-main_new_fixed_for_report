<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

	public const ACTIVE = 'active';
	public const INACTIVE = 'inactive';

	public const STATUSES = [
		self::ACTIVE => 'Active',
		self::INACTIVE => 'Inactive',
	];


	public function scopeActive($query)
	{
		return $query->where('status', self::ACTIVE);
    }
    
	public function prevSlide()
	{
		return self::where('position', '<', $this->position)
			->orderBy('position', 'DESC')
			->first();
    }
    
	public function nextSlide()
	{
		return self::where('position', '>', $this->position)
			->orderBy('position', 'ASC')
			->first();
	}

	/**
	 * Get the image URL (supports both local and Cloudinary paths)
	 */
	public function getImageUrlAttribute()
	{
		if (!$this->path) {
			return null;
		}
		
		// If it's already a full URL (Cloudinary), return as-is
		if (filter_var($this->path, FILTER_VALIDATE_URL)) {
			return $this->path;
		}
		
		// Otherwise, it's a local path
		return asset('storage/' . $this->path);
	}
}
