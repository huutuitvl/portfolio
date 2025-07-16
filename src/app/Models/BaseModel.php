<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check() && $model->usesSoftDeletes()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }

    // Optional helper
    public function usesSoftDeletes()
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(static::class));
    }
}
