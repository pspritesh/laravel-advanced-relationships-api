<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'mname', 'lname', 'class', 'college',
    ];

    /**
     * The Full Name Accessor.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->fname . " " . $this->mname . " " . $this->lname;
    }

    /**
     * The College Mutator.
     *
     * @var array
     */
    public function setCollegeAttribute($value)
    {
        $this->attributes['college'] = ucwords(strtolower($value));
    }

    /**
     * The One To One relationship.
     *
     * @return object
     */
    public function subject()
    {
        return $this->hasOne(App\Models\Subject::class);
    }

    /**
     * The One To Many relationship.
     *
     * @return array
     */
    public function subjects()
    {
        return $this->hasMany(App\Models\Subject::class);
    }

    /**
     * The Polymorphic O2O relationship.
     *
     * @return object
     */
    public function photos()
    {
        return $this->morphOne(App\Models\Photo::class, 'imageable');
    }

    /**
     * The Polymorphic M2M relationship.
     *
     * @return array
     */
    public function tags()
    {
        return $this->morphToMany(App\Models\Tag::class, 'taggable');
    }
}
