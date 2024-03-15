<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    //





	public function register(Request $request){
				$validatedData = $request->validate([
				'name' => 'required|string|max:255',
				                   'email' => 'required|string|email|max:255|unique:users',
				                   'password' => 'required|string|min:8',
				]);

		      $user = User::create([
		              'name' => $validatedData['name'],
		                   'email' => $validatedData['email'],
		                   'password' => Hash::make($validatedData['password']),
		       ]);

		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json([
		              'access_token' => $token,
		                   'token_type' => 'Bearer',
		]);
	}


	// public function login(Request $request){
	// 	  try {
	// 		    $data=$request->input();
	// 			$validator =  Validator::make($request->all(),[
	// 			    'email' => ['required', 'string', 'email', 'max:255'],
	// 			    'password' => ['required', 'string', 'min:8'],
	// 			]);

	// 		    if($validator->fails()){
	// 		        return response()->json([
	// 		            'message' => 'validation_error',
	// 		            'data' => $validator->errors(),
			            
	// 		            'responseCode'=>204
	// 		        ], 401);
	// 		    }


	// 		    $credentials = request(['email', 'password']);
	// 		    if (!Auth::attempt($credentials)) {
	// 		     return response()->json([
	// 		            'message' => 'validation_error',
	// 		            'data' => ['email'=>['email or password is wrong']],
	// 		            'isError' => true,
	// 		            'responseCode'=>201
	// 		        ], 401);



	// 		    }
	// 		    $user = User::where('email', $request->email)->first();
	// 		    if ( ! Hash::check($request->password, $user->password, [])) {

 //                      return response()->json([
	// 		            'message' => 'Error in  login',
	// 		            'data' => ['email'=>['email or password is wrong']],
	// 		            'isError' => true,
	// 		            'responseCode'=>201
	// 		        ], 401);
			       
	// 		    }
	// 		    $tokenResult = $user->createToken('authToken')->plainTextToken;
 //                    $user->auth_token=$tokenResult;
 //                    return response()->json([
	// 		            'message' => ' Successfully login',
	// 		            'data' => $user,
	// 		            'isError' => false,
	// 		            'responseCode'=>200
	// 		        ], 200);

	// 		  } catch (Exception $error) {
	// 		    return response()->json([
	// 		            'message' => $error,
	// 		            'data' => ['email'=>['email or password is wrong']],
	// 		            'isError' => true,
	// 		            'responseCode'=>201
	// 		        ], 401);
	// 		  }
	// }




	public function login(Request $request){
		  try {
			    $data=$request->input();
				$validator =  Validator::make($request->all(),[
				    'mobile_number' => ['required', 'string', 'max:255'],
				    'password' => ['required', 'string', 'min:8'],
				]);

			    if($validator->fails()){
			        return response()->json([
			            'message' => 'mobile number or password is wrong',
			            'data' => $validator->errors(),
			            
			            'responseCode'=>204
			        ], 401);
			    }


			    $credentials = request(['mobile_number', 'password']);
			    if (!Auth::attempt($credentials)) {
			     return response()->json([
			            'message' => 'mobile number or password is wrong',
			            'data' => ['mobile_number'=>['mobile_number or password is wrong']],
			            'isError' => true,
			            'responseCode'=>201
			        ], 401);



			    }
			    $user = User::where('mobile_number', $request->mobile_number)->first();
			    if ( ! Hash::check($request->password, $user->password, [])) {
                      return response()->json([
			            'message' => 'Error in  login',
			            'data' => ['mobile_number'=>['mobile_number or password is wrong']],
			            'isError' => true,
			            'responseCode'=>201
			        ], 401);
			       
			    }

              if($user->device_id !='' && $user->device_id != null){
                /////////////////////////////////////////////////////////////////////

			    $to_time = strtotime(date("Y-m-d h:i:sa"));
				$from_time = strtotime($user->last_login_check);
				$timeDiff= round(abs($to_time - $from_time) / 60,2); 
                 


                 if($timeDiff>35){
					    $user=User::where('mobile_number', $request->mobile_number)->update(['device_id'=>rand(1000000,100000000000000),'last_login_check'=>date("Y-m-d h:i:sa")]);
					    $user = User::where('mobile_number', $request->mobile_number)->first();
                        $user->condition="timeDiff>20";
                        $user->timeDiff=$timeDiff;
                        $user->to_time=date("Y-m-d h:i:sa");
                        $user->from_time=$from_time;
					    $tokenResult = $user->createToken('authToken')->plainTextToken;
		                    $user->auth_token=$tokenResult;
		                    return response()->json([
					            'message' => ' Successfully login',
					            'data' => $user,
					            'isError' => false,
					            'responseCode'=>200
					        ], 200);

                 }else{
					return response()->json([
					    'message' => 'Already Login in another device',
					    'data' => ['mobile_number'=>['Already Login in another device']],
					    'isError' => true,
					    'responseCode'=>401
					], 401);

                 }


              /////////////////////////////////////////////////////////////////////
              }else{
              	//if device id === blank
                $user=User::where('mobile_number', $request->mobile_number)->update(['device_id'=>rand(1000000,100000000000000),'last_login_check'=>date("Y-m-d h:i:sa")]);
			    $user = User::where('mobile_number', $request->mobile_number)->first();

			    $tokenResult = $user->createToken('authToken')->plainTextToken;
                    $user->auth_token=$tokenResult;
                    return response()->json([
			            'message' => ' Successfully login',
			            'data' => $user,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
              }


			  } catch (Exception $error) {
			    return response()->json([
			            'message' => 'mobile number or password is wrong',
			            'data' => ['mobile_number'=>['mobile number or password is wrong']],
			            'isError' => true,
			            'responseCode'=>201
			        ], 401);
			  }
	}


	public  function logout(Request $request)
	{   
		$data=$request->input();
		$user=User::where('device_id', $data['device_id'])->update(['device_id'=>'']);
		return response()->json([
			            'message' => ' Successfully logout',
			            'data' => '',
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

		 
	}


	
    public  function checkLogin(Request $request){
        $data=$request->input();
        if( $data['device_id'] !=''){
        $user=User::where('device_id', $data['device_id'])->first();
        if(isset($user->id)){
          User::where('device_id', $data['device_id'])->update(['last_login_check'=>date("Y-m-d h:i:sa")]);
          return response()->json([
			            'message' => ' Successfull',
			            'data' => $data['device_id'],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

        }else{
                 return response()->json([
			            'message' => 'logout',
			            'data' => $data['device_id'],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

        }
    }
    }
	public function me(Request $request){
	   return $request->user();
	}






}
