<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Company extends Model {

    /**
     * login verify function
     *
     *
     */
    public function GetCompanyData() {
        $admindata = DB::table('users as usr')
        				 ->leftJoin('roles as rol', 'usr.role_id', '=', 'rol.id')
        				 ->select('usr.name','usr.user_name','usr.email','usr.remember_token','usr.status','rol.title','usr.id')
        				 ->where('usr.is_delete','=','1')
                         ->where('rol.slug','=','CA')
                         ->get();
        return $admindata;
    }
    public function InsertCompanyData($post)
    {
    	$result = DB::table('users')->insert($post);
    	return $result;
    }
    public function GetCompanybyId($id,$company_id)
    {
    	$admindata = DB::table('users as usr')
        				 ->leftJoin('roles as rol', 'usr.role_id', '=', 'rol.id')
        				 ->select('usr.name','usr.user_name','usr.email','usr.password','usr.remember_token','usr.status','usr.id','usr.role_id')
        				 ->where('usr.id','=',$id)
        				 ->where('usr.is_delete','=','1')
        				 ->where('usr.role_id','=',$company_id)
        				 ->get();
        return $admindata;
    }
    public function SaveCompanyData($post)
    {
    	if(!empty($post['id']))
    	{
    		$result = DB::table('users')->where('id','=',$post['id'])->update($post);
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
    		$result = DB::table('users')->where('parent_id','=',$id)->update(array("is_delete" => '0'));
    		return $result;
    	}
    	else
    	{
    		return false;
    	}
    }


}