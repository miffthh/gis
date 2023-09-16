<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoAdmin extends Model
{
    use HasFactory;
    protected $table = 'resto';
    protected $guarded = [];
}
