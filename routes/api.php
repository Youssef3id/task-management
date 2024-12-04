<?php
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;




Route::get('/user', [UserController::class, 'getUserTasks'])->middleware('auth:sanctum');
Route::get('/gat/users', [UserController::class, 'getAllUser'])->middleware('auth:sanctum');
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});