<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
//use Request;
class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] skills
     * @param  [string] education
     * @param  [string] gender
     * @param  [integer] age
     * @param  [string] experience
     * @param  [string] interests
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
            ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'skills' => $request->skills,
            'education' =>$request->education,
            'gender' =>$request->gender,
             'age' =>$request->age,
             'experience'=>$request->experience,
             'interests'=>$request->interests
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ],201);    
    }
    /**
     * Update user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] skills
     * @param  [string] education
     * @param  [string] gender
     * @param  [integer] age
     * @param  [string] experience
     * @param  [string] interests
     * @return [string] message
     * @return [string] email
     */
    public function update(Request $request)
{
    try{
       
       $records = User::where('email', $request->email)->first();
       $records->name = $request->name;
       $records->age=$request->age;
       $records->skills=$request->skills;
       $records->education=$request->education;
       $records->gender=$request->gender;
       $records->experience=$request->experience;
       $records->interests=$request->interests;

       $records->save();
      
        return response()->json([
            'message' => 'Successfully updated user!',
            
           'email' => $records
           
        ],200);    
    }
    catch(ModelNotFoundException $err){
        //Show error page
    }
}
/**
 * display certain user
 * @return [json] user object
 */
public function displaycertainuser($id)
{
    $records = User::where('id', $id)->first();
   
        return response()->json([
            'user' => $records
        ],200);
    
}
/**
     * delete user
     *
     
     * @return [string] message
     */
public function delete($id)
{
    $user = User::findOrFail($id);
    if($user)
       $user->delete(); 
       return response()->json([
           'message' => "User deleted !"
       ],200);
}
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    /**
     * Get all users
     *
     * @return [json] user object
     * 
     */
    public function displayallusers(Request $request)
    {
        $records = User::all();
        return response()->json([
            'users'=>$records
        ]);

    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}




?>