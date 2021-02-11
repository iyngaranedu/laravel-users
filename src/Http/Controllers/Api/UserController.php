<?php


namespace Iyngaran\User\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Iyngaran\User\Http\Requests\DestroyRequest;
use Iyngaran\User\Http\Requests\IndexRequest;
use Iyngaran\User\Http\Requests\ShowRequest;
use Iyngaran\User\Http\Requests\StoreRequest;
use Iyngaran\User\Http\Requests\UpdateRequest;

class UserController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function show(ShowRequest $request, $id)
    {
        //
    }

    public function update(UpdateRequest $request, $id)
    {
        //
    }

    public function destroy(DestroyRequest $request, $id)
    {
        //
    }
}
