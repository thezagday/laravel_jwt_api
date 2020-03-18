<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name'            => 'required',
            'email'           => 'required|email',
            'password'        => 'required',
            'organisation_id' => 'required|integer',
            'role_id'         => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'Unprocessable entity',
                    'success' => false,
                ],
                422
            );
        }

        $authUser = auth()->user();
        if (
            $authUser->hasRole(Role::ADMIN)
            && $authUser->organisation->id != $input['organisation_id']
        ) {
            return response()->json(
                $this->failResponse('create'),
                422
            );
        }

        $user = User::create($input);
        $data = $user->toArray();

        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'User stored successfully.',
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name'            => 'sometimes|required|max:500',
            'email'           => 'sometimes|required|email',
            'password'        => 'sometimes|required|max:500',
            'organisation_id' => 'sometimes|required|integer',
            'role_id'         => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'Unprocessable entity',
                    'success' => false,
                ],
                422
            );
        }

        $authUser = auth()->user();
        if (
            $authUser->hasRole(Role::ADMIN)
            && $authUser->organisation->id != $user->organisation->id
        ) {
            return response()->json(
                $this->failResponse('update'),
                422
            );
        }

        $user->update($input);
        $data = $user->toArray();

        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'User updated successfully.',
        ];

        return response()->json($response, 200);
    }

    public function delete(Request $request, User $user)
    {
        $authUser = auth()->user();
        if (
            $authUser->hasRole(Role::ADMIN)
            && $authUser->organisation->id != $user->organisation->id
        ) {
            return response()->json(
                $this->failResponse('delete'),
                422
            );
        }

        $user->delete();
        $data = $user->toArray();

        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'User deleted successfully.',
        ];

        return response()->json($response, 200);
    }

    private function failResponse(string $action): array
    {
        return [
            'message' => sprintf('Admin can only %s users for his organization!', $action),
            'success' => false,
        ];
    }
}
