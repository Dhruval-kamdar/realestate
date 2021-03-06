<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use Session;
use App\Model\Extrafacilities;
use App\Model\PropertyAudio;
use App\Model\PropertyFloorPlan;
use App\Model\PropertyPhoto;
use App\Model\PropertyTourView;
use App\Model\PropertyVideo;
use App\Model\PropertyDetails;
use App\Model\Favourite;
use App\Model\Sendmail;
use App\Model\Propertyreview;
class PropertyController extends Controller
{
    
    function __construct(){
         parent::__construct();
    }

    public function propertylist(Request $request){
        $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Property List';
        $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Property List';
        $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Property List';
        $data['css'] = array(
            'toastr/toastr.min.css',
            'select2/select2.css',
            'range-slider/ion.rangeSlider.css',
        );
        $data['plugincss'] = array();
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'select2/select2.full.js',
            'range-slider/ion.rangeSlider.min.js',
        );

        $data['header'] = array(
            'title' => 'About Us',
            'breadcrumb' => array(
                'Home' => route("home"),
                'Property List' => "Property List",
        ));

        $data['js'] = array(
//            'js.cookie.min.js',
            'comman_function.js',
            'property.js',
            'home.js'
        );
        $data['funinit'] = array(
            'Home.init()',
            'Property.calculation()',
        );
        
        $session = $request->session()->all();
        
        if(isset($session['logindata'])){
            $objPropetyList = new PropertyDetails();
            $data['loginId'] = $session['logindata'][0]['id'];
            $data['favourite'] = $objPropetyList->faveProperty($session['logindata'][0]['id']);
        }else{
            $data['loginId'] = '';
            $data['favourite'] = '';
        }
        
        $objPropetyList = new PropertyDetails();
        $data['property'] = $objPropetyList->getPropertyList();
        
        $sale = 0;
        $rent = 0;
        $residential = 0;
        $commercial = 0;
        $shop = 0;
        $appratment = 0;
        $villa = 0;
        $office = 0;
      
        
        for($i=0; $i<count($data['property']); $i++){
            if($data['property'][$i]->offer == 'sale'){
                $sale = $sale + 1;
            }else if($data['property'][$i]->offer == 'rent'){
                $rent = $rent + 1;
            }
            
            if($data['property'][$i]->type == 'apartment'){
                $appratment = $appratment + 1;
            }else if($data['property'][$i]->type == 'commercial'){
                $commercial = $commercial + 1;
            }else if($data['property'][$i]->type == 'shop'){
                $shop = $shop + 1;
            }else if($data['property'][$i]->type == 'residential'){
                $residential = $residential + 1;
            }else if($data['property'][$i]->type == 'villa'){
                $villa = $villa + 1;
            }else if($data['property'][$i]->type == 'office'){
                $office = $office + 1;
            }
            
        }
        
        $data['final'] = array(
            'sale' => $sale,
            'rent' => $rent,
            'appratment' => $appratment,
            'commercial' => $commercial,
            'residential' => $residential,
            'shop' => $shop,
            'villa' => $villa,
            'office' => $office,
        );
        
        $objPropertyDetails = new PropertyDetails();
        $data['property_type'] = $objPropertyDetails->getPropertyType();
        
        return view('frontend.pages.property.propertylist', $data);
    }
    
   public function propertydetails(Request $request,$slug){
        if($request->isMethod("post")) {
            $objPropertyreview = new Propertyreview();
            $result = $objPropertyreview->addReview($request);
            if($result){
                $return['status'] = 'success';
                $return['message'] = 'Thank you for your review.Your review successfully added.';
                $return['redirect'] = route('property-details',$request->input('slug'));
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$("#loader").hide();$(".btnsubmit:visible").removeAttr("disabled");$(".btnsubmit:visible").text("Login");';
                $return['message'] = 'Invalid Login Id/Password';
            }
            return json_encode($return);
            exit();
        }


        $data['slug'] =$slug;
        $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Property Details';
        $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Property Details';
        $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Property Details';
        $data['css'] = array(
            'toastr/toastr.min.css',
            'datetimepicker/datetimepicker.min.css',
            'slick/slick-theme.css',
            'select2/select2.css',
            'jquery.fancybox.css',
            'components.min.css',
            'plugins.min.css',
        );
        $data['plugincss'] = array();
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'validate/jquery.validate.min.js',
            'slick/slick.min.js',
            'datetimepicker/moment.min.js',
            'datetimepicker/datetimepicker.min.js',
            'fancybox/source/jquery.fancybox.js',
            'select2/select2.full.js',
            'jquery.reel.js',
        );
        $data['header'] = array(
            'title' => 'About Us',
            'breadcrumb' => array(
                'Home' => route("home"),
                'Property List' => route("property"),
                'Property Details' => 'Property Details',
        ));
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'property.js',
        );
        $data['funinit'] = array(
            'Property.fancy()',
            'Property.mapint()',
            'Property.form()',
        );
        $objPropertyreview = new Propertyreview();
        $data['review'] = $objPropertyreview->getReview($slug);

        
        $session = $request->session()->all();
        
        $objPropetyDetail = new PropertyDetails();
        if(isset($session['logindata'])){
          $data['loginId'] = $session['logindata'][0]['id'];
          $data['favourite'] = $objPropetyDetail->faveProperty($session['logindata'][0]['id']);
        }else{
          $data['loginId'] = '';
          $data['favourite'] = '';
        }
        $objPropetyDetail = new PropertyDetails();
        $data['propertyDetail'] = $objPropetyDetail->getPropertyDetail($slug);

