<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AccountController extends BaseController
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'ktp' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' => 'required',
            'password' => 'required',
            'confirmpass' => 'required|same:password',
            'term_cond' => 'required',
            'user_type' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success = [
            'state' => 'Register success'
        ];

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request) {
        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            $success = [
                'token' => $user->createToken('TajukUser')->accessToken,
                'userid' => $user->id,
                'fullname' => $user->fullname,
                'username' => $user->username,
                'ktp' => $user->ktp,
                'email' => $user->email,
                'phone' => $user->phone,
                'province' => $user->province,
                'city' => $user->city,
                'district' => $user->district,
                'term_cond' => $user->term_cond,
                'user_type' => $user->user_type
            ];

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function update_data_user(Request $request, User $user) {
        $input = $request->all();
        $validator = Validator::make($input, [
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'ktp' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $user->username = $input['username'];
            $user->email = $input['email'];
            $user->phone = $input['phone'];
            $user->ktp = $input['ktp'];
            $user->province = $input['province'];
            $user->city = $input['city'];
            $user->district = $input['district'];
            $user->save();
            return $this->sendResponse('User updated successfully');
        }
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logout successfully.'
        ]);
    }
}
