<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserApplication extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE   = 'ACTIVE';
    public const STATUS_RESOLVED = 'RESOLVED';
}
