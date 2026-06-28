<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Disable timestamps except created_at
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * RELATIONSHIPS
     */

    /**
     * Get all projects dalam kategori ini
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get jumlah approved projects dalam kategori ini
     */
    public function approvedProjectsCount()
    {
        return $this->projects()
            ->where('status', 'approved')
            ->count();
    }
}
