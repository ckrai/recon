<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\Question_group;
use App\Models\Question;
use App\Models\Option;
use App\Models\User;
use App\Models\Survey_result;
use App\Models\Survey_answer;
use App\Models\Image;
use App\Models\Setting;
use App\Models\Bank;


class HomeController extends Controller
{
    //
    public function dashboard(){
            $surveys= Survey::get();
                foreach($surveys as $s){
                    $s->survey_count= Survey_result::where('survey_id',$s->id)->count();
                    $s->active_surveyors= Survey_result::whereDate('created_at',date('Y-m-d'))-> where('survey_id',$s->id)->groupBy('surveyor_id')->select('surveyor_id')->get();
                    $s->goal_achived=  round(($s->survey_count*100)/760000);
                    $s->goal= '7,60,000';
                }

                $banks=Bank::get();
            return view ('dashboard', compact('surveys','banks'));
    }

    public function policy(){
       
    return view ('termandcon');
    }
     
    public function service(){
    return view ('service');
    }

    public function surveys(){
         $surveys = Survey::paginate(40);;
         return view ('surveys', compact('surveys'));
    }

    public function surveyors(){
        $users = User::where('role','surveyors')->orderBy('id','desc');
        if(isset($_REQUEST['q'])){
            $users=$users->where(
                   function($query) {
                     return $query
                            ->where('name', 'LIKE', '%'.$_REQUEST['q'].'%')
                            ->orWhere('mobile_number', 'LIKE', '%'.$_REQUEST['q'].'%');
                     });
        }

 

        $users=$users->paginate(40);
        foreach($users as $u){
            $u->survey_count= Survey_result::where('surveyor_id',$u->id)->count();
        }
         return view ('surveyors', compact('users'));
        
    }



    public function management(){
        $users = User::where('role','management')->orderBy('id','desc')->paginate(40);
         return view ('management', compact('users'));
    }


