<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserFile
 * @package App\Models
 *
 * @property int $user_id
 * @property int $file_id
 * @property string $file_name
 * @property string $created_at
 * @property string $updated_at
 */
class UserFile extends Model
{
    protected $table = 'user_files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'file_id'
    ];
}
