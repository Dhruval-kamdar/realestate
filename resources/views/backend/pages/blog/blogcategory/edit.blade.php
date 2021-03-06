@extends('backend.layout.app_layout')
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
            @csrf
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form id="edit-category" class="form-horizontal" method="POST">
                    @csrf
                    <input name="id" type="hidden" class="form-control" value="{{ $details[0]->id }}"> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Category Name</label>
                            <div class="col-md-10">
                            <input name="category" type="text" class="form-control" value="{{ $details[0]->blogCategoryName }}"> </div>
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