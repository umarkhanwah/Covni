<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaccine extends Model
{
    use HasFactory;

    protected $table = 'vaccines';

    // protected $fillable = ['name', 'quantity'];
    protected $fillable = [
        'name',
        'user_id',
        'hosp_id',
        'quantity'
    ];
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hosp_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
