<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Progres;
use App\Traits\ApiResponseTrait;

class ProgressApiController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $progres = Progres::with(['user', 'project', 'approvals'])->get();
        return $this->successResponse($progres, 'List of progres');
    }
}
