<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_timing extends Model
{
    use HasFactory;
    protected $fillable = [
        'hosp_id',
        'user_id',
        'days',
        'report_id',
        'timing',
    ];
    public function hospital(){
        return $this->belongsTo(Hospital::class,'hosp_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
      
    }
    public function report()
    {
        return $this->belongsTo(test_report::class, 'report_id');

    }
    public function testReport()
    {
        return $this->belongsTo(Test_report::class, 'report_id');

        // return $this->hasOne(Test_report::class);
    }
    // public function report()
    // {
    // return $this->hasOne(test_report::class, 'user_id', 'user_id');
    // }
}
