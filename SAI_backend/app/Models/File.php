<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * @package App\Models
 *
 * @property int $id
 * @property string $s3_object_id
 * @property string $file_name
 * @property string $uploaded_at
 * @property string $created_at
 * @property string $updated_at
 */
class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        's3_object_id',
        'file_name',
        'file_size',
        'uploaded_at'
    ];
}
