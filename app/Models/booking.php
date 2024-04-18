<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    
    protected $fillable = ['hosp_id', 'user_id', 'time', 'date', 'report_id'];

    // Define a relationship with the hospitals table
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hosp_id');
    }

    // Define a relationship with the users table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define a relationship with the reports table
    public function report()
    {
        return $this->belongsTo(Test_report::class, 'report_id');
    }
}
