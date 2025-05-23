<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponseTrait;

class UserApiController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $users = User::with('project')->get();
        return $this->successResponse($users, 'List of users');
    }
}
