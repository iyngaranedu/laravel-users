<?php


namespace Iyngaran\User\Http\Controllers\Api\Secure;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Iyngaran\User\Actions\CreateAction;
use Iyngaran\User\Actions\DeleteAction;
use Iyngaran\User\Actions\UpdateAction;
use Iyngaran\User\DTO\UserData;
use Iyngaran\User\Http\Requests\DestroyRequest;
use Iyngaran\User\Http\Requests\IndexRequest;
use Iyngaran\User\Http\Requests\ShowRequest;
use Iyngaran\User\Http\Requests\StoreRequest;
use Iyngaran\User\Http\Requests\UpdateRequest;
use Iyngaran\User\Http\Resources\UserResource;
use Iyngaran\User\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    public function index(IndexRequest $request, UserRepositoryInterface $user): AnonymousResourceCollection
    {
        return UserResource::collection($user->search($request));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(
            new UserResource((new CreateAction())->execute(UserData::formRequest($request))),
            201
        );
    }

    public function show(ShowRequest $request, UserRepositoryInterface $user, $id): JsonResponse
    {
        return response()->json(new UserResource($user->find($id)));
    }

    public function update(UpdateRequest $request, UserRepositoryInterface $user, $id): JsonResponse
    {
        return response()->json(
            new UserResource((new UpdateAction())->execute(UserData::formRequest($request), $user->find($id))),
            200
        );
    }

    public function destroy(DestroyRequest $request, UserRepositoryInterface $user, $id): JsonResponse
    {
        return response()->json((new DeleteAction())->execute($user->find($id)), 204);
    }
}
