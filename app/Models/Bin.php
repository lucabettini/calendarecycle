<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'day',
        'start_at',
        'end_at',
    ];


    // ELOQUENT RELATIONSHIPS 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
