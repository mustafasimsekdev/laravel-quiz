{{-- layout --}}
@extends('admin.layouts.contentLayoutMaster')

{{-- meta-head --}}
@section('meta-head')
@endsection

{{-- title --}}
@section('title', __('locale.Home Page'))

{{-- vendor-style(css) --}}
@section('vendor-style')
@endsection

{{-- page-style(css) --}}
@section('page-style')
@endsection

{{-- custom-style(css) --}}
@section('custom-style')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('locale.Home Page')}}</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item active"><a href="{{url('/admin/home')}}">{{__('locale.Home Page')}}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- content --}}
@section('content')
    <div class="section">
        <div class="card">
            <div class="card-content">
                <p class="caption mb-0">
                    Sample blank page for getting start!! Created and designed by Google, Material Design is
                    a design
                    language that combines the classic principles of successful design along with innovation
                    and
                    technology.
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- vendor-script(js) --}}
@section('vendor-script')
@endsection

{{-- page-script(js) --}}
@section('page-script')
@endsection
