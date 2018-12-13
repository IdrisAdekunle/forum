<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ThreadFilters;

class Thread extends Model
{
    protected $fillable=['subject','thread','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilter($filterQuery,ThreadFilters $threadFilters)
    {
        $threadFilters->apply($filterQuery);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_thread');
    }


}
