@extends('backend.layout.app_layout')
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group pull-right">
                            <a href="{{ route("admin-add-services") }}">
                                    <button id="sample_editable_1_new" class="btn sbold green"> Add New Services
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>@csrf
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="services">
                    <thead>
                        <tr>                            
                            <th>No</th>
                            <th>Services Image</th>
                            <th>Services Name</th>
                            <th>Services Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>   
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection