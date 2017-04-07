@extends('laralum::layouts.master')
@section('icon', 'ion-stop')
@section('title', __('laralum_forum::general.category_threads'))
@section('subtitle', __('laralum_forum::general.category_desc', ['id' => $category->id]))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_forum::general.home')</a></li>
        <li><a href="{{ route('laralum::forum.categories.index') }}">@lang('laralum_forum::general.category_list')</a></li>
        <li><span>@lang('laralum_forum::general.category_threads')</span></li>
    </ul>
@endsection
@section('content')
<div class="uk-container uk-container-large">
    <center><a @cannot('create', \laralum\Forum\Models\Thread::class) disabled @endcannot href="{{ route('laralum::forum.categories.threads.create', ['category' => $category->id]) }}" class="uk-button uk-button-primary uk-width-1-3 uk-margin-small-bottom">@lang('laralum_forum::general.create_thread')</a></center>
    <br>
    <div class="uk-child-width-1-2@m uk-child-width-1-1@s uk-grid-match" uk-grid>
        @if ($category->threads->count())
            @foreach ($category->threads as $thread)
                <div>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <div class="uk-width-expand">
                                    <h3 class="uk-card-title uk-margin-remove-bottom">{{ $thread->title }}</h3>
                                    <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">{{ $thread->created_at->diffForHumans() }}</time></p>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>{{ $thread->description }}</p>
                        </div>
                        <div class="uk-card-footer">
                            <a href="{{ route('laralum::forum.categories.threads.show', ['category' => $category->id, 'thread' => $thread->id]) }}" class="uk-button uk-button-text">@lang('laralum_forum::general.view_thread')</a>
                            <span class="uk-align-right">{{ $thread->comments->count() }} <i style="font-size:20px;" class="icon ion-chatboxes"></i></span>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body">
                    <div uk-alert>
                        <p>@lang('laralum_forum::general.no_threads_yet')</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
