<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_invoice extends Model
{
    //
	protected $table = 'payment_invoice';
	protected $primarykey = 'id';
	protected $fillable = [
		'order_id','txn_id', 'total_price', 'payment_status', 'payment_method','invoice_description','invoice_details','order_date',
	];
}
