<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // list All Users 
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_user' => 'required',
            'api_key' => 'required',
        ]);

        if ($validator->fails()) {
            $res = [
                'status' => false,
                'data' => $validator
            ];
            return response()->json($res);
        }

        $api = Api::where('api_user', '=', $request->api_user)->get();
        if (count($api) > 0) {
            if ($api[0]->api_key == $request->api_key) {
                $users = User::all();
                if (count($users) > 0) {
                    $res = [
                        'status' => true,
                        'data' => $users
                    ];
                    return response()->json($res);
                } else {
                    $res = [
                        'status' => false,
                        'data' => 'No User In System'
                    ];
                    return response()->json($res);
                }
            } else {
                $res = [
                    'status' => false,
                    'data' => 'API_KEY Not correct'
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => false,
                'data' => 'API_USER Not Found'
            ];
            return response()->json($res);
        }
    }

    // Show User By hi Id
    public function getById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_user' => 'required',
            'api_key' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $res = [
                'status' => false,
                'data' => $validator
            ];
            return response()->json($res);
        }

        $api = Api::where('api_user', '=', $request->api_user)->get();
        if (count($api) > 0) {
            if ($api[0]->api_key == $request->api_key) {
                $user = User::find($request->user_id);
                if ($user) {
                    $res = [
                        'status' => true,
                        'data' => $user
                    ];
                    return response()->json($res);
                } else {
                    $res = [
                        'status' => false,
                        'data' => 'No User In System'
                    ];
                    return response()->json($res);
                }
            } else {
                $res = [
                    'status' => false,
                    'data' => 'API_KEY Not correct'
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => false,
                'data' => 'API_USER Not Found'
            ];
            return response()->json($res);
        }
    }


    // Create New User
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_user' => 'required',
            'api_key' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'role' => 'required',
            'phone' => 'required|unique:users',
            'address' => 'nullable',
            'nin' => 'nullable',
            'organization' => 'nullable',
            'specialization' => 'nullable',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $res = [
                'status' => false,
                'data' => $validator
            ];
            return response()->json($res);
        }

        $api = Api::where('api_user', '=', $request->api_user)->get();
        if (count($api) > 0) {
            if ($api[0]->api_key == $request->api_key) {
                $arrayToInsert = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'nin' => $request->nin,
                    'organization' => $request->organization,
                    'specialization' => $request->specialization,
                    'password' => hash('sha512', $request->password),
                ];
                $users = User::create($arrayToInsert);
                $res = [
                    'status' => true,
                    'data' => $users
                ];
                return response()->json($res);
            } else {
                $res = [
                    'status' => false,
                    'data' => 'API_KEY Not correct'
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => false,
                'data' => 'API_USER Not Found'
            ];
            return response()->json($res);
        }
    }

    // Update User (note, it must be a post request)
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_user' => 'required',
            'api_key' => 'required',
            'user_id' => 'required',
            'name' => 'nullable',
            'email' => 'nullable',
            'role' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'nin' => 'nullable',
            'organization' => 'nullable',
            'specialization' => 'nullable',
        ]);

        if ($validator->fails()) {
            $res = [
                'status' => false,
                'data' => $validator
            ];
            return response()->json($res);
        }

        $api = Api::where('api_user', '=', $request->api_user)->get();
        if (count($api) > 0) {
            if ($api[0]->api_key == $request->api_key) {
                $arrayToUpdate = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'nin' => $request->nin,
                    'organization' => $request->organization,
                    'specialization' => $request->specialization,
                ];
                $userUpdate = User::where('id', '=', $request->user_id)->update($arrayToUpdate);
                if ($userUpdate) {
                    $user = User::find($request->user_id);
                    $res = [
                        'status' => true,
                        'data' => $user
                    ];
                    return response()->json($res);
                } else {
                    $res = [
                        'status' => true,
                        'data' => 'Failed to Update User'
                    ];
                    return response()->json($res);
                }
            } else {
                $res = [
                    'status' => false,
                    'data' => 'API_KEY Not correct'
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => false,
                'data' => 'API_USER Not Found'
            ];
            return response()->json($res);
        }
    }

    // Delete User From System
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_user' => 'required',
            'api_key' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $res = [
                'status' => false,
                'data' => $validator
            ];
            return response()->json($res);
        }

        $api = Api::where('api_user', '=', $request->api_user)->get();
        if (count($api) > 0) {
            if ($api[0]->api_key == $request->api_key) {
                $users = User::destroy($request->user_id);
                if ($users) {
                    $res = [
                        'status' => true,
                        'data' => "User Deleted"
                    ];
                    return response()->json($res);
                } else {
                    $res = [
                        'status' => false,
                        'data' => 'User Not Found In System'
                    ];
                    return response()->json($res);
                }
            } else {
                $res = [
                    'status' => false,
                    'data' => 'API_KEY Not correct'
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => false,
                'data' => 'API_USER Not Found'
            ];
            return response()->json($res);
        }
    }
}
