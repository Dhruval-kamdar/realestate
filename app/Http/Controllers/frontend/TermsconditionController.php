<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
class TermsconditionController extends Controller
{
    function __construct(){

    }

    public function termcondition(Request $request){

        $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || FAQs ';
        $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || FAQs';
        $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || FAQs';

        $data['css'] = array(
        );

        $data['plugincss'] = array();
        $data['pluginjs'] = array(           
        );

        $data['js'] = array();
        $data['funinit'] = array();
        return view('frontend.pages.termcondition.termcondition', $data);
    }
}