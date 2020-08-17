<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\HandleResponse\HandleResponse;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Registramos un usuario solo pueden registrar usuarios
     * el usuario con nivel "admin"
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function signup(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed'
            ], [
                'name.required' => 'Please enter name',
                'email.required' => 'Please enter email',
                'password.required' => 'Please enter password',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->save();
            return response()->json([
                'data' => $user,
            ], 201);

        } catch (\Exception $e) {
            return json_response($e->getMessage(), 402);
        }
    }

    /**
     * Iniciamos session
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized'], 401);
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'user' => $request->user(),
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            ]);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function signed(Request $request, $id)
    {
        try {
            if (!$request->hasValidSignature()) {
                abort(403);
            }

            $data = Auth::loginUsingId($id);
            $user = $data;
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'user' => $request->user(),
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            ]);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $id = Auth::guard()->id();
            User::where('id', $id)
                ->update([
                    'password' => bcrypt($request->input('password'))
                ]);
            $institution = User::find($id);

            return response()->json([
                'data' => wrapper_extra($institution),
            ], 201);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    public function forget(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
            ], [
                'email.required' => 'Please enter email'
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }

            $user = User::where('email', $request->email)->first();

            $link = URL::temporarySignedRoute(
                'user.confirmed',
                now()->addDay(),
                ['id' => $user->id]
            );
            $user->link = $link;
            $user->notify(new NewUser($user));
            return response()->json([
                'data' => $user,
            ], 201);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }
}
