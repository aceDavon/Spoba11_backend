<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\V1\StoreUserRequest;
use App\Http\Resources\api\V1\UserResources;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return UserResources::collection(User::all());
    }

    public function show(User $user)
    {
        return new UserResources($user);
    }

    public function update(Request $request, User $user)
    {
        // $request->validated();

       if(Auth::user()->id !== $user->id) {
            return $this->error([], 'Not authorized', 403);
        }

        $user->update($request->all());
       return  new UserResources($user);
    }

    public function destroy(User $user)
    {
       return $this->isNotAuthorized($user)
        ? $this->isNotAuthorized($user)
        : $user->delete();
    }

    private function isNotAuthorized($user)
    {
        if(Auth::user()->id !== $user->id) {
            return $this->error([], 'Not authorized', 403);
        }

        return response('', 204);
    }
}
