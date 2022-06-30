<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\data_penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    //LOGIN=====================================//
    public function login()
    {
        $user_crendential = request(['email', 'password']);

        if (!$token = auth('api')->attempt($user_crendential)) {
            return response()
                ->json([
                    'status' => false,
                    'message' => 'User tidak ditemukan',
                    'error' => 'Unauthorized'
                ], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Login',
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    //END==LOGIN===================================//





    //REGISTER=====================================//

    public function register(Request $request)
    {
        $response = array('response' => '', 'success' => false);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'nik' => 'required|unique:users',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $penduduk = data_penduduk::where('nik', $request->nik)->first();
            if ($penduduk) {
                $user = User::create([
                    'name' => $request->name,
                    'nik' => $request->nik,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_kel_desa' => $penduduk->kelurahan
                ]);
                if ($user) {

                    //attach role
                    $user->attachRole(2);

                    return response()->json([
                        'status' => true,
                        'message' => 'User berhasil diregistrasi'
                    ]);
                }

                return response()->json([
                    'status' => false,
                    'message' => 'User gagal diregistrasi'
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'nik tidak terdaftar di data penduduk kelurahan'
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => $response
        ]);
    }

    //END==REGISTER===================================//





    //LOGOUT=========================================//

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    //END==LOGOUT=========================================//



    //ME=========================================//
    public function me(Request $request)
    {
        $user = User::with('roleuser.roleid')->where('id', Auth::user()->id)->first();
        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    //ENDME=========================================//


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
}