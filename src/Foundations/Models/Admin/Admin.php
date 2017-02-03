<?php

namespace Johnguild\Muffincms\Foundations\Models\Admin;

// dependencies
use Johnguild\Muffincms\Foundations\Models\Admin\Admin as MuffinAdmin;
use Illuminate\Database\Eloquent\Model;
use Auth;
// models

class Admin extends Model
{

  	/*---------- VARAIBLES ----------*/

    protected $guarded = [ 'id' ];

    public static $maintenance;

	/*---------- GET<>ATTRIBUTE ----------*/

    public function getValueAttribute( $value ){
        
        return $this->attributes['value'] = unserialize($value);
    }

    public function setValueAttribute( $value ){

    	return $this->attributes['value'] = serialize($value);
    }
    

	/*---------- SCOPES ----------*/

    public function scopeName( $query, $arg ){

	    $query->where('name', $arg);
    }
    
	/*---------- RELATIONS ----------*/


	// public function orderitems(  ){
	// 	return $this->hasMany(OrderItem::class);
 	//        return $this->belongsTo(User::class);
 	//        return $this->hasOne(OrderStatus::class);    
 	//        return $this->hasOne(OrderStatusChange::class)
 	//                    ->where('changed_by', Auth::user()->id)
 	//                    ->latest();
	// }

	/*---------- CUSTOM METHODS ----------*/

	/**
	 * Check to see if it is on maintenance mode
	 */
	public static function isMaintenance(){

		if(!isset(self::$maintenance)){
			$res = self::name('maintenance')->first();
			self::$maintenance = $res->value['on'];
		}

		return self::$maintenance;
	}

	public static function toggleMaintenance($on=null){
		$tmp;
		if($on === null) $tmp = self::$maintenance ? false:true;
		else $tmp = $on;

		$res = self::name('maintenance')->first();
		$hldr = $res->value;
		unset($res->value);
		$hldr['on'] = $tmp;
		$res->value = $hldr;
		$res->save();

		self::$maintenance = $tmp;
	}
}
