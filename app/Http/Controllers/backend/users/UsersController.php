<?php

namespace App\Http\Controllers\backend\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Userslist;
use Config;

class UsersController extends Controller
{
    //
    function __construct(){

    }

    public function list(Request $request){
        $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Users List';
        $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Users List';
        $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Users List';        
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
            'global/plugins/datatables/datatables.min.css',
            'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
        );
        $data['pluginjs'] = array(
            'customjs/plugins/toastr/toastr.min.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'users.js'
        );
        $data['funinit'] = array(
            'Users.init()'
        );
        $data['header'] = array(
            'title' => 'Users List',
            'breadcrumb' => array(
                'Dashboard' => route("admin-dashboard"),
                'Users List' => "Users List",
        ));
        return view('backend.pages.users.users.list', $data);
    }

    public function view(Request $request,$id){
        
        $objUserslist = new Userslist();
        $data['userDetails'] = $objUserslist->getUserDetails($id);

        $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Users Details';
        $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Users Details';
        $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Users Details';        
        $data['css'] = array(
        );
        $data['plugincss'] = array(
            
        );
        $data['pluginjs'] = array(
        );
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        $data['header'] = array(
            'title' => 'Users Details',
            'breadcrumb' => array(
            'Dashboard' => route("admin-dashboard"),
            'User List' => route("admin-user-list"),
            'Users Details' => "Users Details",
        ));
        return view('backend.pages.users.users.view', $data);
    }

    public function ajaxAction(Request $request){
        $action = $request->input('action');
        switch ($action) {
            
            case 'getdatatable':
                $objUserslist = new Userslist();
                $list = $objUserslist->getdatatable();
                    
                echo json_encode($list);
                break;
            
        }
    }
}
