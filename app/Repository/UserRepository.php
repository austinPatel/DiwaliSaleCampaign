<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserRepository
{
    public function getUserById($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /*
        User Create|Update
    */
    public function signupUser(array $data)
    {
        // $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        event(new Registered($user));
        return $user;
    }
    /*
        Check User email verify or not
    */
    public function checkUserByEmail($email)
    {
        $user = User::where('email', $email)->first(); // need to verify email_verify_at not null
        return $user;
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        if (!$user || !$token = Auth::attempt($data)) {
            return $user;
        }
    }

}