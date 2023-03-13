<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\role_user;
use Carbon\Carbon;
use DB;
use table;
class RoleController extends Controller
{
    public function store(Request $request)
    {
        try {
        
    
            $role = new Role;
            $role->name = $request->name;
            // add other fields
            $role->created_at = Carbon::now();
            $role->updated_at = Carbon::now();
            $role->save();
    
            return response()->json([
                'message' => 'Role created successfully',
                'role' => $role,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Role not created',
                'error' => $e,
            ], 500);
        }
    }
    
        
        
        
    
    public function role_view(){
        
        
        try{
        
        $role= DB::select('select *from departments');
        return response()->json([
        
            'message'=>'Retrived role',
            'info'=>$role,
            'status'=>200,
        ]);
        
        }catch(\Exception $e){
        
            return response()->json([
        
                'message'=>'No role',
                'info'=>$role,
                'status'=>201,
                '4'=>$e,
            ]);
            
        
        
        }
        
        
        
           }
           public function role_vieww(){
        
        
            try{
            
            $role= DB::select('select *from roles');
            return response()->json([
            
                'message'=>'Retrived role',
                'info'=>$role,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'No role',
                    'info'=>$role,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
            
            
            
               }
           public function role_update(request $request,$id){


            try{
            
            $role= role::find($id);
            $role->role_name=$request->role_name;
            $role->role_description=$request->role_description;
            $role->updated_at=Carbon::now();
            $role->update();
            
            return response()->json([
            
                'message'=>'Role update sucessfully',
                'info'=>$role,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'Role not Updated',
                    'student'=>$role,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
            
            
            
               }
               public function role_delete($id){
        
        
                try{
                
                $role= DB::delete('delete from roles where id=?',[$id]);
                return response()->json([
                
                    'message'=>'Delete role sucessfully',
                    'role'=>$role,
                    'status'=>200,
                ]);
                
                }catch(\Exception $e){
                
                    return response()->json([
                
                        'message'=>'Role not deleted',
                        'role'=>$role,
                        'status'=>201,
                        '4'=>$e,
                    ]);
                    
                
                
                }
                
                
                
                   }
                   public function assign_role(request $request){
                           try{
            
                            $user= DB::update('update role_user set role_id='.$request->role_id.' where user_id=?',[$request->user_id]);
                return response()->json([
                            
                           
                            
                                'message'=>'User update sucessfully',
                                'user'=>$user,
                                'status'=>200,
                            ]);
                            
                            }catch(\Exception $e){
                            
                                return response()->json([
                            
                                    'message'=>'user not Updated',
                                   
                                    'status'=>201,
                                    '4'=>$e,
                                ]);
                                
                            
                            
                            }
                            
                            
                        }
                }
