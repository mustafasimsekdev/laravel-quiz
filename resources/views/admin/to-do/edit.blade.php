{{-- layout --}}
@extends('admin.layouts.contentLayoutMaster')

{{-- title --}}
@section('title', __('locale.Profile'))

{{-- vendor-style --}}
@section('vendor-style')
    <link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/select2/select2-materialize.css')}}" type="text/css">
@endsection

{{-- page-style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.min.css')}}">
    <style>
        .jconfirm-cell .container {
            width: 500px;
        }
    </style>
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('locale.To Do Edit')}}</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin/home')}}">{{__('locale.Home Page')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/to-do-list')}}">{{__('locale.To Do List')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('locale.To Do Edit')}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- content --}}
@section('content')
    <!-- to-do edit start -->
    <div class="section users-edit">
        <div class="card">
            <div class="card-content">
                <!-- <div class="card-body"> -->
                <ul class="tabs mb-2 row">
                    <li class="tab">
                        <a class="display-flex align-items-center" href="#account">
                            <i class="material-icons mr-1">person_outline</i><span>{{__('locale.General Information')}}</span>
                        </a>
                    </li>
                </ul>
                <div class="divider mb-3"></div>

                <div class="card">
                    <div class="card-content">
                        <form id="accountForm">
                        @csrf
                            <!-- to-do edit account form start -->
                            <input id="todo_id" name="todo_id" type="hidden"
                                   value="{{$toDo->id}}">
                            <div class="row">
                                <div class="col s12">
                                    <div class="row">
                                        <div class="col s6 input-field">
                                            <label for="headerTemp">{{__('locale.Header')}}</label>
                                            <input id="headerTemp" name="headerTemp" type="text"
                                                   value="{{$toDo->header}}"
                                                   data-error=".errorTxt2">
                                            <small class="errorTxt2"></small>
                                        </div>
                                        <div class="col s6 input-field">
                                            <label for="contentTemp">{{__('locale.Content')}}</label>
                                            <input id="contentTemp" type="text" name="contentTemp"
                                                   value="{{$toDo->content}}"
                                                   data-error=".errorTxt2">
                                            <small class="errorTxt2"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 input-field">
                                    <div class="switch">
                                        {{__('locale.Activity Status')}} :
                                        <label>
                                            {{__('locale.Active')}}
                                            <input type="checkbox" id="is_active"
                                                   name="is_active" {{$toDo->is_active == 1 ? "checked":''}}>
                                            <span class="lever"></span>
                                            {{__('locale.Passive')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="col s12 display-flex justify-content-end mt-3">
                                    <button type="submit"
                                            class="btn indigo waves-effect waves-light mr-2">
                                        {{__('locale.Save Changes')}}
                                    </button>
                                </div>
                            </div>
                            <!-- to-do edit account form ends -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- to-do edit ends -->
@endsection

{{-- vendor-script --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page-script --}}
@section('page-script')
    <script src="{{asset('js/scripts/page-users.min.js')}}"></script>
    <script>
        $('#accountForm').on('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(this);
            var headerTemp = $("#headerTemp").val();
            var contentTemp = $("#contentTemp").val();

            if (headerTemp == '' || contentTemp == '') {
                $.alert("{{__('locale.Enter the information completely')}}", "{{__('locale.Warning')}}");
            } else {
                $.ajax({
                    url: "{{ route('admin.todo.update') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 1) {
                            var status = 'green';
                        } else {
                            var status = 'red'
                        }
                        $.confirm({
                            title: 'Adminin Dikkatine!',
                            content: data.message,
                            type: status,
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: "{{__('locale.Ok')}}",
                                    btnClass: 'btn-red',
                                    action: function () {
                                        if (data.status == 1) {
                                            setTimeout("window.location='{{route('admin.todo.list')}}'", 500);
                                        } else {
                                            location.reload();
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function (data) {
                        alert(data.message);
                    }
                });
            }
        });

        //Jquery validate mesaj
        jQuery.extend(jQuery.validator.messages, {
            required: "{{__('locale.This field is required')}}.",
            minlength: jQuery.validator.format("{{__('locale.Please enter at least {0} characters')}}."),
        });
    </script>
@endsection
