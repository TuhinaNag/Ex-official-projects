<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GlobalVariables extends Model
{
	use SoftDeletes;
    protected $fillable = ['var_name', 'chatfuelBotId', 'currentVal', 'initialVal', 'defaultVal', 'dataType'];
    protected $guarded = ['user_id'];
     protected $dates = ['deleted_at'];
    /**
     * Function to show the perticular bots for that perticular user using one to many relationship.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
