@extends('backend.layout.app_layout')
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
            @csrf
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form id="edit-plan-details" class="form-horizontal" method="post">@csrf
                    <input name="id" type="hidden" class="form-control" value="{{ $editDetails[0]->id }}">                                
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Plan</label>
                                    <div class="col-md-8">
                                        <select name="plan" class="form-control">
                                            <option value="">Select Plan</option>
                                            @foreach($planlist as $key => $value)
                                                <option value="{{ $value->id }}"  {{ $editDetails[0]->planid == $value->id ? "selected='selected'" : "" }} >{{ $value->planname }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Plan Name</label>
                                    <div class="col-md-8">
                                        <input name="planname" type="text" class="form-control" placeholder="Please enter plan name" value="{{ $editDetails[0]->planname }}">                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Plan Price</label>
                                    <div class="col-md-8">
                                        <input name="planprice" type="text" class="form-control" placeholder="Please enter plan price" value="{{ $editDetails[0]->planprice }}">                                
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Plan Days</label>
                                    <div class="col-md-8">
                                        <input name="plandays" type="text" class="form-control" placeholder="Please enter plan days" value="{{ $editDetails[0]->plandays }}">                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Plan Property</label>
                                    <div class="col-md-8">
                                        <input name="planproperty" type="text" class="form-control" placeholder="Please enter plan property" value="{{ $editDetails[0]->planproperty }}">                                
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Plan Agent</label>
                                    <div class="col-md-8">
                                        <input name="planagent" type="text" class="form-control" placeholder="Please enter plan agent" value="{{ $editDetails[0]->planagent }}">                                
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn green">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>
@endsection