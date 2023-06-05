<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'position_id',
        'office_id',
        'function', 
        'is_active'
    ];

    public const IS_COLLECTOR = 1;
    public const IS_CONSOLIDATOR = 2; 
    public const IS_TREASURER = 3; 
    public const IS_ADMIN = 4; 

    public function user () 
    {
        return $this->belongsTo(User::class);
    }

    public function supervisor () 
    {
        return $this->hasOne(User::class,  'supervisor_id' );
    }

}
