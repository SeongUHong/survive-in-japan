<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $primaryKey = ['post_id', 'name'];
    public $incrementing = false;
    protected $keyType = 'string';
    use HasFactory;
}
