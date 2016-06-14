<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Finishing extends Model {

    
    public function getFinishingdata($post)
    {
        $search = '';
        if(isset($post['filter']['name'])) {
            $search = $post['filter']['name'];
        }

        $listArray = [DB::raw('SQL_CALC_FOUND_ROWS c.client_company,o.id as order_id,f.id,f.qty,fc.category_name,f.status,f.note,f.category_id,c.client_id,f.time,f.start_time,f.end_time,f.est')];

        $finishingData = DB::table('orders as o')
                        ->leftJoin('finishing as f', 'o.id', '=', 'f.order_id')
                        ->leftJoin('client as c', 'o.client_id', '=', 'c.client_id')
                        ->leftJoin('finishing_category as fc', 'f.category_id', '=', 'fc.id')
                        ->select($listArray)
                        ->where('f.is_delete', '=', '1')
                        ->where('o.company_id', '=', $post['company_id']);

                        if($search != '')
                        {
                          $finishingData = $finishingData->Where(function($query) use($search)
                          {
                              $query->orWhere('order.name', 'LIKE', '%'.$search.'%')
                                    ->orWhere('staff.first_name', 'LIKE', '%'.$search.'%')
                                    ->orWhere('misc_type.value', 'LIKE', '%'.$search.'%')
                                    ->orWhere('client.client_company', 'LIKE', '%'.$search.'%');
                          });
                        }
                        if(isset($post['filter']['seller']))
                        {
                          $finishingData = $finishingData->whereIn('order.sales_id', $post['filter']['seller']);
                        }
                        if(isset($post['filter']['client']))
                        {
                          $finishingData = $finishingData->whereIn('order.client_id', $post['filter']['client']);
                        }
                        $finishingData = $finishingData->orderBy($post['sorts']['sortBy'], $post['sorts']['sortOrder'])
                        ->skip($post['start'])
                        ->take($post['range'])
                        ->get();

        $count  = DB::select( DB::raw("SELECT FOUND_ROWS() AS Totalcount;") );
        //dd(DB::getQueryLog());
        $returnData = array();
        $returnData['allData'] = $finishingData;
        $returnData['count'] = $count[0]->Totalcount;
        return $returnData;

        return $finishingData;  
    }

    public function addFinishing($data)
    {
        $result = DB::table('finishing')->insert($data);
        
        return $result;
    }

    public function updateFinishing($data)
    {
        $result = DB::table($data['table'])
                    ->where($data['where'])
                    ->update($data['field']);
        
        return $result;
    }



    public function deleteFinishing($id)
    {
        if(!empty($id))
        {
                $result = DB::table('finishing')->where('id','=',$id)->update(array("is_delete" => '1'));
                return $result;
        }
        else
        {
                return false;
        }
    }

    public function getFinishingDetailById($id)
    {
        $result = DB::table('finishing')->where('id','=',$id)->get();
        return $result;
    }
    
}