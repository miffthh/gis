<?php

namespace App\Models;

use App\Models\User;
use App\Models\Komentar;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forum extends Model
{
    use Sluggable;
    use HasFactory;
    // protected $fillable = ['judul', 'slug', 'konten', 'nip', 'profile_image'];

    protected $guarded = ['id'];

    protected $table = 'forum';

    public function getSluggableOptions(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nip');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByUser($user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
