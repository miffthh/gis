<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataAdmin extends Model
{
    use HasFactory;
    protected $table = 'wisata';
    protected $guarded = [];
}
