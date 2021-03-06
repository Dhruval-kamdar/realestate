@extends('frontend.layout.layout')
@section('content')

@php

    if (!empty(Auth()->guard('users')->user())) {
        $data = Auth()->guard('users')->user();
    }
    if (!empty(Auth()->guard('agent')->user())) {
        $data = Auth()->guard('agent')->user();
    }
    if (!empty(Auth()->guard('agency')->user())) {
        $data = Auth()->guard('agency')->user();
    }
    if (!empty(Auth()->guard('company')->user())) {
        $data = Auth()->guard('company')->user();
    }
    
@endphp
<!--=================================
My profile -->
<section class="space-ptb mt-100">
    <div class="container">
      <div class="row">


        @include('frontend.pages.profile.details_header')

        <div class="col-12">
          <div class="section-title d-flex align-items-center">
            <h2>Edit profile </h2>
            
          </div>
          <form id="edit-profile" enctype="multipart/form-data" method="POST">@csrf
            <div class="form-row">

              <div class="form-group col-md-6">
                <label>User name</label>
                <input type="text" class="form-control" name="username" value="{{ $data['username'] }}">
              </div>


              <div class="form-group col-md-6">
                <label>Email address</label>
                <input type="text" class="form-control" readonly value="{{ $data['email'] }}">
              </div>

              <div class="form-group col-md-6">
                <label>Phone No</label>
                <input type="text" class="form-control" name="officeno" value="{{ $data['phoneno'] }}">
              </div>

              <div class="form-group col-md-6">
                <label>Profile Image</label>
                <input type="file" class="form-control" name="userimage">
              </div>
              
              @if($data['roles'] != "U")
                <div class="form-group col-md-12">
                    <label>About Me</label>
                    <textarea class="form-control" rows="4" name="aboutme">{{ $data['about'] }}</textarea>
                </div>
              @endif

              @if($data['roles'] == "AG")
                
                <div class="form-group col-md-6">
                  <label>Designation</label>
                <input type="text" class="form-control" name="designation" value="{{ $agentDetails[0]->designation }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="{{ $agentDetails[0]->facebook }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="{{ $agentDetails[0]->twitter }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Linkedin</label>
                  <input type="text" class="form-control" name="linkedin" value="{{ $agentDetails[0]->linkedin }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Website</label>
                  <input type="text" class="form-control" name="website" value="{{ $agentDetails[0]->website }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Licenses</label>
                  <input type="text" class="form-control" name="licenses" value="{{ $agentDetails[0]->licenses }}">
                </div>

                <div class="form-group col-md-12">
                  <label>Office Phone No</label>
                  <input type="text" class="form-control" name="officeno" value="{{ $agentDetails[0]->officeno }}">
                </div>

                

              @endif
              @if($data['roles'] == "AY")
                
                <div class="form-group col-md-6">
                  <label>Location</label>
                  <input type="text" class="form-control" name="location" value="{{ $agencyDetails[0]->location }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="{{ $agencyDetails[0]->facebook }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="{{ $agencyDetails[0]->twitter }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Linkedin</label>
                  <input type="text" class="form-control" name="linkedin" value="{{ $agencyDetails[0]->linkedin }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Website</label>
                  <input type="text" class="form-control" name="website" value="{{ $agencyDetails[0]->website }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Licenses</label>
                  <input type="text" class="form-control" name="licenses" value="{{ $agencyDetails[0]->licenses }}">
                </div>
                
                
                <div class="form-group col-md-6">
                  <label>Office Phone No</label>
                  <input type="text" class="form-control" name="officeno" value="{{ $agencyDetails[0]->officeno }}">
                </div>

                <div class="form-group col-md-12">
                  <label>Overview</label>
                  <textarea class="form-control" rows="4" name="overview">{{ $agencyDetails[0]->overview }}</textarea>
              </div>
                
              @endif
              @if($data['roles'] == "CC")
                
                <div class="form-group col-md-6">
                  <label>Location</label>
                  <input type="text" class="form-control" name="location" placeholder="Please enter your company location" value="{{ $companyDetails[0]->location }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Facebook</label>
                  <input type="text" class="form-control" name="facebook" placeholder="Please enter your company facebook link" value="{{ $companyDetails[0]->facebook }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Twitter</label> 
                  <input type="text" class="form-control" name="twitter" placeholder="Please enter your company twitter link" value="{{ $companyDetails[0]->twitter }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Linkedin</label>
                  <input type="text" class="form-control" name="linkedin" placeholder="Please enter your company linkedin link" value="{{ $companyDetails[0]->linkedin }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Website</label>
                  <input type="text" class="form-control" name="website" placeholder="Please enter your company website" value="{{ $companyDetails[0]->website }}">
                </div>

                <div class="form-group col-md-6">
                  <label>Licenses</label>
                  <input type="text" class="form-control" name="licenses" placeholder="Please enter your company licenses no" value="{{ $companyDetails[0]->licenses }}">
                </div>
                
                
                <div class="form-group col-md-6">
                  <label>Office Phone No</label>
                  <input type="text" class="form-control" name="officeno" placeholder="Please enter your company officr phone no" value="{{ $companyDetails[0]->officeno }}">
                </div>

                <div class="form-group col-md-12">
                  <label>Overview</label>
                  <textarea class="form-control" rows="4" placeholder="Please enter your company overview" name="overview">{{ $companyDetails[0]->overview }}</textarea>
              </div>
                
              @endif

              

              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block btnsubmit">Save Changes</button>
              </div>
            </div>
          </form>
         
        </div>
      </div>
    </div>
  </section>
  <!--=================================
  My profile -->
  
@endsection