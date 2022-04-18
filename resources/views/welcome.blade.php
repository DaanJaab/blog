@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.messages_box')
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-globe text-navy mid-icon"></i>
                        </div>
                        <h2>{{ __('global.app_name') }}</h2>
                        <span>{{ __('global.app_description') }}</span>

                    </div>
                </div>

                <div class="ibox-content forum-container">
                    <div class="forum-title">
                        <div class="pull-right forum-desc">
                            <small>
                                yyyyyyyyyy
                            </small>
                        </div>
                        <h3>General subjects.....................................................</h3>
                    </div>

                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>

                                    <div class="forum-sub-title">
                                        jakiś tekst
                                        <div class="pull-right m-r-md">
                                            <a href="{{ route('blog.index') }}">
                                                <button class="btn btn-primary">
                                                    Przejdź do bloga
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
