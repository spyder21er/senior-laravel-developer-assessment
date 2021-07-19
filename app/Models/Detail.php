<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'icon',
        'status',
        'type',
    ];

    /**
     * Which user own this detail
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
