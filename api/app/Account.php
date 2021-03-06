<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Common;
use App\Login;
use Mail;
use DateTime;

class Account extends Model {

      public function __construct( Common $common, Login $login)
          {
        $this->common = $common;
        $this->login = $login;
        }
    /**
     * login verify function
     *
     *
     */
    public function GetCompanyData($parent_id) {
        $this->common->getDisplayNumber('users',$parent_id,'parent_id','id','yes');
        $admindata = DB::table('users as usr')
        				 ->leftJoin('roles as rol', 'usr.role_id', '=', 'rol.id')
        				 ->select('usr.name','usr.user_name','usr.display_number','usr.email','usr.remember_token','usr.status','rol.title','usr.id')
        				 ->where('usr.is_delete','=','1')
                         ->where('rol.slug','<>','CA')
                         ->where('parent_id','=',$parent_id)
                         ->where('is_delete','=','1')
                         ->orderBy('usr.id', 'desc')
        				 ->get();
        return $admindata;
    }
    public function InsertCompanyData($post)
    { 
        $post['display_number'] = $this->common->getDisplayNumber('users',$post['parent_id'],'parent_id','id');

    	$result = DB::table('users')->insert($post);

        $id = DB::getPdo()->lastInsertId();
        DB::table('staff')->insert(array('user_id'=>$id,'created_date'=>date("Y-m-d"),'is_delete'=>1));

    	return $id;
    }
    public function GetCompanybyId($id,$parent_id)
    {
    	$admindata = DB::table('users as usr')
        				 ->Join('roles as rol', 'usr.role_id', '=', 'rol.id')
                         ->leftJoin('staff as staff', 'staff.user_id', '=', 'usr.id')
        				 ->select('staff.*','usr.name','usr.user_name','usr.profile_photo','usr.email','usr.remember_token','usr.status','usr.id','usr.role_id','staff.id as staff_id')
        				 ->where('usr.id','=',$id)
        				 ->where('usr.is_delete','=','1')
                         ->where('usr.parent_id','=',$parent_id)
        				 ->get();
        return $admindata;
    }
    public function SaveCompanyData($post)
    {
    	if(!empty($post['id']))
    	{
    		$result = DB::table('users')->where('id','=',$post['id'])->update(array('role_id'=>$post['role_id'],'name'=>$post['name'],'email'=>$post['email'],'status'=>$post['status']));
    		return $result;
    	}
    	else
    	{
    		return 0;
    	}
    }
    public function DeleteCompanyData($id)
    {
    	if(!empty($id))
    	{
    		$result = DB::table('users')->where('id','=',$id)->update(array("is_delete" => '0'));
    		return $result;
    	}
    	else
    	{
    		return false;
    	}
    }


}
