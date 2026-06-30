<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
  protected $fillable = [
    'name',
    'email',
    'avatar',
    'password',
    'role',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELATIONSHIPS
     */

    /**
     * Get all projects yang di-upload oleh user ini (siswa)
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all projects yang di-review oleh user ini (admin)
     */
    public function reviewedProjects()
    {
        return $this->hasMany(Project::class, 'reviewed_by');
    }

    /**
     * HELPER METHODS
     */

    /**
     * Check apakah user ini admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 1;
    }

    /**
     * Check apakah user ini siswa
     */
    public function isSiswa(): bool
    {
        return $this->role === 2;
    }

    /**
     * Get role name
     */
    public function getRoleName(): string
    {
        return $this->role === 1 ? 'Admin' : 'Siswa';
    }
}