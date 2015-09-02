<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Price extends Model {


/**
* Price listing array           
* @access public priceList
* @return array $priceData
*/

    public function priceList() {
        
        $whereConditions = ['is_delete' => '1'];
        $listArray = ['id','name','status'];

        $priceData = DB::table('price_grid')
                         ->select($listArray)
                         ->where($whereConditions)
                         ->get();

        return $priceData;
    }

/**
* Delete Price           
* @access public priceDelete
* @param  int $id
* @return array $result
*/ 

    public function priceDelete($id)
    {
        if(!empty($id))
        {
            $result = DB::table('price_grid')->where('id','=',$id)->update(array("is_delete" => '0'));
            return $result;
        }
        else
        {
            return false;
        }
    }


/**
* Price Detail           
* @access public priceDetail
* @param  int $priceId
* @return array $combine_array
*/  

    public function priceDetail($priceId) {

        $wherePriceConditions = ['id' => $priceId];
        $priceData = DB::table('price_grid')->where($wherePriceConditions)->get();


        $whereConditions = ['price_id' => $priceId];
        $listArray = ['item','time','charge','is_gps_distrib','is_gps_opt','is_per_line','is_per_order','is_per_screen_set'];
        $priceCharge = DB::table('price_grid_charges')->select($listArray)->where($whereConditions)->get();

        $combine_array['price'] = $priceData;
        $combine_array['allPriceGrid'] = $priceCharge;
        return $combine_array;
    }

/**
* Price Add          
* @access public priceAdd
* @param  array $data
* @return array $result
*/

    public function priceAdd($data,$priceData) {
        $data['created_date'] = date("Y-m-d H:i:s");
        $data['updated_date'] = date("Y-m-d H:i:s");
        $result = DB::table('price_grid')->insert($data);

        $priceid = DB::getPdo()->lastInsertId();

           foreach($priceData as $key => $link) 
              { 
                $priceData[$key]['price_id'] = $priceid;
                $result_vendor = DB::table('price_grid_charges')->insert($priceData[$key]);
              }

        return $priceid;
    }

/**
* Price Edit          
* @access public priceEdit
* @param  array $data
* @return array $result
*/
    public function priceEdit($data) {

        $data['updated_date'] = date("Y-m-d H:i:s");
        $whereConditions = ['id' => $data['id']];
        $result = DB::table('price_grid')->where($whereConditions)->update($data);
        return $result;
    }

/**
* Price charges data           
* @access public priceChargesEdit
* @param  array $data
* @return array $result
*/  

public function priceChargesEdit($priceData,$priceId) {
    
    DB::table('price_grid_charges')->where('price_id', '=', $priceId)->delete();
     
           foreach($priceData as $key => $link) 
              { 
                $priceData[$key]['price_id'] = $priceId;
                $result_vendor = DB::table('price_grid_charges')->insert($priceData[$key]);
              }
        return  $priceId;
    }


}
