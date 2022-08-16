<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Test extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['title','slug','featured_image','description','author_id','category_id','type_id','is_public','is_approved','min_age_required','publish_date','expiry_date'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($test) {
            // produce a slug based on the activity title
            $slug = Str::slug($test->title);

            // check to see if any other slugs exist that are the same & count them
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            $test->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function getPublishDate(){
        return date('F d, y H:i A',strtotime($this->publish_date));
    }

    public function items(){
        return $this->hasMany(TestItem::class);
    }
}