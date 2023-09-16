<?php

namespace App\Models;

use App\Models\User;
use App\Models\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'nip');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
    public function child()
    {
        return $this->hasMany(Komentar::class, 'parent');
    }
}