//        echo "<pre/>"; print_r($data['propertyDetail']); exit();

        $image = explode(',',$data['propertyDetail'][0]['images']);
        $url = route("property-details",$data['propertyDetail'][0]['slug']);
        
        $data['share_socail'] = array(
            'url' => $url,
            'title' => $data['propertyDetail'][0]['title'],
            'description' => $data['propertyDetail'][0]['about_property'],
            'image' => asset('public/upload/property_photo/'.$image[0]),
        );
        if(empty($data['propertyDetail'])){
            return redirect('property')->with('error', 'Property not found');
        }
        
        
        $data['recentPropety'] = $objPropetyDetail->getRecentProperty($slug);
        
        return view('frontend.pages.property.propertydetails', $data);
    }
    
    public function compareProperty(Request $request,$slug){
        
        $data['slug'] =$slug;
        $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Compare Property';
        $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Compare Property';
        $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Compare Property';
        $data['css'] = array(
        );
        $data['plugincss'] = array();
        $data['pluginjs'] = array(
        );
        $data['header'] = array(
            'title' => 'About Us',
            'breadcrumb' => array(
                'Home' => route("home"),
                'Compare Property' => 'Compare Property',
        ));
      
        $objExtrafacilities = new Extrafacilities();
        $data['other'] = $objExtrafacilities->getlist();
        $objPropetyDetail = new PropertyDetails();
        $data['compare'] = $objPropetyDetail->compareProperty($slug);
        
        unset($_COOKIE['slug1']);
        unset($_COOKIE['slug2']);
        
        setcookie('slug1', null, -1, '/'); 
        setcookie('slug2', null, -1, '/'); 
        
        return view('frontend.pages.property.compare', $data);
    }
    
    public function favourite(Request $request){
        
        if($request->isMethod("post")) {
            $objFav = new Favourite();
            $res = $objFav->addFav($request);
             if($res){
                    if($res == 'added'){
                        $return['message'] = 'Favourite added successfully';
                    }else{
                        $return['message'] = 'Favourite remove successfully';
                    }
                   $return['status'] = 'success';
                   $return['reload'] = 'true';
                    }else{
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();$(".btnsubmit:visible").removeAttr("disabled");$(".btnsubmit:visible").text("Login");';
                        $return['message'] = 'Invalid Login Id/Password';
                    }
               echo json_encode($return); exit(); 
        }else{
            return redirect('home');
        }
    }
    
    public function  videocallschedule(Request $request){
        if($request->isMethod("post")) {
            $objSendmail = new Sendmail();
            $res = $objSendmail->videocallschedule($request);
            if($res){
                $return['status'] = 'success';
                $return['message'] = 'Your schedule a video call request successfully sent to property owner .He/She will replay back soon';
                $return['redirect'] = route('property-details',$request->input('slug'));
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$("#loader").hide();$(".btnsubmit:visible").removeAttr("disabled");$(".btnsubmit:visible").text("Login");';
                $return['message'] = 'Invalid Login Id/Password';
            }
            return json_encode($return);
            exit();
        }else{
            return redirect('home');
        }
    }

    public function  contactowner(Request $request){
        if($request->isMethod("post")) {
            $objSendmail = new Sendmail();
            $res = $objSendmail->contactowner($request);
            if($res){
                $return['status'] = 'success';
                $return['message'] = 'Your request successfully sent to property owner .He/She will replay back soon';
                $return['redirect'] = route('home');
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$("#loader").hide();$(".btnsubmit:visible").removeAttr("disabled");$(".btnsubmit:visible").text("Login");';
                $return['message'] = 'Invalid Login Id/Password';
            }
            return json_encode($return);
            exit();
        }else{
            return redirect('home');
        }
    }
    
    public function  personalvisit(Request $request){
        if($request->isMethod("post")) {
            $objSendmail = new Sendmail();
            $res = $objSendmail->personalvisit($request);
            if($res){
                $return['status'] = 'success';
                $return['message'] = 'Your personal visit request successfully sent to property owner .He/She will replay back soon';
                $return['redirect'] = route('property-details',$request->input('slug'));
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$("#loader").hide();$(".btnsubmit:visible").removeAttr("disabled");$(".btnsubmit:visible").text("Login");';
                $return['message'] = 'Invalid Login Id/Password';
            }
            return json_encode($return);
            exit();
        }else{
            return redirect('home');
        }
    }
    
    public function reportProperty(Request $request , $propertyId){
        if(isset($propertyId)){
            $session = $request->session()->all();
                if(isset($session['logindata'])){
                    
                 if($request->isMethod("post")) {
                    $objPropertyDetails = new PropertyDetails();
                    $res = $objPropertyDetails->reportProperty($request,$propertyId,$session['logindata'][0]['id']);
                    if($res){
                        $return['status'] = 'success';
                        $return['message'] = 'Property reported successfully';
                        $return['redirect'] = route('property');
                    }else{
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();$(".btnsubmit:visible").removeAttr("disabled");$(".btnsubmit:visible").text("Login");';
                        $return['message'] = 'Invalid Login Id/Password';
                    }
                    return json_encode($return);
                    exit();
                 }
                    
                    $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Report Property';
                    $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Report Property';
                    $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Report Property';
                    $data['css'] = array(
                        'toastr/toastr.min.css',
                        
                    );
                    $data['plugincss'] = array();
                    $data['pluginjs'] = array(
                        'toastr/toastr.min.js',
                        'validate/jquery.validate.min.js',
                        'validate/additional-methods.min.js',
                        'jquery.appear.js',
                    );

                    $data['header'] = array(
                        'title' => 'Report Property',
                        'breadcrumb' => array(
                            'Home' => route("home"),
                            'Property List' => route("property"),
                            'Report Property' => 'Report Property',
                    ));
                    $data['js'] = array(
                        'comman_function.js',
                        'ajaxfileupload.js',
                        'jquery.form.min.js',
                        'propertyDetails.js',
                    );
                    $data['funinit'] = array(
                        'PropertyDetails.report()'
                    );
                    return view('frontend.pages.property.reportproperty', $data);
                }else{
                    return redirect('signin');
                }
        }else{
            return redirect('property');
        }
    }
    public function submitproperty(Request $request){
        
        $session = $request->session()->all();
            if(isset($session['logindata'])){
                if($request->isMethod("post")) {
                    
                    $objPropertyDetails = new PropertyDetails();
                    $res = $objPropertyDetails->addProperty($request,$session['logindata'][0]['id']);
                    if($res){
                        return back()->with('success', 'Property succesfully added');
                    }else{
                        return back()->with('error', 'Something goes to wrong please try again');
                    }
                }
            
            $objExtrafacilities = new Extrafacilities();
            $data['other'] = $objExtrafacilities->getlist();

            $data['title'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Submit Property Details';
            $data['description'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Submit Property Details';
            $data['keywords'] = Config::get( 'constants.PROJECT_NAME' ) . ' || Submit Property Details';
            $data['css'] = array(
                'bootstrap-fileinput/bootstrap-fileinput.css',
                'toastr/toastr.min.css',
                'owl-carousel/owl.carousel.min.css',
                'magnific-popup/magnific-popup.css',
                'select2/select2.css',
                'components.min.css',
                'plugins.min.css',
            );
            $data['plugincss'] = array();
            $data['pluginjs'] = array(
                'bootstrap-fileinput/bootstrap-fileinput.js',
                'toastr/toastr.min.js',
                'validate/jquery.validate.min.js',
                'validate/additional-methods.min.js',
                'jquery.appear.js',
                'counter/jquery.countTo.js',
                'bootstrap-wizard/jquery.bootstrap.wizard.min.js',
                'owl-carousel/owl.carousel.min.js',
                'select2/select2.full.js',
                
                'magnific-popup/jquery.magnific-popup.min.js',
            );

            $data['header'] = array(
                'title' => 'About Us',
                'breadcrumb' => array(
                    'Home' => route("home"),
                    'Property List' => route("property"),
                    'Property Submit' => 'Property Submit',
            ));
            $data['js'] = array(
                'comman_function.js',
                'ajaxfileupload.js',
                'jquery.form.min.js',
                'home.js',
                'propertyDetails.js',
                'map.js',
            );
            $data['funinit'] = array(
                'Home.init()',
                'PropertyDetails.init()'
            );
            return view('frontend.pages.property.submitproperty', $data);
        }else{
            return redirect('signin');
        }
    }


    public function approve(Request $request,$token){
            $objPropertyrequest = new Propertyrequest();
            $checkToken = $objPropertyrequest->checkToken($token);
    } 
}
