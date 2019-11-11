<?php
/**
 * Project      : Auto JWT
 * File Name    : AuthControllers.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/17 1:16 PM
 */

namespace TunnelConflux\AutoJWT\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use TunnelConflux\AutoJWT\Requests\LoginFormRequest;
use TunnelConflux\AutoJWT\Resources\User;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * in minutes
     */
    private $cache_ttl;

    /**
     *
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->cache_ttl = 60;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginFormRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginFormRequest $request)
    {
        try {
            if (!$token = auth('api')->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'success' => false,
                    'message' => trans('auth.failed'),
                ], 401);
            }

            /*if (!$request->user()->hasVerifiedEmail()) {
                return response()->json([
                    'message' => trans('verification.unverified'),
                ], 403);
            }*/

            return $this->respondWithToken($token, sha1(auth("api")->id()));
        } catch (Exception $exception) {
            if ($exception instanceof UnauthorizedHttpException) {
                $preException = $exception->getPrevious();

                if ($preException instanceof TokenExpiredException) {
                    return response()->json(['success' => false, 'error' => 'TOKEN_EXPIRED']);
                } else if ($preException instanceof TokenInvalidException) {
                    return response()->json(['success' => false, 'error' => 'TOKEN_INVALID']);
                } else if ($preException instanceof TokenBlacklistedException) {
                    return response()->json(['success' => false, 'error' => 'TOKEN_BLACKLISTED']);
                }

                if ($exception->getMessage() == 'Token not provided') {
                    return response()->json(['success' => false, 'error' => 'Token not provided']);
                }
            }
        }

        return response()->json(['success' => false, 'error' => 'Unaccepted error occurred']);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $key = sha1(auth('api')->id()) ?? null;

            auth('api')->logout();
            auth()->invalidate(true);
            Cache::forget($key);

            return response()->json(['success' => true, 'message' => 'Successfully logged out']);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out',
            ], 500);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $key = sha1(auth('api')->id());
        Cache::forget($key);

        return $this->respondWithToken(auth()->refresh(), $key);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param string $key
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token, string $key)
    {
        $ttl            = auth('api')->factory()->getTTL() * $this->cache_ttl;
        $response_token = Cache::remember($key, $ttl, function () use ($token, $ttl) {
            return ['token' => $token, 'expires' => Carbon::now()->addSeconds($ttl)];
        });

        return response()->json([
            'access_token' => $response_token['token'],
            'token_type'   => 'Bearer',
            'expires_in'   => $response_token['expires']->diffInSeconds(),
            'user' => new User(auth('api')->user())
        ]);
    }
}
