<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveConfig extends Model
{
    use HasFactory;
    protected $table = 'active_config';
    protected $fillable = [
        'key', 'value',
        'created_at', 'updated_at', 
        'created_by', 'updated_by'
    ];
}