    public function storeManagement(Request $request)
    {
        $data= $request->input();
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'mobile_number'=>'required|size:10|unique:users'
        ]);
        
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'management',
            'mobile_number'=> $data['mobile_number'],
            'password' => \Hash::make($data['password']),
        ]);

        return redirect()
                ->back()
                ->with('success', 'New  Management User successfully added!');
    }




    public function loginAccess(Request $request,$status,$id){
        $users = User::where('id',$id)->update(['is_login'=>$status]);
        return redirect()
                ->back()
                ->with('success', 'login access successfully updated!');

   }
    public function storeSurveyors(Request $request)
    {
        $data= $request->input();
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'mobile_number'=>'required|size:10|unique:users'
        ]);
        
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number'=> $data['mobile_number'],
            'password' => \Hash::make($data['password']),
        ]);

        return redirect()
                ->back()
                ->with('success', 'New  Surveyors successfully added!');
    }

    public function settings(Request $request){
             $data=Setting::where('id','1')->first();
            return view ('settings',compact('data'));

    }

    public function storeSettings(Request $request){
             $data=$request->input();
             print_r($data);
            Setting::where('id','1')->update(['emails'=>$data['emails']]);
            return redirect()
                ->back()
                ->with('success', '   Emails successfully added!');
    }


    public function surveyorsReport(){
        $date=$_REQUEST['date'];
        $survey_id=$_REQUEST['survey_id'];

                           // $s->active_surveyors= ;

       $users= User::where('role','surveyors')
                     ->whereIn('id',Survey_result::whereDate('created_at',$date)-> where('survey_id',$survey_id)->groupBy('surveyor_id')->select('surveyor_id')->get())
                     ->get();
        $f=fopen('php://memory','w');
       foreach($users as $u){
          $u->survey_count=Survey_result::where('surveyor_id',$u->id)->where('survey_id',$survey_id)->whereDate('created_at',$date)->count();
          $row=[];
          $row=['name'=>$u->name,'mobile_number'=>$u->mobile_number,'email'=>$u->email,'survey_count'=>$u->survey_count];
          fputcsv($f,$row);
       }
        rewind($f) ;
        fseek($f,0);
        header('content-type:text/csv'); 
        header('Content-Disposition: attachment; filename="' .'User Report.csv'. '";');
        fpassthru($f);

  
    }

    public function deleteSurvey(Request $request, $auth_token){
      // $data= $request->input();
      // $auth_token=$data['auth_token'];
      $Survey= Survey::where('auth_token',$auth_token)->first();
      $Survey_resultCount=Survey_result::where('survey_id',$Survey->id)->count();
      if($Survey_resultCount){
          return redirect()
                ->back()
                ->with('success', "This survey can't be deleted, beacuse surveyors already started survey on this " );

      }else{
            Survey::where('id',$Survey->id)->delete();
            Question_group::where('survey_id',$Survey->id)->delete();
            Question::where('survey_id',$Survey->id)->delete();
            Option::where('survey_id',$Survey->id)->delete();
           return redirect()
                ->back()
                ->with('success', "Successfully deleted" );
      }
   }
    
    public function storeSurvey(Request $request){
        $this->validate(request(), [
           'file' => 'required|max:10000|mimes:json' //a required, max 10000kb, doc or docx file
        ]);
        try {
                $file = $request->file('file');
                $json = file_get_contents($file->getRealPath());
                $data= json_decode($json);
// //////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////
                $survey=($data->survey);
                /// survey Table/////
                $title= $survey->title;
                $description= $survey->description;
                $start_date= $survey->start_date;
                $end_date= $survey->end_date;
                $questions_groups= $survey->questions_group;     
                /// question_groups Table/////
                foreach($questions_groups as $questions_group){
                                    $title=$questions_group->title;
                                    $description=$questions_group->description;
                                 /// questions Table/////
                                 foreach($questions_group->question as $question){
                                        $title=$question->title;
                                        $type=$question->type;
                                        $unique_identifier=isset($question->unique_identifier)?$question->unique_identifier:'';
                                        $show_when=isset($question->show_when)?$question->show_when:'';
                                        $is_greater=isset($question->is_greater)?$question->is_greater:'';
                                        $unique_identifier=isset($question->unique_identifier)?$question->unique_identifier:'';
                                        $parent_question=isset($question->parent_question)?$question->parent_question:'';
                                        $is_lesser=isset($question->is_lesser)?$question->is_lesser:'';
                                        $readonly=isset($question->readonly)?$question->readonly:'false';
                                        $required=isset($question->required)?$question->required:'false';

                                            /// options Table/////
                                            if($question->type=='radio'|| $question->type=='checkbox' ||$question->type=='select'|| $question->type == 'dropdown'){
                                                   $options=$question->answer->options->option;
                                                         foreach($options as $option ){
                                                                  $option_text=$option->title;
                                                                  $option_value=$option->title;
                                                         }
                                            }
                                  }
                }


//////////v/v/v/v/v//v//v/v/v/v/e/sd/c/w/w/ef/we/f/w/f/wef/we/fwef/ew/f/we/f/we/f/we/ew/ew


       $survey=($data->survey);
       /// survey Table/////
       $title= $survey->title;
       $description= $survey->description;
       $start_date= $survey->start_date;
       $end_date= $survey->end_date;
       $questions_groups= $survey->questions_group;

                       $created_survey= Survey::create([
                            'title'=>$title,
                            'description'=>$description,
                            'start_date'=>$start_date,
                            'end_date'=>$end_date,
                            'auth_token'=>$this->createUniqueId(20)
                       ]);
       /// question_groups Table/////
       foreach($questions_groups as $questions_group){
                        $created_questions_group= Question_group::create([
                            'survey_id'=>$created_survey->id,
                            'title'=>$questions_group->title,
                            'description'=>$questions_group->description
                         ]);

                         /// questions Table/////
                         foreach($questions_group->question as $question){
                             $created_question= Question::create([
                                'survey_id'=>$created_survey->id,
                                'question_group_id'=>$created_questions_group->id,
                                'title'=>$question->title ,
                                'type'=>$question->type,
                                'unique_identifier'=>isset($question->unique_identifier)?$question->unique_identifier:'',
                                'show_when'=>isset($question->show_when)?$question->show_when:'',
                                'is_greater'=>isset($question->is_greater)?$question->is_greater:'',
                                'unique_identifier'=>isset($question->unique_identifier)?$question->unique_identifier:'',
                                'parent_question'=>isset($question->parent_question)?$question->parent_question:'',
                                'is_lesser'=>isset($question->is_lesser)?$question->is_lesser:'',
                                'readonly'=>isset($question->readonly)?$question->readonly:'false',
                                'required'=>isset($question->required)?$question->required:'false'
                              ]);
                                    /// options Table/////
                                    if($created_question->type=='radio'|| $created_question->type=='checkbox' ||$created_question->type=='select'|| $created_question->type == 'dropdown'){
                                           $options=$question->answer->options->option;
                                                 foreach($options as $option ){
                                                      $created_option=Option::create([
                                                          'survey_id'=>$created_survey->id,
                                                          'question_group_id'=>$created_questions_group->id,
                                                          'question_id'=>$created_question->id,
                                                          'option_text'=>$option->title,
                                                          'option_value'=>$option->title
                                                        ]);
                                                 }
                                    }
                          }
       }
     return redirect()
                ->back()
                ->with('success', 'New  Survey successfully added!');


/////////////////////////////////////////////////////////////////

                 } catch (ErrorException $e) {
                        return redirect()
                            ->back()
                            ->with('success', $e->getMessage());
                }catch (Throwable $e) 
                { 
                           return redirect()
                            ->back()
                            ->with('success', $e->getMessage());              
                              }
        }



 
