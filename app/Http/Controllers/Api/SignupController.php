<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Requests\UserRequest;
use App\Repository\UserRepository;

class SignupController extends ApiController
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /*
        User Register
    */
    public function register(UserRequest $request)
    {
        try {
            $user = $this->userRepository->signupUser($request->all());
            $token = $user->createToken('token')->accessToken;
            $response = [
                'token' => $token,
                'user' => $user
            ];
            return $this->sendResponse($response, 'User Successfully register');
        } catch (Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }
}
