<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table ="plan";
    public function getdatatable(){
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'plan.id',
            1 => 'plan.planname',
            2 => 'plan.plandescription',
            2 => 'plan.created_at',
        );
        $query = Blog ::from('plan')
                    ->where('plan.is_deleted','0');

        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->select('plan.id','plan.planname','plan.created_at','plan.plandescription')
                ->get();
        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml = '';
            $actionhtml = '<a href="'.route('admin-view-plan',$row['id']).'"  class="btn btn-icon primary"  ><i class="fa fa-eye"></i></a>'
                    .'<a href="'.route('admin-edit-plan',$row['id']).'"  class="btn btn-icon primary"  ><i class="fa fa-edit"></i></a>'
                    .'<a href="" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  deleteBlog" data-id="' . $row["id"] . '" ><i class="fa fa-trash" ></i></a>';
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['planname'];
            $nestedData[] = $row['plandescription'];
            $nestedData[] = date("d-M-Y h:i:s",strtotime($row['created_at']));
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }


    public function add($request){

        $count = Plan::where("planname",$request->input('planname'))
                    ->count();

        if($count == 0){
            $objPlan = new Plan();
            $objPlan->planname =$request->input('planname');
            $objPlan->plandescription = $request->input('plandescription');
            $objPlan->is_deleted = "0";
            $objPlan->created_at = date("Y-m-d h:i:s");
            $objPlan->updated_at = date("Y-m-d h:i:s");
            if($objPlan->save()){                
                return "true";
            }else{                
                return "wrong";
            }
        }else{
            return "exits";
        }
    }
    public function edit($request){
        $count = Plan::where("planname",$request->input('planname'))
                    ->where("id","!=" , $request->input('id'))
                    ->count();
        if($count == 0){
            $objPlan = Plan::find($request->input('id')); 
            $objPlan->planname =$request->input('planname');
            $objPlan->plandescription = $request->input('plandescription');
            $objPlan->updated_at = date("Y-m-d h:i:s");
            if($objPlan->save()){                
                return "true";
            }else{                
                return "wrong";
            }
        }else{
            return "exits";
        }
    }

    public function editDetails($id){
        return Plan::select("planname","id","plandescription")
                    ->where("id",$id)
                    ->get();
    }
}
