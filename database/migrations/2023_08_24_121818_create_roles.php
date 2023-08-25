<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role = Role::create([
            'name' => 'admin',
        ]);
        $permission = Permission::create([
            'name' => 'resolve requests',
        ]);

        $role->givePermissionTo($permission);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Permission::where('name', 'resolve requests')->delete();
        Role::where('name', 'admin')->delete();
    }
};
