<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestItem extends Model
{
    use HasFactory;

    protected $fillable = ['test_id','question','featured_image'];

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function choices(){
        return $this->hasMany(Choice::class);
    }

    public function correct_answer(){
        return $this->hasOne(Choice::class)->where('is_correct_answer',1);
    }
}
