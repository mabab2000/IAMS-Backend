<?php

namespace App\Http\Controllers;
use App\Rules\Gmail;
use Illuminate\Http\Request;
use App\Models\User; 
use Carbon\Carbon;
use DB;
use validate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
public function attachRoleToUser()
{
    $user = User::find(1);
    $role = Role::where(1,2, 3 ,4)->first();
    $user->roles()->attach($role->id);
    
    return "Role attached to user successfully";
}

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'email' => ['required', 'email', new Gmail],
                'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/']],
            );
       $users=new User;
       $users->first_name=$request->first_name;
       $users->last_name=$request->last_name;
       $users->gender=$request->gender;
       $users->phone=$request->phone;
       $users->email = $validatedData['email'];
       $users->password=bcrypt($validatedData['password']);
       $users->created_at=Carbon::now();
       $users->updated_at=Carbon::now();
       $users->save();
       
       
            
        
       return response()->json([
            
        'message'=>'Account created sucessfully',
        'status'=>200,
        'redirect_url' => 'http://localhost:3000/Login',
    ]);
    
    }catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->getMessageBag();
        $errorMessage = 'User account not created.  ';
    foreach ($errors->all() as $error) {
        $errorMessage .= $error . ' ';
    }
    return response()->json([
        'message' => $errorMessage,
        'errors' => $errors,
    ], 422);
    }
    }
    public function forgotPassword(Request $request)
{
    try {
        $validatedData = $request->validate([
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/']
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404
            ]);
        }

        $user->password = bcrypt($validatedData['password']);
        $user->updated_at = Carbon::now();
        $user->save();

        return response()->json([
            'message' => 'Password reset successfully',
            'user' => $user,
            'status' => 200,
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->getMessageBag();
        $errorMessage = 'Password reset failed.';

        return response()->json([
            'message' => $errorMessage,
            'errors' => $errors,
        ], 422);
    }
}

    public function user_view(){
        
        
        try{
        
        $request= DB::table('users')
        ->select('*')
        ->get();
        $count = $request->count();
            if ($request->isEmpty()) {
                echo "No user found ";
            } else {
               
            
        return response()->json([
            'message'=>'There are '.$count.' users of a system',
            'info' => $request,
            'status' => 200,
            ]);
            
        
        
        }
    }catch(\Exception $e){
    
        return response()->json([
    
            'message'=>'users',
            ''=>$request,
            'status'=>201,
            '4'=>$e,
        ]);
        
        
        
        
    }}
    public function user_oneview(request $request,$id){
        
        
        try{
        
        $request= DB::table('users')
        ->select('*')
        ->where('id',$id)
        ->get();
        $count = $request->count();
            if ($request->isEmpty()) {
                echo "No user found ";
            } else {
               
            
        return response()->json([
            'message'=>'There are '.$count.' users of a system',
            'info' => $request,
            'status' => 200,
            ]);
            
        
        
        }
    }catch(\Exception $e){
    
        return response()->json([
    
            'message'=>'users',
            ''=>$request,
            'status'=>201,
            '4'=>$e,
        ]);
        
        
        
        
    }}
    public function user_check_email(request $request){
        
        
        try{
        
        $request= DB::table('users')
        ->select('*')
        ->where('email',$request->email)
        ->get();
       
               
            
        
            $count = $request->count();
            if ($request->isEmpty()) {
                return response()->json([
                    'message' => 'Your email address not found',
                    'status' => 404,
                ]);} else {
                    return response()->json([
                        'message' => 'Now you can create a new password',
                        'info' => $request,
                        'status' => 200,
                    ]);
            
        
        
        }
    }catch(\Exception $e){
    
        return response()->json([
    
            'message'=>'users',
            ''=>$request,
            'status'=>201,
            '4'=>$e,
        ]);
        
        
        
        
    }}
           public function user_update(request $request,$id){


            try{
            
            $user= user::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->gender=$request->gender;
            $user->phone=$request->phone;
            $user->email=$request->email;
           
            $user->updated_at=Carbon::now();
            $user->update();
            
            return response()->json([
            
                'message'=>'User update sucessfully',
                'user'=>$user,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'user not Updated',
                    'user'=>$user,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
            
            
            
               }
               public function user_delete($id){
        
        
                try{
                
                $user= DB::delete('delete from users where id=?',[$id]);
                return response()->json([
                
                    'message'=>'Delete user sucessfully',
                    'user'=>$id,
                    'status'=>200,
                ]);
                
                }catch(\Exception $e){
                
                    return response()->json([
                
                        'message'=>'Student not deleted',
                        'user'=>$user,
                        'status'=>201,
                        '4'=>$e,
                    ]);
                    
                
                
                }
                
                
                
                   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function user_department_update(request $request){


        try{
            
           
        
        $save= user::find($request->id);
            $save->dep_id=$request->depart_id;
            
            $save->updated_at=Carbon::now();
       
            $save->update();
        
        return response()->json([
        
            'message'=>'Department assigned to user sucess',
            'save'=>$save,
            'status'=>200,
        ]);
        
        }catch(\Exception $e){
        
            return response()->json([
        
                'message'=>'Fail',
             
                'status'=>201,
                '4'=>$e,
            ]);
            
        
        
        }
        
        
        
           }
}
