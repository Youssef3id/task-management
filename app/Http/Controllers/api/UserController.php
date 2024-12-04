<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function getUserTasks(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Not authorized'], 401);
        }

        $projects = $user->projects()->get();

        return response()->json([
            'user' => new UserResource($user),
            'projects' => TaskResource::collection($projects),
        ]);
    }
}
