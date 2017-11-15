<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	protected $table = 'faq_category';
	protected $primarykey = 'id';
    protected $fillable = [
        'title','slug','status',
    ];

    public function question()
    {
        return $this->hasMany('App\Question', 'category_id');
    }
}
