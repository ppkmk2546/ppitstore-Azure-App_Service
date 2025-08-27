<?php

namespace App\Http\Controllers\API;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class UserController extends Controller
{
    public function register(Request $request) {
        // Validate the request
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        // Create a new user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        // Return the user
        $token = $user->createToken('AccessToken')->plainTextToken;

        $response = [
            'message' => 'User created successfully',
            'user' => $user,
            'access_token' => $token,
            'status' => 'true'
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        // Check email
        $user = User::where('email', $request->email)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Password is incorrect',
                'status' => 'false'
            ], 401);
        }

        // Generate token
        $token = $user->createToken('AccessToken')->plainTextToken;

        // Return response
        $response = [
            'user' => $user,
            'message' => 'Successfully logged in',
            'status' => 'true'
        ];
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Successfully logged out',
            'status' => 'true'
        ], 200);
    }
    public function updateProfile(Request $request){
        $profile = Profile::where('user_id', $request->user_id)->get();
        $image = $request->file("image");

        if(count($profile) == 0){
            $userupdate = User::all()->find($request->user_id);
            $userupdate->name = $request->username;

            $profileNew = New Profile;
            $profileNew->image = $request->image;
            $profileNew->firstname = $request->firstname;
            $profileNew->lastname = $request->lastname;
            $profileNew->mobile = $request->mobile;
            $profileNew->line1 = $request->line1;
            $profileNew->line2 = $request->line2;
            $profileNew->country = $request->country;
            $profileNew->city = $request->city;
            $profileNew->province = $request->province;
            $profileNew->district = $request->district;
            $profileNew->zipcode = $request->zipcode;
            if(isset($image)){
                $image->move("assets/images/profiles", $image->getClientOriginalName());
                $profileNew->image =  $image->getClientOriginalName();
           }else{
                $profileNew->image =  $profileNew->image;
           }

            $userupdate->save();
            $profileNew->save();
        }
        else{
            $userupdate = User::all()->find($request->user_id);
            $userupdate->name = $request->username;
            foreach($profile as $item){
                $pro_id = $item->id;
            }
            $profileup = Profile::all()->find($pro_id);
            $profileup->image = $request->image;
            $profileup->firstname = $request->firstname;
            $profileup->lastname = $request->lastname;
            $profileup->mobile = $request->mobile;
            $profileup->line1 = $request->line1;
            $profileup->line2 = $request->line2;
            $profileup->country = $request->country;
            $profileup->city = $request->city;
            $profileup->province = $request->province;
            $profileup->district = $request->district;
            $profileup->zipcode = $request->zipcode;
            if(isset($image)){
                $image->move("assets/images/profiles", $image->getClientOriginalName());
                $profileup->image =  $image->getClientOriginalName();
           }else{
                $profileup->image =  $profileup->image;
           }
            $userupdate->save();
            $profileup->save();
        }
        return response()->json(array('message'=>'แก้ไขข้อมูลส่วนตัวเรียบร้อย','status'=>'true'));
    }

    public function profile($Uid){
        $user = User::where("id" , $Uid)->get();
        $profile = Profile::where('user_id', $Uid)->get();
        $chkprofile = Profile::where('user_id', $Uid)->first();
        if(!$chkprofile){
            $chkprofile = new Profile();
            $chkprofile->user_id = $Uid;
            $chkprofile->save();
        }
        $profileuser = array();
        if(count($profile) == 0){
            foreach($user as $key=>$value){
                $profileuser[$key]["user_id"] = $value->id;
                $profileuser[$key]["user_name"] = $value->name;
                $profileuser[$key]["email"] = $value->email;
                $profileuser[$key]["profile_id"] = null;
                $profileuser[$key]["image"] = null;
                $profileuser[$key]["fullname"] = null;
                $profileuser[$key]["mobile"] = null;
                $profileuser[$key]["line1"] = null;
                $profileuser[$key]["line2"] = null;
                $profileuser[$key]["district"] = null;
                $profileuser[$key]["province"] = null;
                $profileuser[$key]["city"] = null;
                $profileuser[$key]["country"] = null;
                $profileuser[$key]["zipcode"] =null;
            }

        }else{
            foreach($user as $key=>$value){
                $profileuser[$key]["user_id"] = $value->id;
                $profileuser[$key]["user_name"] = $value->name;
                $profileuser[$key]["email"] = $value->email;

            }
            foreach($profile as $key=>$value){
                $profileuser[$key]["profile_id"] = $value->id;
                $profileuser[$key]["image"] = $value->image;
                if($value->firstname == ""){
                    $profileuser[$key]["fullname"] = null;
                }else{
                    $profileuser[$key]["fullname"] = $value->firstname . " " . $value->lastname;
                }

                $profileuser[$key]["mobile"] = $value->mobile;
                $profileuser[$key]["line1"] =$value->line1;
                $profileuser[$key]["line2"] =$value->line2;
                $profileuser[$key]["district"] =$value->district;
                $profileuser[$key]["province"] =$value->province;
                $profileuser[$key]["city"] =$value->city;
                $profileuser[$key]["country"] =$value->country;
                $profileuser[$key]["zipcode"] =$value->zipcode;
            }
        }

        return response($profileuser, 201);
    }
}
