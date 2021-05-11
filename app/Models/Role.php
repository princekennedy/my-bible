<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedTrait;

class Role extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedTrait;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $casts = [
       'created_at' => 'datetime:Y-m-d h:i:s',
       'updated_at' => 'datetime:Y-m-d h:i:s',
       'deleted_at' => 'datetime:Y-m-d h:i:s'
    ];  

    protected $fillable = [
    	'name', 'description',

        'active', 'status_id',
        'created_at', 'updated_at', 'created_by', 
        'updated_by', 'deleted_at'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function business()
    {
        return $this->belongsToMany(Business::class);
    }
}
