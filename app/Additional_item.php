<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional_item extends Model
{
    //
	protected $table = 'additional_items';
	protected $primarykey = 'id';
	protected $foreignkey  = 'plan_id';
    protected $fillable = ['plan_id','title','description','price','package_id','status','options','notes'];
	
	public function getAdditional_items()
    {	 
		try{
			$data = $this->hasMany('App\Order', 'plan_id');
		}catch (\Exception $e) {
            $message = collect($e->getTrace())->implode('\n');
        }
		return $data;
    }
}
