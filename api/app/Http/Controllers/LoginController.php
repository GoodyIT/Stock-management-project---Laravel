<?php

namespace App\Http\Controllers;
require_once(app_path() . '/constants.php');

use App\Login;
use App\Common;
use Mail;
use Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use DB;
use Image;
use Request;




class LoginController extends Controller {  
    

/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Login $login, Common $common) {

        $this->login = $login;
        $this->common = $common;
    }

/** 
 * @SWG\Definition(
 *      definition="Login",
 *      type="object",
 *      required={"email", "password"},
 *      @SWG\Property(
 *          property="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          type="string"
 *      )
 * )
 */


    /**
     * Check login functionality.
     *
     * @param  $email,$password
     * @return Response- session
     */
     /**
     * @SWG\Post(
     *  path = "/api/public/admin/login",
     *  summary = "Login",
     *  tags={"Login"},
     *  description = "Login to the application using email and password",
     *  @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Login credentials",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Login")
     *  ),
     *  @SWG\Response(response=200, description="Login to system"),
     *  @SWG\Response(response="default", description="Invalid Credentials"),
     * )
     */

    public function loginverify() {
 
        $data = Input::all();

        if(!empty($data['email']) && !empty($data['password']))
        {
            


            $email = htmlentities(trim($data['email']));
            $password = htmlentities($data['password']);
            
            $result = $this->login->verifylogin($email, $password);

            if (count($result) > 0) 
            {
                if(empty($result[0]->title) || empty( $result[0]->slug) || empty($result[0]->email ))
                {
                    $response = array('success' => 0, 'message' => SOMETHING_WRONG);
                }
                else
                {
                    $session = array();
                    $token = $this->login->getToken(10); // RANDOM STRING+CURRENT_TIMESTAMP

                    $company = $this->common->CompanyService($result[0]->id);

                    $result[0]->profile_photo = (!empty($result[0]->profile_photo) && file_exists(FILEUPLOAD.$company[0]->company_id."/staff/".$result[0]->id."/".$result[0]->profile_photo))?UPLOAD_PATH.$company[0]->company_id."/staff/".$result[0]->id."/".$result[0]->profile_photo:"assets/images/avatars/profile-avatar.png";

                    $company[0]->company_id = (empty($company[0]->company_id))?0:$company[0]->company_id;
                    //echo "<pre>"; print_r($company); echo "</pre>"; die;
                    DB::table('login_token')->insert(['token'=>$token,'user_id'=>$result[0]->id,'company_id'=>$company[0]->company_id,'date'=>date('Y-m-d H:i:s')]);
                    

                    //echo "<pre>"; print_r($result); echo "</pre>"; die;
                    Session::put('username',$result[0]->user_name);
                    Session::put('password', md5($password));
                    Session::put('useremail', $result[0]->email);
                    Session::put('role_title', $result[0]->title);
                    Session::put('role_slug', $result[0]->slug);
                    Session::put('name', $result[0]->name);
                    Session::put('user_id', $result[0]->id);
                    $loginid = $this->login->loginRecord($result[0]->id);
                    Session::put('login_id', $loginid);
                    Session::put('company_id',  $company[0]->company_id);
                    Session::put('company_name',  $company[0]->company_name);
                    Session::put('profile_photo',  $result[0]->profile_photo);
                    if($result[0]->reset_password=='1'){
                        Session::put('reset_password',  $result[0]->reset_password);
                    }
                    
                    Session::put('token',  $token);
                    
                    $session['name'] = $result[0]->name;
                    $session['username'] = $result[0]->user_name;
                    //$session['password'] = md5($password);
                    $session['useremail'] = $result[0]->email;
                    $session['role_title'] = $result[0]->title;
                    $session['role_slug'] = $result[0]->slug;
                    $session['login_id'] = $loginid;
                    $session['user_id'] = $result[0]->id;
                    $session['token'] = $token;
                    $session['company_id'] = $company[0]->company_id;
                    $session['company_name'] = $company[0]->company_name;
                    $session['profile_photo'] = $result[0]->profile_photo;
                    if($result[0]->reset_password=='1'){
                        $session['reset_password'] = $result[0]->reset_password;
                    }
                    
                    

                    $response = array('records'=>$session,'success' => 1, 'message' => LOGIN_SUCCESS);
                }
            } 
            else 
            {
                $response = array('success' => 0, 'message' => LOGIN_WRONG);
            }

        }
        else
        {
            $response = array('success' => 0, 'message' => FILL_PARAMS);
        }
        return response()->json(["data" => $response]);
    }

    /**
     * log out
     *
     * @return Response
     */
    public function logout() 
    {
        if (!empty(Request::header('Authorization'))) 
        {
            $headers = Request::header('Authorization');
            $this->login->loginRecordUpdate($headers);
            Session::flush(); 
            $response = array('success' => 1, 'message' => "Logout successfully.");
        }
        else
        {
            $response = array('success' => 0, 'message' => "Invalid Token");
        }
        return response()->json(["data" => $response]);
    }

    /**
     * log out
     *
     * @return Response
     */
    public function check_session() 
    {
        $data = Input::all();

            if(!empty($data['refresh']) && $data['refresh']==1)
            {
                Session::put('profile_photo', '');
                $result = $this->common->GetTableRecords('users',array('id' => Session::get("user_id")),array());
                $result[0]->profile_photo = (!empty($result[0]->profile_photo) && file_exists(FILEUPLOAD.Session::get("company_id")."/staff/".$result[0]->id."/".$result[0]->profile_photo))?UPLOAD_PATH.Session::get("company_id")."/staff/".$result[0]->id."/".$result[0]->profile_photo:"assets/images/avatars/profile-avatar.png";

                Session::put('profile_photo',  $result[0]->profile_photo);
                $session['profile_photo'] = $result[0]->profile_photo;

                //echo "<pre>"; print_r($result); echo "</pre>"; die;
            }

            if (!empty(Session::get("useremail"))) {
                //$result = $this->common->CompanyService(Session::get("user_id"));
            $response = array('success' => 1, 
                              'message' => "session there",
                              "user_id"=>Session::get("user_id"),
                              "login_id"=>Session::get("login_id"),
                              'role_title'=>Session::get('role_title'),
                              "name"=>Session::get("name"),
                              "company_name"=>Session::get('company_name'),
                              "email" => Session::get("useremail"),
                              "role_session"=>Session::get("role_slug"),
                              "company_id"=>Session::get("company_id"),
                              "profile_photo"=>Session::get("profile_photo"),
                              "token"=>Session::get("token")
                              );
        } else {
           $response = array('success' => 0, 'message' => LOGIN_WRONG);
        }
        return response()->json(["data" => $response]);
    }

 
