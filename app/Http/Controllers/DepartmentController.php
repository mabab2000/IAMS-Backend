<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Carbon\Carbon;
use DB;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(request $request)
    {
        try{

            $department=new Department;
            $department->dep_name=$request->dep_name;
            $department->dep_email=$request->dep_email;
            $department->dep_desc=$request->dep_desc;
            $department->created_at=Carbon::now();
            $department->updated_at=Carbon::now();
            $department->save();
            
            return response()->json([
            
                'message'=>'Department created sucessfully',
                'depaprment'=>$department,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'Department not created',
                    'Department'=>$department,
                    'status'=>201,
                    '4'=>$e,
                ]);
            
            
            }
            
    }
    public function department_view(){
        
        
        try{
        
            $request= DB::table('departments')
            ->select('*')
           
            ->get();
        return response()->json([
        
            'message'=>'Retrived department',
            'department'=>$request,
            'status'=>200,
        ]);
        
        }catch(\Exception $e){
        
            return response()->json([
        
                'message'=>'No department',
                'department'=>$department,
                'status'=>201,
                '4'=>$e,
            ]);
            
        
        
        }
        
        
        
           }
           public function department(request $request,$id){
        
        
            try{
            
            $request= DB::table('departments')
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
    public function department_update(request $request,$id){


        try{
        
        $department= department::find($id);
        $department->dep_name=$request->dep_name;
        $department->dep_email=$request->dep_email;
        $department->dep_desc=$request->dep_desc;
        $department->updated_at=Carbon::now();
        $department->update();
        
        return response()->json([
        
            'message'=>'department update sucessfully',
            'department'=>$department,
            'status'=>200,
        ]);
        
        }catch(\Exception $e){
        
            return response()->json([
        
                'message'=>'department not Updated',
                'department'=>$department,
                'status'=>201,
                '4'=>$e,
            ]);
            
        
        
        }
        
        
        
           }
           public function department_delete($id){
        
        
            try{
            
            $department= DB::delete('delete from departments where id=?',[$id]);
            return response()->json([
            
                'message'=>'Delete department sucessfully',
                'department'=>$department,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'department not deleted',
                    'student'=>$department,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
            
            
            
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
}
