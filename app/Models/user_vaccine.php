<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_vaccine extends Model
{
    protected $table = 'user_vaccines';

    // protected $fillable = ['vaccine_id', 'quantity', 'user_id'];
    protected $fillable = ['vaccine_id', 'quantity', 'user_id','hosp_id'];

    // Define the relationship with the Vaccine model
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hosp_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Define relationships or any other methods as needed.
}

