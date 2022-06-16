<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processor extends Model
{
    use HasFactory, SoftDeletes;
	
	 protected $hidden = [
        'computer_id'
    ];

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
