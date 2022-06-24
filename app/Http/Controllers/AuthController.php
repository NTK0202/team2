<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json([
                'error' => 'Email or Password is incorrect, please try again !'
            ], Response::HTTP_FORBIDDEN);
        }

        return $this->createNewToken($token);
    }

    /**
     * Log the member out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Member successfully signed out']);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function createNewToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => getenv('JWT_TTL'),
            'member' => auth()->user(),
            'role' => auth()->user()->memberId->role_id ?? 3,
        ], Response::HTTP_OK);
    }

    public function changePassWord(AuthRequest $request): JsonResponse
    {
        $memberId = auth()->user()->id;
        $member = Member::where('id', $memberId)->first();
        if (Hash::check($request->old_password, $member->password)) {
            if (!Hash::check($request->new_password, $member->password)) {
                $member = Member::where('id', $memberId)->update(
                    ['password' => bcrypt($request->new_password)]
                );

                return response()->json([
                    'message' => 'Member successfully changed password',
                    'member_id' => $memberId,
                ], Response::HTTP_CREATED);
            } else {
                return response()->json([
                    'message' => 'New password can not be the old password !',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'Old password is incorrect !',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
