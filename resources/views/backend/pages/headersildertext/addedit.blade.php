@extends('backend.layout.app_layout')
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
            @csrf
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form id="add-slider-text" class="form-horizontal" method="post">@csrf

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">Slider Text</label>
                            <div class="col-md-10">
                            <input type="text" name="text" class="form-control" placeholder="Please enter your slider text" value="{{ count($details) > 0 ? $details[0]->text : '' }}">
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