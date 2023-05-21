<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $filleable = [
        'body',
        'user_id',
        'accountable_form_id'
    ];
    public function accountable_form () 
    {
        return $this->belongsTo(AccountableForm::class);
    }
}
