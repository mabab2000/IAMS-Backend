<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use App\Models\User;
class Roles extends Model
{
    use HasFactory;

}
$user = User::find(1);
$role = Role::findByName('admin','student','receptionist','departmet');
$user->assignRole($role);