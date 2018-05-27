<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Class User
 *
 * @property integer        $id
 * @property string         $user
 * @property string         $password
 * @property integer        $created_by
 * @property integer        $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Model
 */
final class User extends Model
{    

    protected $table = 'users';
    
    protected $hidden = [
        'password'
    ];
    
}