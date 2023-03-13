<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Student;
use Carbon\Carbon;


class StudentsController extends Controller
{
   public function store_student(request $request){


try{

$student=new Student;
$student->name=$request->name;
$student->father_name=$request->father_name;
$student->created_at=Carbon::now();
$student->updated_at=Carbon::now();
$student->save();

return response()->json([

    'message'=>'student created sucessfully',
    'student'=>$student,
    'status'=>200,
]);

}catch(\Exception $e){

    return response()->json([

        'message'=>'student not created',
        'student'=>$student,
        'status'=>201,
        '4'=>$e,
    ]);


}




   }

public function student_update(request $request,$id){


    try{
    
    $student= Student::find($id);
    $student->name=$request->name;
    $student->father_name=$request->father_name;
    $student->updated_at=Carbon::now();
    $student->update();
    
    return response()->json([
    
        'message'=>'Student update sucessfully',
        'student'=>$student,
        'status'=>200,
    ]);
    
    }catch(\Exception $e){
    
        return response()->json([
    
            'message'=>'Student not Updated',
            'student'=>$student,
            'status'=>201,
            '4'=>$e,
        ]);
        
    
    
    }
    
    
    
       }
      

        public function student_view(){
        
        
            try{
            
            $students= DB::select('select *from students');
            return response()->json([
            
                'message'=>'Retrived students',
                'student'=>$students,
                'status'=>200,
            ]);
            
            }catch(\Exception $e){
            
                return response()->json([
            
                    'message'=>'No student',
                    'student'=>$students,
                    'status'=>201,
                    '4'=>$e,
                ]);
                
            
            
            }
            
            
            
               }
               public function student_delete($id){
        
        
                try{
                
                $students= DB::delete('delete from students where id=?',[$id]);
                return response()->json([
                
                    'message'=>'Delete student sucessfully',
                    'student'=>$students,
                    'status'=>200,
                ]);
                
                }catch(\Exception $e){
                
                    return response()->json([
                
                        'message'=>'Student not deleted',
                        'student'=>$students,
                        'status'=>201,
                        '4'=>$e,
                    ]);
                    
                
                
                }
                
                
                
                   }
                  
    
}
    
    