/** 
 * @SWG\Definition(
 *      definition="Forgot",
 *      type="object",
 *      required={"email"},
 *      @SWG\Property(
 *          property="email",
 *          type="string"
 *      )
 * )
 */

 /**
 * @SWG\Post(
 *  path = "/api/public/admin/forgot_password",
 *  summary = "Forgot Password",
 *  tags={"Login"},
 *  description = "Forgot Password",
 *  @SWG\Parameter(
 *     in="body",
 *     name="body",
 *     description="Forgot Password",
 *     required=true,
 *     @SWG\Schema(ref="#/definitions/Forgot")
 *  ),
 *  @SWG\Response(response=200, description="Forgot Password"),
 *  @SWG\Response(response="default", description="Invalid Credentials"),
 * )
 */
    public function forgot_password()
    {
         $data = Input::all();

         //echo "<pre>"; print_r($data); echo "</pre>"; die;
         if(!empty($data['email']))
         {
            $result = $this->login->forgot_password(trim($data['email']));
            if(count($result)>0)
            { 
                $url = $this->login->ResetEmail($result[0]->email,$result[0]->id,$result[0]->password);
                $email = trim($result[0]->email);
                Mail::send('emails.send', ['url' => $url,'user'=>$result[0]->name,'email'=>trim($result[0]->email)], function($message) use ($email)
                {
                    $message->to($email, 'Hello, Please Click below link to change Stokkup Password.')->subject('Reset Password for Stokkup');
                });


                $response = array('success' => 1, 'message' => MAIL_SEND);
            }
            else
            {
                $response = array('success' => 0, 'message' => NO_RECORDS.", Please check Email");
            }
            //echo "<pre>"; print_r($result); echo "</pre>"; die;
         }
         else
         {
            $response = array('success' => 0, 'message' => MISSING_PARAMS);
         }
         return response()->json(["data" => $response]);
    }

    /**
     * checnk user details from forget password email link
     *
     * @param  $url details
     * @return Response
     */
    public function check_user_password()
    {
        $data = Input::all();
        
        
         if(!empty($data)) 
         {
            $pos = strpos($data['string'],'&');
            if ($pos !== false) 
            {
                list($string, $email) = explode('&', trim($data['string'])); 
              
                $email = base64_decode($email);
               // echo $email;
                $result = $this->login->check_user_password(trim($string),trim($email));

                //echo "<pre>"; print_r($result); echo "</pre>"; die;
                if(count($result)>0)
                {
                    $response = array('success' => 1, 'message' => GET_RECORDS, 'result'=>$result);
                }
                else
                {
                    $response = array('success' => 0, 'message' =>  MAIL_LINK_EXPIRE);
                }
               
            }
            else
            {
                $response = array('success' => 0, 'message' => MISSING_PARAMS);
            }
         }
         else
         {
            $response = array('success' => 0, 'message' => MISSING_PARAMS);
         }
         return response()->json(["data" => $response]);
    }
    /**
     * checnk user details from forget password email link
     *
     * @param  $url details
     * @return Response
     */
    public function change_password()
    {
        $data = Input::all();
        if(!empty($data) && !empty($data['form_data']) && !empty($data['string'])) 
        {
            if($data['form_data']['password']!=$data['form_data']['confirm_password'])
            {
                $response = array('success' => 0, 'message' => PASSWORD_NOT_MATCH);
                return response()->json(["data" => $response]);
            }

            $pos = strpos($data['string'],'&');
            if ($pos !== false) 
            {
                list($string, $email) = explode('&', trim($data['string'])); 
              
                $email = base64_decode($email);
                //echo $string;
                $result = $this->login->check_user_password(trim($string),trim($email));

                //echo "<pre>"; print_r($result); echo "</pre>"; die;
                if(count($result)>0)
                {
                    ///echo $data['form_data']['password']; die;
                    $this->login->change_password(trim($string),trim($email),$data['form_data']['password']);
                    $response = array('success' => 1, 'message' => PASSWORD_CHANGE, 'result'=>$result);
                }
                else
                {
                    $response = array('success' => 0, 'message' =>  MAIL_LINK_EXPIRE);
                }
               
            }
            else
            {
                $response = array('success' => 0, 'message' => MISSING_PARAMS);
            }
        }
        else
        {
            $response = array('success' => 0, 'message' => MISSING_PARAMS);
        }
         return response()->json(["data" => $response]);
    }


    public function loginUser() {
 
        $data = Input::all();
        

        if(!empty($data['email']) && !empty($data['id']))
        {
            


            $email = htmlentities(trim($data['email']));
            $id = htmlentities($data['id']);
            
            $result = $this->login->verifyloginUser($email, $id);


            if (count($result) > 0) 
            {
                if(empty($result[0]->title) || empty( $result[0]->slug) || empty($result[0]->email ))
                {
                    $response = array('success' => 0, 'message' => SOMETHING_WRONG);
                }
                else
                {
                    $oldLoginId = 0;
                    $oldEmail = '';
                    if($data['relogin'] == 0){
                         $oldLoginId =Session::get("user_id");
                         $oldEmail=Session::get("useremail");
                    } 
                   

                  //     print_r($userId);exit;
                  //   print_r($result[0]->id);exit;

                   // $this->common->UpdateTableRecords('users',array('id' => $result[0]->id),array('user_login' => $userId));
                  
                   // $data = $this->logout();

                    

                    $session = array();
                    $token = $this->login->getToken(10); // RANDOM STRING+CURRENT_TIMESTAMP

                    $company = $this->common->CompanyService($result[0]->id);

                    $result[0]->profile_photo = (!empty($result[0]->profile_photo) && file_exists(FILEUPLOAD.$company[0]->company_id."/staff/".$result[0]->id."/".$result[0]->profile_photo))?UPLOAD_PATH.$company[0]->company_id."/staff/".$result[0]->id."/".$result[0]->profile_photo:"assets/images/avatars/profile-avatar.png";

                    $company[0]->company_id = (empty($company[0]->company_id))?0:$company[0]->company_id;
                    //echo "<pre>"; print_r($company); echo "</pre>"; die;
                    DB::table('login_token')->insert(['token'=>$token,'user_id'=>$result[0]->id,'company_id'=>$company[0]->company_id,'date'=>date('Y-m-d H:i:s')]);
                    

                    //echo "<pre>"; print_r($result); echo "</pre>"; die;
                    Session::put('username',$result[0]->user_name);
                    Session::put('password', $result[0]->password);
                    Session::put('useremail', $result[0]->email);
                    Session::put('role_title', $result[0]->title);
                    Session::put('role_slug', $result[0]->slug);
                    Session::put('name', $result[0]->name);
                    Session::put('user_id', $result[0]->id);
                    $loginid = $this->login->loginRecord($result[0]->id);
                    Session::put('login_id', $loginid);

                     Session::put('oldLoginId', 0);
                     Session::put('oldEmail', '');

                    if($data['relogin'] == 0){

                        Session::put('oldLoginId', $oldLoginId);
                        Session::put('oldEmail', $oldEmail);
                    
                     }

                    Session::put('company_id',  $company[0]->company_id);
                    Session::put('company_name',  $company[0]->company_name);
                    Session::put('profile_photo',  $result[0]->profile_photo);
                    if($result[0]->reset_password=='1'){
                        Session::put('reset_password',  $result[0]->reset_password);
                    }
                    
                    Session::put('token',  $token);
                    
                    $session['name'] = $result[0]->name;
                    $session['username'] = $result[0]->user_name;
                    //$session['password'] = md5($password);
                    $session['useremail'] = $result[0]->email;
                    $session['role_title'] = $result[0]->title;
                    $session['role_slug'] = $result[0]->slug;
                    $session['login_id'] = $loginid;

                     $session['oldLoginId'] = 0;
                     $session['oldEmail'] = '';

                    if($data['relogin'] == 0){

                        $session['oldLoginId'] = $oldLoginId;
                        $session['oldEmail'] = $oldEmail;
                    }

                    $session['user_id'] = $result[0]->id;
                    $session['token'] = $token;
                    $session['company_id'] = $company[0]->company_id;
                    $session['company_name'] = $company[0]->company_name;
                    $session['profile_photo'] = $result[0]->profile_photo;
                    if($result[0]->reset_password=='1'){
                        $session['reset_password'] = $result[0]->reset_password;
                    }
                    
                    

                    $response = array('records'=>$session,'success' => 1, 'message' => LOGIN_SUCCESS);
                }
            } 
            else 
            {
                $response = array('success' => 0, 'message' => LOGIN_WRONG);
            }

        }
        else
        {
            $response = array('success' => 0, 'message' => FILL_PARAMS);
        }
        return response()->json(["data" => $response]);
    }


}
