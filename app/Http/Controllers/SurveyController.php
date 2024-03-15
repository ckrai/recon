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
use File;

class SurveyController extends Controller
{
    
    public function dashboard(Request $request){
    	  $data= $request->input();
        
    	  $surveys=Survey_result::where('surveyor_id',$data['user_id'])->count(); 
          $Survey_result_month=  Survey_result::where('surveyor_id',$data['user_id'])->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
          $Survey_result_today=Survey_result::where('surveyor_id',$data['user_id'])->whereDate('created_at', '=', date('Y-m-d'))
                        ->count();
                        
                        
           $now = \Carbon\Carbon::now();
           $weekStart = $now->subDays($now->dayOfWeek)->setTime(0, 0);
           $Survey_result_week=Survey_result::where('surveyor_id',$data['user_id'])->where('created_at', '>=', $weekStart)->count();             
                        
     	  
    	  return response()->json([
			            'message' => '',
			            'data' => ['surveys'=>$surveys,'today'=>$Survey_result_today,'week'=>$Survey_result_week,'month'=>$Survey_result_month],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
    } 


    public function getSurveyList(Request $request){
        $data=$request->input();
       // $user_id = $data['user_id']; 
        $today=date('Y-m-d');
        $Survey=Survey:: whereDate('start_date','<=', $today)
                 ->whereDate('end_date','>=', $today)
                 ->get();
            return response()->json([
                  'message' => 'Successfull',
                  'data' => $Survey,
                  'isError' => false,
                  'responseCode'=>200
              ], 200);     
                 
    }
	public function getSurvey(Request $request){
	    $data=$request->input();
	    
	    
        $auth_token=$data['auth_token'];
        $Survey=Survey::where('auth_token',$auth_token)->first();
        $Survey->questions_group_count=Question_group::where('survey_id',$Survey->id)->count();
        $Survey->questions_group=Question_group::where('survey_id',$Survey->id)->get();
         
        foreach($Survey->questions_group as $g){
          $g->question=Question::where('survey_id',$Survey->id)->where('question_group_id',$g->id)->get();
          foreach($g->question as $q){
            if($q->type=='radio'|| $q->type=='checkbox' ||$q->type=='select' || $q->type=='dropdown'){
               $q->options=Option::where('survey_id',$Survey->id)->where('question_group_id',$g->id)->where('question_id',$q->id)->get();
            }
          }
        } 
        
        
        

  
		 return response()->json([
			            'message' => '',
			            'data' => $Survey,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

	}




public function createSurvey(){
   try {
     $json= '{
  "survey": {
    "title": "MSME SURVEY",
    "description": "",
    "start_date": "2021-07-28",
    "end_date": "2021-08-28",
    "questions_group": [
      {
        "title": "General Data",
        "description": "",
        "question": [
          {
            "title": "Tehsil",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "District",
            "type": "dropdown",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Agra"
                  },
                  {
                    "title": "Aligarh"
                  },
                  {
                    "title": "Allahabad"
                  },
                  {
                    "title": "Ambedkar Nagar"
                  },
                  {
                    "title": "Amethi"
                  },
                  {
                    "title": "Amroha (J.P. Nagar)"
                  },
                  {
                    "title": "Auraiya"
                  },
                  {
                    "title": "Azamgarh"
                  },
                  {
                    "title": "Baghpat"
                  },
                  {
                    "title": "Bahraich"
                  },
                  {
                    "title": "Ballia"
                  },
                  {
                    "title": "Balrampur"
                  },
                  {
                    "title": "Banda"
                  },
                  {
                    "title": "Barabanki"
                  },
                  {
                    "title": "Basti"
                  },
                  {
                    "title": "Bhadohi"
                  },
                  {
                    "title": "Bijnor"
                  },
                  {
                    "title": "Budaun"
                  },
                  {
                    "title": "Bulandshahr"
                  },
                  {
                    "title": "Chandauli"
                  },
                  {
                    "title": "Chitrakoot"
                  },
                  {
                    "title": "Deoria"
                  },
                  {
                    "title": "Etah"
                  },
                  {
                    "title": "Etawah"
                  },
                  {
                    "title": "Faizabad"
                  },
                  {
                    "title": "Farrukhabad"
                  },
                  {
                    "title": "Fatehpur"
                  },
                  {
                    "title": "Firozabad"
                  },
                  {
                    "title": "Gautam Buddha Nagar"
                  },
                  {
                    "title": "Ghaziabad"
                  },
                  {
                    "title": "Ghazipur"
                  },
                  {
                    "title": "Gonda"
                  },
                  {
                    "title": "Gorakhpur"
                  },
                  {
                    "title": "Hamirpur"
                  },
                  {
                    "title": "Hapur (Panchsheel Nagar)"
                  },
                  {
                    "title": "Hardoi"
                  },
                  {
                    "title": "Hathras"
                  },
                  {
                    "title": "Jalaun"
                  },
                  {
                    "title": "Jaunpur"
                  },
                  {
                    "title": "Jhansi"
                  },
                  {
                    "title": "Kannauj"
                  },
                  {
                    "title": "Kanpur Dehat"
                  },
                  {
                    "title": "Kanpur Nagar"
                  },
                  {
                    "title": "Kanshiram Nagar (Kasganj)"
                  },
                  {
                    "title": "Kaushambi"
                  },
                  {
                    "title": "Kushinagar (Padrauna)"
                  },
                  {
                    "title": "Lakhimpur - Kheri"
                  },
                  {
                    "title": "Lalitpur"
                  },
                  {
                    "title": "Lucknow"
                  },
                  {
                    "title": "Maharajganj"
                  },
                  {
                    "title": "Mahoba"
                  },
                  {
                    "title": "Mainpuri"
                  },
                  {
                    "title": "Mathura"
                  },
                  {
                    "title": "Mau"
                  },
                  {
                    "title": "Meerut"
                  },
                  {
                    "title": "Mirzapur"
                  },
                  {
                    "title": "Moradabad"
                  },
                  {
                    "title": "Muzaffarnagar"
                  },
                  {
                    "title": "Pilibhit"
                  },
                  {
                    "title": "Pratapgarh"
                  },
                  {
                    "title": "RaeBareli"
                  },
                  {
                    "title": "Rampur"
                  },
                  {
                    "title": "Saharanpur"
                  },
                  {
                    "title": "Sambhal (Bhim Nagar)"
                  },
                  {
                    "title": "Sant Kabir Nagar"
                  },
                  {
                    "title": "Shahjahanpur"
                  },
                  {
                    "title": "Shamali (Prabuddh Nagar)"
                  },
                  {
                    "title": "Shravasti"
                  },
                  {
                    "title": "Siddharth Nagar"
                  },
                  {
                    "title": "Sitapur"
                  },
                  {
                    "title": "Sonbhadra"
                  },
                  {
                    "title": "Sultanpur"
                  },
                  {
                    "title": "Unnao"
                  },
                  {
                    "title": "Varanasi"
                  }
                ]
              }
            }
          },
          {
            "title": "Establishment Address",
            "type": "textarea",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "Udyog Registered",
            "unique_identifier": "udyog_registered",
            "type": "radio",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Yes"
                  },
                  {
                    "title": "No"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "udyog_registered",
            "show_when": "Yes",
            "title": "If yes Number",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "Class",
            "type": "checkbox",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Manufacturing"
                  },
                  {
                    "title": "Services"
                  }
                ]
              }
            }
          },
          {
            "title": "Sector",
            "unique_identifier": "sector",
            "type": "radio",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Repairing & Services"
                  },
                  {
                    "title": "Food products"
                  },
                  {
                    "title": "Hosiery Garments"
                  },
                  {
                    "title": "Wood products"
                  },
                  {
                    "title": "Metal products"
                  },
                  {
                    "title": "Leather products"
                  },
                  {
                    "title": "Wool Silk and Synthetic Fibre Textile"
                  },
                  {
                    "title": "Machinery & Part except electrical"
                  },
                  {
                    "title": "Other"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "sector",
            "show_when": "Other",
            "title": "If Any Other Sector Please specify",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "Year of Establishment",
            "unique_identifier": "year_of_establishment",
            "type": "year",
            "readonly": true,
            "required": true,
            "answer": ""
          }
        ]
      },
      {
        "title": "Details of the Business",
        "description": "",
        "question": [
          {
            "title": "Name of Business",
            "type": "text",
            "readonly": true,
            "required": true,
            "answer": ""
          },
          {
            "title": "Type of Unit",
            "type": "radio",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Micro"
                  },
                  {
                    "title": "Small"
                  },
                  {
                    "title": "Medium"
                  }
                ]
              }
            }
          },
          {
            "title": "Nature of Operation",
            "type": "radio",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Perennial"
                  },
                  {
                    "title": "Seasonal"
                  },
                  {
                    "title": "Casual"
                  }
                ]
              }
            }
          },
          {
            "title": "Nature Of Job",
            "type": "radio",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Unskilled"
                  },
                  {
                    "title": "Semi-Skilled"
                  },
                  {
                    "title": "Skilled"
                  }
                ]
              }
            }
          },
          {
            "title": "Nature Of Employment",
            "type": "radio",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Permanent"
                  },
                  {
                    "title": "Contractual"
                  },
                  {
                    "title": "Skilled"
                  }
                ]
              }
            }
          }
        ]
      },
      {
        "title": "Employee Size",
        "description": "",
        "question": [
          {
            "title": "2016-17",
            "parent_question": "year_of_establishment",
            "is_greater": 2016,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2017-18",
            "parent_question": "year_of_establishment",
            "is_greater": 2017,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2018-19",
            "parent_question": "year_of_establishment",
            "is_greater": 2018,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2019-20",
            "parent_question": "year_of_establishment",
            "is_greater": 2019,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2020-21",
            "parent_question": "year_of_establishment",
            "is_greater": 2020,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          }
        ]
      },
      {
        "title": "Details of the Finances and Expenses",
        "description": "Monthly Revenue/Earnings",
        "question": [
          {
            "title": "2016-17",
            "parent_question": "year_of_establishment",
            "is_greater": 2016,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2017-18",
            "parent_question": "year_of_establishment",
            "is_greater": 2017,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2018-19",
            "parent_question": "year_of_establishment",
            "is_greater": 2018,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2019-20",
            "parent_question": "year_of_establishment",
            "is_greater": 2019,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2020-21",
            "parent_question": "year_of_establishment",
            "is_greater": 2020,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          }
        ]
      },
      {
        "title": "Details of the Finances and Expenses",
        "description": "Monthly  Cost",
        "question": [
          {
            "title": "2016-17",
            "parent_question": "year_of_establishment",
            "is_greater": 2016,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2017-18",
            "parent_question": "year_of_establishment",
            "is_greater": 2017,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2018-19",
            "parent_question": "year_of_establishment",
            "is_greater": 2018,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2019-20",
            "parent_question": "year_of_establishment",
            "is_greater": 2019,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2020-21",
            "parent_question": "year_of_establishment",
            "is_greater": 2020,
            "type": "number",
            "readonly": false,
            "required": true,
            "answer": ""
          }
        ]
      },
      {
        "title": "Details of the Bank Credit Facilitation and Utilization",
        "description": "Loan Amount",
        "question": [
          {
            "title": "2016-17",
            "parent_question": "year_of_establishment",
            "unique_identifier": "loan_amount_2016",
            "is_greater": 2016,
            "type": "number",
            "readonly": false,
            "answer": ""
          },
          {
            "title": "2017-18",
            "unique_identifier": "loan_amount_2017",
            "parent_question": "year_of_establishment",
            "is_greater": 2017,
            "type": "number",
            "readonly": false,
            "answer": ""
          },
          {
            "title": "2018-19",
            "unique_identifier": "loan_amount_2018",
            "parent_question": "year_of_establishment",
            "is_greater": 2018,
            "type": "number",
            "readonly": false,
            "answer": ""
          },
          {
            "title": "2019-20",
            "unique_identifier": "loan_amount_2019",
            "parent_question": "year_of_establishment",
            "is_greater": 2019,
            "type": "number",
            "readonly": false,
            "answer": ""
          },
          {
            "title": "2020-21",
            "unique_identifier": "loan_amount_2020",
            "parent_question": "year_of_establishment",
            "is_greater": 2020,
            "type": "number",
            "readonly": false,
            "answer": ""
          }
        ]
      },
      {
        "title": "Details of the Bank Credit Facilitation and Utilization",
        "description": "Bank Name",
        "question": [
          {
            "title": "2016-17",
            "parent_question": "loan_amount_2016",
            "is_lesser": 1,
            "type": "dropdown",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Aryavart Gramin Bank"
                  },
                  {
                    "title": "Axis Bank"
                  },
                  {
                    "title": "Bandhan Bank"
                  },
                  {
                    "title": "Bank of Baroda"
                  },
                  {
                    "title": "Bank of India"
                  },
                  {
                    "title": "Bank of Maharastra"
                  },
                  {
                    "title": "Baroda UP Gramin Bank"
                  },
                  {
                    "title": "Canara Bank"
                  },
                  {
                    "title": "Central Bank of India"
                  },
                  {
                    "title": "HDFC Bank"
                  },
                  {
                    "title": "ICICI Bank"
                  },
                  {
                    "title": "IDBI Bank"
                  },
                  {
                    "title": "Indian Bank (Allahabad Bank)"
                  },
                  {
                    "title": "Indian Overseas Bank"
                  },
                  {
                    "title": "Indus Ind Bank"
                  },
                  {
                    "title": "J&K Bank"
                  },
                  {
                    "title": "Karnataka Bank"
                  },
                  {
                    "title": "Kotak Mahindra Bank"
                  },
                  {
                    "title": "Nainital Bank"
                  },
                  {
                    "title": "Punjab National Bank"
                  },
                  {
                    "title": "Prathima Bank"
                  },
                  {
                    "title": "Punjab & Sind Bank"
                  },
                  {
                    "title": "State Bank of India"
                  },
                  {
                    "title": "South Indian Bank"
                  },
                  {
                    "title": "The Federal Bank"
                  },
                  {
                    "title": "UCO Bank"
                  },
                  {
                    "title": "Union Bank of India"
                  },
                  {
                    "title": "UP Cooperative Bank"
                  },
                  {
                    "title": "YES Bank"
                  }
                ]
              }
            }
          },
          {
            "title": "2017-18",
            "parent_question": "loan_amount_2017",
            "is_lesser": 1,
            "type": "dropdown",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Aryavart Gramin Bank"
                  },
                  {
                    "title": "Axis Bank"
                  },
                  {
                    "title": "Bandhan Bank"
                  },
                  {
                    "title": "Bank of Baroda"
                  },
                  {
                    "title": "Bank of India"
                  },
                  {
                    "title": "Bank of Maharastra"
                  },
                  {
                    "title": "Baroda UP Gramin Bank"
                  },
                  {
                    "title": "Canara Bank"
                  },
                  {
                    "title": "Central Bank of India"
                  },
                  {
                    "title": "HDFC Bank"
                  },
                  {
                    "title": "ICICI Bank"
                  },
                  {
                    "title": "IDBI Bank"
                  },
                  {
                    "title": "Indian Bank (Allahabad Bank)"
                  },
                  {
                    "title": "Indian Overseas Bank"
                  },
                  {
                    "title": "Indus Ind Bank"
                  },
                  {
                    "title": "J&K Bank"
                  },
                  {
                    "title": "Karnataka Bank"
                  },
                  {
                    "title": "Kotak Mahindra Bank"
                  },
                  {
                    "title": "Nainital Bank"
                  },
                  {
                    "title": "Punjab National Bank"
                  },
                  {
                    "title": "Prathima Bank"
                  },
                  {
                    "title": "Punjab & Sind Bank"
                  },
                  {
                    "title": "State Bank of India"
                  },
                  {
                    "title": "South Indian Bank"
                  },
                  {
                    "title": "The Federal Bank"
                  },
                  {
                    "title": "UCO Bank"
                  },
                  {
                    "title": "Union Bank of India"
                  },
                  {
                    "title": "UP Cooperative Bank"
                  },
                  {
                    "title": "YES Bank"
                  }
                ]
              }
            }
          },
          {
            "title": "2018-19",
            "parent_question": "loan_amount_2018",
            "is_lesser": 1,
            "type": "dropdown",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Aryavart Gramin Bank"
                  },
                  {
                    "title": "Axis Bank"
                  },
                  {
                    "title": "Bandhan Bank"
                  },
                  {
                    "title": "Bank of Baroda"
                  },
                  {
                    "title": "Bank of India"
                  },
                  {
                    "title": "Bank of Maharastra"
                  },
                  {
                    "title": "Baroda UP Gramin Bank"
                  },
                  {
                    "title": "Canara Bank"
                  },
                  {
                    "title": "Central Bank of India"
                  },
                  {
                    "title": "HDFC Bank"
                  },
                  {
                    "title": "ICICI Bank"
                  },
                  {
                    "title": "IDBI Bank"
                  },
                  {
                    "title": "Indian Bank (Allahabad Bank)"
                  },
                  {
                    "title": "Indian Overseas Bank"
                  },
                  {
                    "title": "Indus Ind Bank"
                  },
                  {
                    "title": "J&K Bank"
                  },
                  {
                    "title": "Karnataka Bank"
                  },
                  {
                    "title": "Kotak Mahindra Bank"
                  },
                  {
                    "title": "Nainital Bank"
                  },
                  {
                    "title": "Punjab National Bank"
                  },
                  {
                    "title": "Prathima Bank"
                  },
                  {
                    "title": "Punjab & Sind Bank"
                  },
                  {
                    "title": "State Bank of India"
                  },
                  {
                    "title": "South Indian Bank"
                  },
                  {
                    "title": "The Federal Bank"
                  },
                  {
                    "title": "UCO Bank"
                  },
                  {
                    "title": "Union Bank of India"
                  },
                  {
                    "title": "UP Cooperative Bank"
                  },
                  {
                    "title": "YES Bank"
                  }
                ]
              }
            }
          },
          {
            "title": "2019-20",
            "parent_question": "loan_amount_2019",
            "is_lesser": 1,
            "type": "dropdown",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Aryavart Gramin Bank"
                  },
                  {
                    "title": "Axis Bank"
                  },
                  {
                    "title": "Bandhan Bank"
                  },
                  {
                    "title": "Bank of Baroda"
                  },
                  {
                    "title": "Bank of India"
                  },
                  {
                    "title": "Bank of Maharastra"
                  },
                  {
                    "title": "Baroda UP Gramin Bank"
                  },
                  {
                    "title": "Canara Bank"
                  },
                  {
                    "title": "Central Bank of India"
                  },
                  {
                    "title": "HDFC Bank"
                  },
                  {
                    "title": "ICICI Bank"
                  },
                  {
                    "title": "IDBI Bank"
                  },
                  {
                    "title": "Indian Bank (Allahabad Bank)"
                  },
                  {
                    "title": "Indian Overseas Bank"
                  },
                  {
                    "title": "Indus Ind Bank"
                  },
                  {
                    "title": "J&K Bank"
                  },
                  {
                    "title": "Karnataka Bank"
                  },
                  {
                    "title": "Kotak Mahindra Bank"
                  },
                  {
                    "title": "Nainital Bank"
                  },
                  {
                    "title": "Punjab National Bank"
                  },
                  {
                    "title": "Prathima Bank"
                  },
                  {
                    "title": "Punjab & Sind Bank"
                  },
                  {
                    "title": "State Bank of India"
                  },
                  {
                    "title": "South Indian Bank"
                  },
                  {
                    "title": "The Federal Bank"
                  },
                  {
                    "title": "UCO Bank"
                  },
                  {
                    "title": "Union Bank of India"
                  },
                  {
                    "title": "UP Cooperative Bank"
                  },
                  {
                    "title": "YES Bank"
                  }
                ]
              }
            }
          },
          {
            "title": "2020-21",
            "parent_question": "loan_amount_2020",
            "is_lesser": 1,
            "type": "dropdown",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Aryavart Gramin Bank"
                  },
                  {
                    "title": "Axis Bank"
                  },
                  {
                    "title": "Bandhan Bank"
                  },
                  {
                    "title": "Bank of Baroda"
                  },
                  {
                    "title": "Bank of India"
                  },
                  {
                    "title": "Bank of Maharastra"
                  },
                  {
                    "title": "Baroda UP Gramin Bank"
                  },
                  {
                    "title": "Canara Bank"
                  },
                  {
                    "title": "Central Bank of India"
                  },
                  {
                    "title": "HDFC Bank"
                  },
                  {
                    "title": "ICICI Bank"
                  },
                  {
                    "title": "IDBI Bank"
                  },
                  {
                    "title": "Indian Bank (Allahabad Bank)"
                  },
                  {
                    "title": "Indian Overseas Bank"
                  },
                  {
                    "title": "Indus Ind Bank"
                  },
                  {
                    "title": "JK Bank"
                  },
                  {
                    "title": "Karnataka Bank"
                  },
                  {
                    "title": "Kotak Mahindra Bank"
                  },
                  {
                    "title": "Nainital Bank"
                  },
                  {
                    "title": "Punjab National Bank"
                  },
                  {
                    "title": "Prathima Bank"
                  },
                  {
                    "title": "Punjab AND Sind Bank"
                  },
                  {
                    "title": "State Bank of India"
                  },
                  {
                    "title": "South Indian Bank"
                  },
                  {
                    "title": "The Federal Bank"
                  },
                  {
                    "title": "UCO Bank"
                  },
                  {
                    "title": "Union Bank of India"
                  },
                  {
                    "title": "UP Cooperative Bank"
                  },
                  {
                    "title": "YES Bank"
                  }
                ]
              }
            }
          }
        ]
      },
      {
        "title": "Details of the Bank Credit Facilitation and Utilization",
        "description": "Scheme Name under which it was availed",
        "question":[
        {
          "title": "Scheme",
          "type": "dropdown",
          "readonly": false,
          "answer": {
            "options": {
              "option": [
                {
                  "title": "ASPIRE"
                },
                {
                  "title": "ATI"
                },
                {
                  "title": "CLCS & TU"
                },
                {
                  "title": "CGTMSE"
                },
                {
                  "title": "Coir Upgradation"
                },
                {
                  "title": "Design Clinic"
                },
                {
                  "title": "Digital MSME"
                },
                {
                  "title": "ESDP"
                },
                {
                  "title": "GVY"
                },
                {
                  "title": "IC"
                },
                {
                  "title": "Incubators"
                },
                {
                  "title": "IPR"
                },
                {
                  "title": "ISEC"
                },
                {
                  "title": "Lean Manufacturing"
                },
                {
                  "title": "MSE-CDP"
                },
                {
                  "title": "MRIGI"
                },
                {
                  "title": "PMEGP/MUDRA"
                },
                {
                  "title": "PMS"
                },
                {
                  "title": "Rojgar Yukt Gaon"
                },
                {
                  "title": "Skills Upgradation"
                },
                {
                  "title": "SC-ST HUB"
                },
                {
                  "title": "SFURTI"
                },
                {
                  "title": "ZED"
                }
              ]
            }
          }
        }
        ]
      },
      {
        "title": "Details of the Bank Credit Facilitation and Utilization",
        "description": "Loan Amount Utilization",
        "question": [
          {
            "title": "2016-17",
            "unique_identifier": "loan_amount_utilization_2016_17",
            "parent_question": "loan_amount_2016",
            "is_lesser": 1,
            "required": true,
            "type": "checkbox",
            "readonly": false,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Business Expansion"
                  },
                  {
                    "title": "Land/Assets acquisition"
                  },
                  {
                    "title": "Procuring raw materials"
                  },
                  {
                    "title": "Disbursing Salaries and wages"
                  },
                  {
                    "title": "Marketing and Distribution"
                  },
                  {
                    "title": "Other"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "loan_amount_utilization_2016_17",
            "show_when": "Other",
            "title": "If Other Please specify",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2017-18",
            "unique_identifier": "loan_amount_utilization_2017_18",
            "parent_question": "loan_amount_2017",
            "is_lesser": 1,
            "required": true,
            "type": "checkbox",
            "readonly": false,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Business Expansion"
                  },
                  {
                    "title": "Land/Assets acquisition"
                  },
                  {
                    "title": "Procuring raw materials"
                  },
                  {
                    "title": "Disbursing Salaries and wages"
                  },
                  {
                    "title": "Marketing and Distribution"
                  },
                  {
                    "title": "Other"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "loan_amount_utilization_2017_18",
            "show_when": "Other",
            "title": "If Other Please specify",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2018-19",
            "parent_question": "loan_amount_2018",
            "unique_identifier": "loan_amount_utilization_2018_19",
            "is_lesser": 1,
            "required": [
              true,
              true
            ],
            "type": "checkbox",
            "readonly": false,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Business Expansion"
                  },
                  {
                    "title": "Land/Assets acquisition"
                  },
                  {
                    "title": "Procuring raw materials"
                  },
                  {
                    "title": "Disbursing Salaries and wages"
                  },
                  {
                    "title": "Marketing and Distribution"
                  },
                  {
                    "title": "Other"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "loan_amount_utilization_2018_19",
            "show_when": "Other",
            "title": "If Other Please specify",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2019-20",
            "parent_question": "loan_amount_2019",
            "unique_identifier": "loan_amount_utilization_2019_20",
            "is_lesser": 1,
            "required": true,
            "type": "checkbox",
            "readonly": false,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Business Expansion"
                  },
                  {
                    "title": "Land/Assets acquisition"
                  },
                  {
                    "title": "Procuring raw materials"
                  },
                  {
                    "title": "Disbursing Salaries and wages"
                  },
                  {
                    "title": "Marketing and Distribution"
                  },
                  {
                    "title": "Other"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "loan_amount_utilization_2019_20",
            "show_when": "Other",
            "title": "If Other Please specify",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "2020-21",
            "unique_identifier": "loan_amount_utilization_2020_21",
            "parent_question": "loan_amount_2020",
            "is_lesser": 1,
            "type": "checkbox",
            "readonly": false,
            "required": true,
            "answer": {
              "options": {
                "option": [
                  {
                    "title": "Business Expansion"
                  },
                  {
                    "title": "Land/Assets acquisition"
                  },
                  {
                    "title": "Procuring raw materials"
                  },
                  {
                    "title": "Disbursing Salaries and wages"
                  },
                  {
                    "title": "Marketing and Distribution"
                  },
                  {
                    "title": "Other"
                  }
                ]
              }
            }
          },
          {
            "parent_question": "loan_amount_utilization_2020_21",
            "show_when": "Other",
            "title": "If Other Please specify",
            "type": "text",
            "readonly": false,
            "required": true,
            "answer": ""
          }
        ]
      },
      {
        "title": "Photos",
        "description": "",
        "question": [
          {
            "title": "Person interviewed",
            "type": "photo",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "Signboard of Company",
            "type": "photo",
            "readonly": false,
            "required": true,
            "answer": ""
          },
          {
            "title": "Picture of business operation",
            "type": "photo",
            "readonly": false,
            "required": true,
            "answer": ""
          }
        ]
      }
    ]
  }
}'; 
echo "<pre>";
error_reporting(1);
$data= json_decode($json);
 /////////////////////////////////////////////////////////////////////////////////Validation Start 
 /////////////////////////////////////////////////////////////   
       $validator=[];
       $validator=[
            'title'=>$survey->title,
            'description'=>$survey->description,
            'start_date'=>$survey->start_date,
            'end_date'=>$survey->end_date,
       ];
       $validator['questions_group']= $survey->questionsnfgnf_group;
       /// question_groups Table/////
       foreach($validator['questions_group'] as $questions_group){
          $validator_questions_group=   [
                 'title'=>$questions_group->title,
                'description'=>$questions_group->description
              ];
             /// questions Table/////
             foreach($validator['questions_group']->question as $question){
                       $created_question=[
                          'title'=>$question->title ,
                          'type'=>$question->type
                        ];
                        /// options Table/////
                        if($validator['questions_group']->question->type=='radio'|| $validator['questions_group']->question->type=='checkbox' ||$validator['questions_group']->question->type=='select'){
                               $options=$validator['questions_group']->question->answer->options->option;
                                     foreach($options as $option ){
                                          $created_option=[
                                               'option_text'=>$option->title,
                                              'option_value'=>$option->title
                                            ];
                                     }
                        }
              }
       }
 /////////////////////////////////////////////////////////////////////////////////Validation End 
 ///////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////
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







     return response()->json([
                  'message' => '',
                  'data' => json_decode($json),
                  'isError' => false,
                  'responseCode'=>200
              ], 200);


    } catch (Throwable $e) {
        report($e);

        return false;
    }
  }

  public function submitAnswers(Request $request){
    $data=$request->input();
    
    $user_id = $data['user_id']; 
    $survey_id = $data['survey_id'];
    $title = $data['title'];
    $description = $data['description'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $questions_groups = json_decode($data['questions_group']);
    $lat = $data['lat'];
    $lan = $data['lan'];
    
    $user=User::where('id',$user_id)->first();
    if(!isset($user->id)){
             return response()->json([
                  'message' => 'Authentication faild',
                  'data' => [],
                  'isError' => true,
                  'responseCode'=>402
              ], 402);
        
    }
    
    
        //Survey_result
                    // 'surveyor_id',
                    // 'survey_id',
                    // 'lat',
                    // 'lan',
      
        $Survey_result=Survey_result::create([
            'surveyor_id'=>$user->id,
            'survey_id'=>$survey_id,
            'lat'=>$lat,
            'lan'=>$lan
        ]);
 
        
          foreach($questions_groups as $questions_group){
              $survey_id=$questions_group->survey_id;
              $title=$questions_group->title;
              $survey_result_id=$Survey_result->id;
              $questions=$questions_group->question;
              foreach($questions as $question){
                       Survey_answer::create([
                            'survey_result_id'=>$survey_result_id,
                            'surveyor_id'=>$user->id,
                            'survey_id'=>$question->survey_id,
                            'question_group_id'=>$question->question_group_id,
                            'question_id'=>$question->id,
                            'question'=>$question->title,
                            'answer'=>isset($question->user_answer)?$question->user_answer:'',
                        ]);
              }
          }

          $this->generateCsvFilter($Survey_result->id);
          
          return response()->json([
                  'message' => 'Successfully Added',
                  'data' => [],
                  'isError' => false,
                  'responseCode'=>200
              ], 200);
              
  }


 public function generateCsvFilter($survey_result_id){
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
                  $this->generateSurveyFile($row_1, $row);
 }


    public function generateSurveyFile($header, $row){
            $file = date('Y_m_d').'_file.csv';
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


public function imagesAll(Request $request){
            $data=$request->input();
            $user_id=$data['user_id'];
             
            $images= Image::where('user_id',$user_id)->paginate(10);
	        return response()->json([
	            'message' => 'All',
	            'data' => $images,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
 
}


    
 function uploads(Request $request){
 	        $data=$request->input();
            $user_id= $data['user_id'];
 

           if($request->has('file')) {
                    $fileName = time().time().time().'.'.$request->file->extension();  
                    $request->file->move(public_path('uploads/files'), $fileName); 
                     


			$filename_err = explode(".",$_FILES['file']['name']);
			$filename_err_count = count($filename_err);
			$file_ext = $filename_err[$filename_err_count-1];

            $thumbnail = public_path('uploads/files/thumb/').$fileName;
            $upload_image=public_path('uploads/files/').$fileName;
            list($width,$height) = getimagesize($upload_image);

              $ratio= $width/200;

              $thumb_width=$width/$ratio;
              $thumb_height=$height/$ratio;

            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            // switch($file_ext){
            //     case 'jpg' || 'jpeg':
            //         imagejpeg($thumb_create,$thumbnail,100);
            //         break;
            //     case 'png':
            //         imagepng($thumb_create,$thumbnail,100);
            //         break;

            //     case 'gif':
            //         imagegif($thumb_create,$thumbnail,100);
            //         break;
            //     default:
            //         imagejpeg($thumb_create,$thumbnail,100);
            // }

	          $image= Image::create([
						'image'=> $fileName, 
						//'thumb_image'=>'thumb/'.$fileName ,
						'user_id'=> $user_id,
	           ]);
 
           

              return response()->json([
			            'message' =>  'done',
			            'data' => $image,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

            }

		  
 }
 
 
  public  function createUniqueId( $delimiter = '-'){
            $str= \Hash::make(uniqid(time(), true));
            $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
            return $slug.uniqid(time(), true);
   }

}
