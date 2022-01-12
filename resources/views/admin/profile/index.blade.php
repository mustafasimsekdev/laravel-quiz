{{-- layout --}}
@extends('admin.layouts.contentLayoutMaster')

{{-- title --}}
@section('title', __('locale.My Profile'))

{{-- vendor-style --}}
@section('vendor-style')
    <link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/select2/select2-materialize.css')}}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/css/dropify.min.css')}}">
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
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('locale.My Profile')}}</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin/home')}}">{{__('locale.Home Page')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('locale.My Profile')}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- content --}}
@section('content')
    <!-- users edit start -->
    <div class="section users-edit">
        <div class="row">
            <div class="col l8 s12">
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
                                <!-- users edit media object start -->
                                    <div class="row mb-5">
                                        <div class="col s12 m4 l4">
                                            <div class="row">
                                                <div class="media">
                                                    <a class="ml-10 pl-10" href="#">
                                                        <img
                                                            src="{{isset($myProfile->photo) ? asset('storage/images/user-profile/'.$myProfile->photo) : ''}}"
                                                            alt="profile image" class="z-depth-4 circle"
                                                            height="100px" width="100px"
                                                            title="{{$myProfile->fullname}}">
                                                    </a>
                                                </div>
                                                <div class="row">
                                                    <div class="media-body">
                                                        <h5 class="media-heading mt-0">Avatar</h5>
                                                        <div class="user-edit-btns display-flex">
                                                            <a href="javascript:void(0);" id="change-image"
                                                               class="btn-small indigo">Change</a>
                                                            <a href="javascript:void(0);" id="remove-image"
                                                               class="btn-small btn-light-pink">{{__('locale.Reset')}}</a>
                                                        </div>
                                                        <small>{{__('locale.Maximum file upload size 5MB')}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m8 l8">
                                            <input type="file" id="user_image" name="user_image"
                                                   class="dropify"
                                                   data-max-file-size="5M"
                                                   data-allowed-file-extensions="jpeg jpg png svg"/>
                                        </div>
                                    </div>
                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->
                                    <input id="profile_id" name="profile_id" type="hidden"
                                           value="{{$myProfile->id}}">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row">
                                                <div class="col s6 input-field">
                                                    <label for="fullname">{{__('locale.Full Name')}}</label>
                                                    <input id="fullname" name="fullname" type="text"
                                                           value="{{$myProfile->fullname}}"
                                                           data-error=".errorTxt2">
                                                    <small class="errorTxt2"></small>
                                                </div>
                                                <div class="col s6 input-field">
                                                    <label for="email">{{__('locale.Mail')}}</label>
                                                    <input id="email" type="email" name="email"
                                                           value="{{$myProfile->email}}"
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
                                                           name="is_active" {{$myProfile->is_active == 1 ? "checked":''}}>
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
                                    <!-- users edit account form ends -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card">
                    <div class="card-content">
                        <!-- <div class="card-body"> -->
                        <ul class="tabs mb-2 row">
                            <li class="tab">
                                <a class="display-flex align-items-center" href="#password">
                                    <i class="material-icons mr-1">lock_open</i><span>{{__('locale.Change Password')}}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="divider mb-3"></div>
                        <div id="change-password">
                            <div class="card-panel">
                                <form id="passwordForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="input-field">
                                                <input id="old_password" name="old_password" type="password"
                                                       data-error=".errorTxt4">
                                                <label for="old_password">{{__('locale.Old Password')}}</label>
                                                <small class="errorTxt4"></small>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field">
                                                <input id="new_password" name="new_password" type="password"
                                                       data-error=".errorTxt5">
                                                <label for="new_password">{{__('locale.New Password')}}</label>
                                                <small class="errorTxt5"></small>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field">
                                                <input id="password_confirmation" type="password"
                                                       name="password_confirmation" data-error=".errorTxt6">
                                                <label
                                                    for="password_confirmation">{{__('locale.Retype new Password')}}</label>
                                                <small class="errorTxt6"></small>
                                            </div>
                                        </div>
                                        <div class="col s12 display-flex justify-content-end form-action">
                                            <button type="submit"
                                                    class="btn indigo waves-effect waves-light mr-1">{{__('locale.Save Password')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- users edit ends -->
@endsection

{{-- vendor-script --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page-script --}}
@section('page-script')
    <script src="{{asset('js/scripts/page-users.min.js')}}"></script>
    <script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>

    <script src={{asset('js/scripts/form-file-uploads.min.js')}}></script>

    <script>
        $('#accountForm').on('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.my-profile.general.update') }}",
                type: 'POST',
                enctype: 'multipart/form-data',
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
                                    location.reload();
                                }
                            }
                        }
                    });
                },
                error: function (data) {
                    alert(data.message);
                }
            });
        });

        $("#remove-image").on("click", function (event) {
            event.preventDefault();

            var user_id = $('#profile_id').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('admin.my-profile.image.remove') }}",
                type: 'POST',
                data: {
                    id: user_id,
                    _token: CSRF_TOKEN,
                },
                dataType: 'json',
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
                                        location.reload();
                                }
                            }
                        }
                    });
                },
                error: function (data) {
                    alert(data.message);
                }
            });
        })


        $('#passwordForm').on('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            var old_pass = $('#old_password').val();
            var pass1 = $('#new_password').val();
            var pass2 = $('#password_confirmation').val();

            if (pass1 == '' || pass2 == '' || old_pass == '') {
                $.alert("{{__('locale.Enter the information completely')}}", "{{__('locale.Warning')}}");
            } else if (pass1 !== pass2) {
                $.alert("{{__('locale.Passwords dont match')}}", "{{__('locale.Warning')}}");
            } else {
                if (pass1.length < 8 || pass2.length < 8) {
                    $.alert("{{__('locale.Password less than 8 characters cannot be created')}}", "{{__('locale.Warning')}}");
                } else {

                    $.ajax({
                        url: "{{ route('admin.my-profile.password.update') }}",
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
                                title: "{{__('locale.Attention Admin')}}",
                                content: data.message,
                                type: status,
                                typeAnimated: true,
                                buttons: {
                                    tryAgain: {
                                        text: "{{__('locale.Ok')}}",
                                        btnClass: 'btn-red',
                                        action: function () {
                                            $("#passwordForm").trigger('reset');
                                        }
                                    }
                                }
                            });
                        },
                        error: function (data) {
                            $.alert(data.message);
                        }
                    });

                }
            }
        });

        $(document).ready(function () {
            //dropy çalıştırmak için
            $('.dropify').dropify({
                tpl: {
                    wrap: '<div class="dropify-wrapper"></div>',
                    loader: '<div class="dropify-loader"></div>',
                    preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ __('locale.Preview') }}</p></div></div></div>',
                    filename: '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                    clearButton: '<button type="button" class="dropify-clear">{{ __('locale.Remove') }}</button>',
                    errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
                },
                messages: {
                    'default': '{{__('locale.Drag and drop a image here or click')}}',
                    'error': '{{__('locale.Ooops, something wrong happended')}}'
                },
                error: {
                    'fileSize': '{{__('locale.The file size is too big (2MB max)')}}',
                    'imageFormat': '{{__('locale.The image format is not allowed image only)')}}'
                }
            });

            // upload button converting into file button
            $("#change-image").on("click", function () {
                $("#user_image").click();
            })
        });

        //Jquery validate mesaj
        jQuery.extend(jQuery.validator.messages, {
            required: "{{__('locale.This field is required')}}.",
            email: "{{__('locale.Please enter a valid email address')}}.",
            minlength: jQuery.validator.format("{{__('locale.Please enter at least {0} characters')}}."),
        });
    </script>
@endsection
