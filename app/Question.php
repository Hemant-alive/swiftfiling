<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $table = 'faq_question_answers';
	protected $primarykey = 'id';
	protected $foreignkey  = 'category_id';
    protected $fillable = [
        'category_id','question', 'slug', 'answer', 'status',
    ];
    public function category()
    {
        return $this->belongsTo('App\Faq', 'category_id');
    }
}
