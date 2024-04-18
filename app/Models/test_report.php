<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'hosp_id',
        'user_id',
        'status',
        'vaccine_id',
        'pdf_path', // Add pdf_path to the fillable array
    ];

    // protected static function boot(){
    //     parent::boot();

    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hosp_id');
    }
    public function vaccine()
    {
        return $this->belongsTo(vaccine::class, 'vaccine_id');
    }
    public function testTiming()
    {
        return $this->hasOne(Test_timing::class);

    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'report_id');
    }
}
