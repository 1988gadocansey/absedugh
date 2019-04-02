<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserLevelModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_levels';
    
    protected $primaryKey="id";
    protected $guarded = ['id'];
    public $timestamps = false;
    
     
}
