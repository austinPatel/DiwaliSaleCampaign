<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SigninController extends ApiController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
        /*
        User Login
    */
    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            $user = $this->userRepository->checkUserByEmail($request->email);
            
            if (!$user) {
                return $this->sendError('Invalid email or Password', ['email' => $request->all()], 401);
            }

            /* you must need to check the user has verify email or not
             As of now we dont have email verify ui so comment constraint while login.
             or you may have to manully update the email_verified_at field in database.
            */
            /*
            if (!$user->hasVerifiedEmail()) {
                return $this->sendError("Please verify your email address by clicking the link in the email sent.", ['email' => $user->email], 401);
            }
            */
            $credentials = $request->only(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->sendError('Invalid credentials', $credentials, 401);
            }
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }
            $response['token'] = $user->createToken('authToken')->accessToken;
            $response['user_detail'] = ($user);
            return $this->sendResponse($response, 'Successfully Login');
        }catch (ValidationException $error) {
            return $this->sendError($error->getMessage(), $error, 500);
        }
    }
    
    public function logout(){
        try{
            $userToken= auth()->user()->token();
            $userToken->revoke();
            $response["user"]=auth()->user()->name;
            return $this->sendResponse($response,'Successfully Logout');
        }catch(Exception $error){
            return $this->sendError($error->getMessage(), $error, 500);
        }
        
    }

}
