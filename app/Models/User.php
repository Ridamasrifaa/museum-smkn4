<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use App\Models\Article;
use App\Models\InvitationCode;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'google_id',
        'role',
        'kelas',
        'jurusan',
        'angkatan',
        'status',
        'invitation_code_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ====================== RELATIONSHIPS ======================

    public function invitationCode()
    {
        return $this->belongsTo(InvitationCode::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function reviewedProjects()
    {
        return $this->hasMany(Project::class, 'reviewed_by');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // ====================== HELPER METHODS ======================

    public function isAdmin(): bool
    {
        return $this->role === 1;
    }

    public function isSiswa(): bool
    {
        return $this->role === 2;
    }

    public function getRoleName(): string
    {
        return $this->role === 1 ? 'Admin' : 'Siswa';
    }
}