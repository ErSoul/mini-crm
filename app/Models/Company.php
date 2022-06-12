<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Employee;
use DB;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'logo', 'website'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }


    public static function forDropdown()
    {
        return DB::table('companies as c')->select('c.id', 'c.name')->get()->pluck('name', 'id');
    }
}
