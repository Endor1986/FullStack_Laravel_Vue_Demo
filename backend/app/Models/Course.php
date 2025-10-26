<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    protected $fillable = ['title','description','starts_at','price_cents','is_active'];
    protected $casts = ['starts_at'=>'datetime','is_active'=>'boolean'];
}
