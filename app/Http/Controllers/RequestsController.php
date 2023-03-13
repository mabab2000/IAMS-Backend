<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class RequestsController extends Controller
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
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required',
        'req_name' => 'required',
        'file1' => 'required|mimes:pdf,doc,docx|max:2048',
        'file2' => 'required|mimes:pdf,doc,docx|max:2048',
        'description' => 'required',
    ]);

    $file1 = $request->file('file1')->store('public/uploads');
    $file2 = $request->file('file2')->store('public/uploads');

    $save = new Requests;
    $save->user_id = $validatedData['user_id'];
    $save->req_name = $validatedData['req_name'];
    $save->letter = $request->file('file1')->getClientOriginalName();
$save->recom_letter = $request->file('file2')->getClientOriginalName();
    $save->description = $validatedData['description'];
    $save->created_at = Carbon::now();
    $save->updated_at = Carbon::now();
    $save->save();

    if ($save) {
        return ["Result" => "success"];
    } else {
        return response()->json(["error" => "Failed to save the request"], 500);
    }
}

        
        
        public function request_department_update(request $request,$id){


            try{
                
               
            
            $save= requests::find($id);
                $save->depart_id=$request->depart_id;
                $save->status='Processing';
                $save->updated_at=Carbon::now();
           
                $save->update();
            
            return response()->json([
            
                'message'=>'Request updated sucessfully',
                'save'=>$save,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'Request not Updated',
                 
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
            
            
            
               }
               public function dep_descision(request $request,$id){


                try{
                    
                   
                
                $save= requests::find($id);
                    $save->status=$request->dep_dsc;
                    $save->updated_at=Carbon::now();
               
                    $save->update();
                
                return response()->json([
                
                    'message'=>'Request descision makes sucessfully',
                    'save'=>$save,
                    'status'=>200,
                ]);
                
                }catch(\Exception $e){
                
                    return response()->json([
                
                        'message'=>'Request status not Updated',
                     
                        'status'=>201,
                        '4'=>$e,
                    ]);
                    
                
                
                }
                
                
                
                   }
               
        
               public function dep_desc(request $request,$id){


                try{
                    
                   
                
                $save= requests::find($id);
                    $save->status=$request->status;
                   
                    $save->updated_at=Carbon::now();
               
                    $save->update();
                
                return response()->json([
                
                    'message'=>'Request descision from department assigned',
                    'save'=>$save,
                    'status'=>200,
                ]);
                
                }catch(\Exception $e){
                
                    return response()->json([
                
                        'message'=>'Request not Updated',
                        'save'=>$save,
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
    public function trackk()
    {
        try{
        
            $request = DB::table('requests')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->join('departments', 'requests.depart_id', '=', 'departments.id')
            ->select('requests.id','requests.user_id', 'users.first_name','users.last_name', 'departments.dep_name', 'requests.req_name', 'requests.status')
            
            ->get();
        
            $count = $request->count();
            if ($request->isEmpty()) {
                echo "No Request  found on your ID ";
            } else {
               
            
        return response()->json([
            'message'=>'This is your requeest information',
            'info' => $request,
            'status' => 200,
            ]);
        
            
            }
        }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'request you have',
                   
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
    }
     public function track($id)
    {
        try{
        
            $request = DB::table('requests')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->join('departments', 'requests.depart_id', '=', 'departments.id')
            ->select('requests.id', 'users.first_name','users.last_name', 'departments.dep_name', 'requests.req_name', 'requests.status')
            ->where('requests.user_id', $id)
            ->get();
        
            $count = $request->count();
            if ($request->isEmpty()) {
                echo "No Request  found on your ID ";
            } else {
               
            
        return response()->json([
            'message'=>'This is your requeest information',
            'info' => $request,
            'status' => 200,
            ]);
        
            
            }
        }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'request you have',
                   
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
    }

    public function  all_req_in_dep($id)
    {
        try{
        
            $request = DB::table('requests')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->join('departments', 'requests.depart_id', '=', 'departments.id')
            ->select('requests.id', 'users.first_name','users.last_name','requests.req_name','requests.letter','requests.recom_letter' , 'departments.dep_name', 'requests.status')
            ->where('departments.id', $id)
            ->where('requests.status', 'processing')
            ->get();
        
            $count = $request->count();
            if ($request->isEmpty()) {
                echo "No Request  found in your department ";
            } else {
               
            
        return response()->json([
            'message'=>'There are '.$count.' Request found in your department',
            'info' => $request,
            'status' => 200,
            ]);
        }
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'department',
                    ''=>$request,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
    }
    public function  req_in_dep($id)
    {
        
        
            try{
        
                $request = DB::table('requests')
                ->join('users', 'requests.user_id', '=', 'users.id')
                ->join('departments', 'requests.depart_id', '=', 'departments.id')
                ->select('requests.id', 'users.first_name','users.last_name','requests.req_name','requests.letter','requests.recom_letter' , 'departments.dep_name', 'requests.status')
                ->where('requests.depart_id', $id)
                ->get();
            
                $count = $request->count();
                if ($request->isEmpty()) {
                    echo "No Request  found in your department ";
                } else {
                   
                
            return response()->json([
                'message'=>'There are '.$count.' Request found in your department',
                'info' => $request,
                'status' => 200,
                ]);
            }
                }catch(\Exception $e){
                
                    return response()->json([
                
                        'message'=>'department',
                        ''=>$request,
                        'status'=>201,
                        '4'=>$e,
                    ]);
                    
            
                }
            
    }
    public function reception_view_request()
    {
        try{
        
            $request = DB::table('requests')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->join('departments', 'requests.depart_id', '=', 'departments.id')
            ->select('requests.id', 'users.first_name','users.last_name','requests.req_name','requests.letter','requests.recom_letter' , 'departments.dep_name', 'requests.status')
            ->where('requests.status', 'Pending')
            ->get();
            $count = $request->count();
            if ($request->isEmpty()) {
                echo "No any request Request  found on reception.";
            } else {
               
            
        return response()->json([
            'message'=>'There are '.$count.' Request waited in reception',
            'request' => $request,
            'status' => 200,
        ]);
    }
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'request you have',
                   
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
    }
    public function view_request()
    {
        try{
        
            $request= DB::table('requests')
            ->select('*')
            ->get();
            $count = $request->count();
            if ($request->isEmpty()) {
                echo "No Request  found ";
            } else {
               
            
        return response()->json([
            'message'=>'There are '.$count.' Request in system',
            'info' => $request,
            'status' => 200,
            ]);
        }
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'samething wrong',
                    'info'=>$request,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
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
    public function delete_request($id){
        
        
        try{
        
        $requests= DB::delete('delete from requests where id=?',[$id]);
        return response()->json([
        
            'message'=>'Delete qequest sucessfully',
            'ifo'=>$id,
            'status'=>200,
        ]);
        
        }catch(\Exception $e){
        
            return response()->json([
        
                'message'=>'Request not deleted',
                'info'=>$id,
                'status'=>201,
                '4'=>$e,
            ]);
            
        
        
        }
        
        
        
           }
}
