<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->environment('local')) {
        return redirect()->route('local-login');
    }

    return view('welcome');
});

if (app()->environment('local')) {
    Route::get('/login', fn () => redirect()->route('local-login'))->name('login');

    Route::get('/local-login', function () {
        $user = User::firstOrCreate(
            ['email' => 'demo@example.test'],
            ['name' => 'Local Demo', 'password' => str()->random(40)],
        );
        $user->forceFill([
            'tenant_id' => 'demo-tenant',
            'can_use_database_assistant' => true,
        ])->save();

        if (! DB::table('projects')->where('tenant_id', 'demo-tenant')->exists()) {
            DB::table('projects')->insert([
                'tenant_id' => 'demo-tenant',
                'name' => 'Sample project',
                'status' => 'planned',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Auth::login($user);

        return redirect()->route('assistant.index');
    })->name('local-login');
}
