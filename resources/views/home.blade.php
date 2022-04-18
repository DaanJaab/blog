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
                        <div class="pull-right m-r-md">
                            <a href="{{ route('posts.create') }}">
                                <button class="btn btn-primary">
                                    {{ __('blog.buttons.add_post') }}
                                </button>
                            </a>
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
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>

                                    <div class="forum-sub-title">QQQQQQQQQ222222222</div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allCategoriesCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.categories.sum') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allPostsCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.posts.sum') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allCommentsCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.comments.sum') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>

                                    <div class="forum-sub-title">QQQQQQQQQ3333333333</div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.sum') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allAdminUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.admins_sum') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allVerifyUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.sum_verify') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allNotVerifyUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.sum_not_verify') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allSoftDeletedUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.soft_deleted_sum') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allBannedUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.banned_sum') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $allActivedUsersCount }}
                                    </span>
                                    <div>
                                        <small>{{ __('home.users.full_actived') }}</small>
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
