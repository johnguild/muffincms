<?php

namespace Johnguild\Muffincms\Foundations\Models\Admin;

// dependencies
use Illuminate\Database\Eloquent\Model;
use Auth;
// models

class Admin extends Model
{

  	/*---------- VARAIBLES ----------*/

    protected $guarded = [ 'id' ];


	/*---------- GET<>ATTRIBUTE ----------*/

    public function getValAttribute( $value ){
        $value = unserialize($value);
        if($this->isSerialized($value))	$value=unserialize($value);
        
        return $value;
    }

    public function setValAttribute( $value ){

    	return $this->attributes['val'] = serialize($value);
    }
    

	/*---------- SCOPES ----------*/

    public function scopeKey( $query, $arg ){

	    $query->where('key', $arg);
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
		$res = self::key('maintenance')->first();
		return $res->val['on'];
	}

	public static function toggleMaintenance($on=false){

		$res = self::key('maintenance')->first();
		$hldr = $res->val;
		unset($res->val);
		$hldr['on'] = $on;
		$res->val = $hldr;
		$res->save();
	}

	function isSerialized($str) {
	    return ($str == serialize(false) || @unserialize($str) !== false);
	}
}
