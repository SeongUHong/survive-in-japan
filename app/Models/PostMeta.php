<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    use HasFactory;
    protected $primaryKey = ['post_id', 'key'];
    public $incrementing = false; // 기본 키가 자동 증가하지 않음을 명시
}
