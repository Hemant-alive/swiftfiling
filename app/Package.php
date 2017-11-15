<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
	protected $table = 'packages';
	protected $primarykey = 'id';
	protected $fillable = ['plan_id','title','description','price','status','end_date','start_date'];
	
	public function getpackage()
    {
		return $this->belongsTo('App\Order', 'foreign_key', 'pacakage_id');
    }
}