public function sendSurveyEmail(){

$date=isset($_REQUEST['date'])?$_REQUEST['date']:date('Y_m_d');
 $allSurveys=Survey::where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
foreach($allSurveys as $surveys){
          $subject= $surveys->title .' Report: '.$date;
                      $Settings= Setting::where('id','1')->first();
         $emails= explode(',', $Settings->emails);

        $file = $date.'_file.csv';
        $url='https://recon.upicon.in/public/upload/'.$file;
        $sdata=[];
        $sdata['title']=$surveys->title;
        $sdata['url']=$url;
          \Mail::send('emails.email_dump', $sdata, function($message) use($emails,$subject)
                {
                    $message->to($emails)
                            ->subject($subject);
                    //$message->attachData(stream_get_contents($f), $filename);
                });

}
return 1;
}


  
 public function generateSurveyFileByDate(){
 $date=$_REQUEST['date'];
 $Survey_result=Survey_result::whereDate('created_at',$date )->  orderBy('surveyor_id','ASC')->paginate(10);
    foreach( $Survey_result as $result){
      $this->generateCsvFilter($result->id,$date);
    }
    
  
 }




 public function generateCsvFilter($survey_result_id,$date){
          $Survey_result=Survey_result::where('id',$survey_result_id)->first();
          $surveys= Survey::where('id',$Survey_result->survey_id)->first();
          $Question_groups=Question_group::where('survey_id',$surveys->id)->get();
          foreach($Question_groups as $Question_group){
           $Question_group->questions = Question::where('survey_id',$surveys->id)->where('question_group_id',$Question_group->id)->get();
          }
        $row_1=[];
        $row_1[]='Survey Date and Time';
        $row_1[]='Surveyer id';
               $row=[];
               $row[]=$Survey_result->created_at;
               $row[]=$Survey_result->surveyor_id;
              foreach($Question_groups as $Question_group){
                     $group_title=$Question_group->title;
                     $group_description=$Question_group->description;
                     $question_group_id=$Question_group->id;
                     foreach($Question_group->questions as $question){
                                         $groupDes='';
                                        if($group_description !=''){
                                        $groupDes='-('.$group_description.')';
                                        }
                                        $row_1[]=$group_title.$groupDes.'-'.$question->title;
                                       $question_id=$question->id;
                                $answer=Survey_answer::where('survey_result_id',$Survey_result->id)->where('surveyor_id',$Survey_result->surveyor_id)->where('survey_id',$Survey_result->survey_id)->where('question_group_id',$question_group_id)->where('question_id', $question->id)->first();
                                $row[]= isset($answer->answer)?$answer->answer:'';
                    }
                  }
                  $this->generateSurveyFile($row_1, $row,$date);
 }

   public function generateSurveyFile($header, $row, $date){
            $file = $date.'_file.csv';
            $destinationPath=public_path()."/upload/";
            if (!is_dir($destinationPath)) { 
                  mkdir($destinationPath,0777,true); 
                  
            } 
            if(file_exists($destinationPath.$file)){
                    $f=fopen($destinationPath.$file,'a'); 
                    fputcsv($f,$row);
            }else{
                $f=fopen($destinationPath.$file,'a');
               fputcsv($f,$header);
               fputcsv($f,$row);
            }
            rewind($f) ;
            fclose($f);     
  }


  public function generateCsv(){
//     use App\Models\Survey;
// use App\Models\Question_group;
// use App\Models\Question;
// use App\Models\Option;
// use App\Models\User;
// use App\Models\Survey_result;
// use App\Models\Survey_answer;
// use App\Models\Image;
// use App\Models\Setting;
   // 

    $offset=0 ;// start row index.
    $limit=50;
    if($_REQUEST['p']>=.5){
    $offset=  $_REQUEST['p']*100;
    $limit=50;
    }

// echo $offset;
// echo "<br>";
// echo $limit;
 //$date=date('Y-m-d');
$date="2021-08-12";
 $allSurveys=Survey::where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
foreach($allSurveys as $surveys){

   $Survey_result_count=Survey_result::where('survey_id',$surveys->id)->count();
   $survey_id=$surveys->id;
   if($Survey_result_count){
    $survey_id=$surveys->id;
     $Question_groups=Question_group::where('survey_id',$surveys->id)->get();
          foreach($Question_groups as $Question_group){
           $Question_group->questions = Question::where('survey_id',$surveys->id)->where('question_group_id',$Question_group->id)->get();
          }


 
        $Survey_results=Survey_result::whereDate('created_at',$date)->where('survey_id',$surveys->id)->offset($offset)->limit($limit)->orderBy('surveyor_id','ASC')->get();
        $AnswersData=[];
        $i=0;
        foreach($Survey_results as $Survey_result){
              $survey_result_id=$Survey_result->id;
              $surveyor_id=$Survey_result->surveyor_id;
              $survey_result_id=$Survey_result->id;
              $survey_id=$Survey_result->survey_id;
            
            foreach($Question_groups as $Question_group){
                    $Question_group->surveyor_id= $surveyor_id;
                    $Question_group->survey_date_time= $Survey_result->created_at;
                    $question_group_id=$Question_group->id;
                    $questions= $Question_group->questions;
                    foreach($questions as $question){
                     $question_id=$question->id;
                     $answer=Survey_answer::where('survey_result_id',$survey_result_id)->where('surveyor_id',$surveyor_id)->where('survey_id',$survey_id)->where('question_group_id',$question_group_id)->where('question_id', $question_id)->first();
                       $question->answer= isset($answer->answer)?$answer->answer:'';
                    
                    }

                  }

          $AnswersData[]=$Question_groups;
         
        }   

 
//////formating Start
     $row_1=[];
     $row_1[]='Survey Date and Time';
     $row_1[]='Surveyer id';
         foreach($AnswersData[0] as $a){
            $group_title=$a->title;
            $group_description=$a->description;
            foreach($a->questions as $questions){
                $groupDes='';
                if($group_description !=''){
                  $groupDes='-('.$group_description.')';
                }
                $row_1[]=$group_title.$groupDes.'-'.$questions->title;
            }
           
         }

  
       $f=fopen('php://memory','w');
       $header=$row_1;
        fputcsv($f,$header);
   

        foreach($Survey_results as $Survey_result){
              $survey_result_id=$Survey_result->id;
              $surveyor_id=$Survey_result->surveyor_id;
              $survey_result_id=$Survey_result->id;
              $survey_id=$Survey_result->survey_id;
                 $row=[];
                 $row[]=$Survey_result->created_at;
                 $row[]=$surveyor_id;

            foreach($Question_groups as $Question_group){
                    $Question_group->surveyor_id= $surveyor_id;
                    $Question_group->survey_date_time= $Survey_result->created_at;
                    $question_group_id=$Question_group->id;
                    $questions= $Question_group->questions;
                    foreach($questions as $question){
                     $question_id=$question->id;
                     $answer=Survey_answer::where('survey_result_id',$survey_result_id)->where('surveyor_id',$surveyor_id)->where('survey_id',$survey_id)->where('question_group_id',$question_group_id)->where('question_id', $question_id)->first();
                       $row[]= isset($answer->answer)?$answer->answer:'';
                    
                    }

                  }
                 fputcsv($f,$row);
                 unset($row);
        } 

        rewind($f) ;
        fseek($f,0);
 // header('content-type:text/csv'); 
 // header('Content-Disposition: attachment; filename="' .$surveys->title .'.csv'. '";');
 // fpassthru($f);

  $subject= $surveys->title .' Report: '.date('Y-m-d').'--Part:'.(($_REQUEST['p']*2)+1);
  $filename='surveys-result-'.date('Y-m-d').'.csv';
              //Setting::where('id','1')->update(['emails'=>$data['emails']]);
             $Settings= Setting::where('id','1')->first();
 $emails= explode(',', $Settings->emails);
$sdata=[];
$sdata['title']=$surveys->title;
  \Mail::send('emails.email_dump', $sdata, function($message) use($f, $filename,$emails,$subject)
        {
            $message->to($emails)
                    ->subject($subject);
            $message->attachData(stream_get_contents($f), $filename);
        });

        fclose($f);

   
 ///////////End ///////////////
   }
}

return true;
  // whereBetween('reservation_from', [$from, $to])

  }

  public  function createUniqueId( $delimiter = '-'){
            $str= \Hash::make(uniqid(time(), true));
            $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
            return $slug.uniqid(time(), true);
   }
    
        
}
