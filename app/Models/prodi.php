<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class prodi extends Model
{
    use HasFactory;
    public function readProdi()
    {
        return DB::table('prodi')->get();
    }
}
