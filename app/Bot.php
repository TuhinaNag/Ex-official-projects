<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bot extends Model
{
    use SoftDeletes;
    protected $fillable = ['bot_name', 'chatfuelBotId', 'broadcast_token'];
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
