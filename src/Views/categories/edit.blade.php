@extends('laralum::layouts.master')
@section('icon', 'ion-edit')
@section('title', __('laralum_forum::general.edit_category'))
@section('subtitle', __('laralum_forum::general.edit_category_desc', ['id' => $category->id, 'time_ago' => $category->created_at->diffForHumans()]))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_forum::general.home')</a></li>
        <li><a href="{{ route('laralum::forum.categories.index') }}">@lang('laralum_forum::general.category_list')</a></li>
        <li><span>@lang('laralum_forum::general.edit_category')</span></li>
    </ul>
@endsection
@section('content')
    @include('laralum_forum::categories.form', [
        'action' => route('laralum::forum.categories.update', ['category' => $category->id]),
        'button' => __('laralum_forum::general.edit_category'),
        'title' => __('laralum_forum::general.create_category'),
        'method' => 'PATCH',
        'category' => $category,
        'cancel' => route('laralum::forum.categories.index')
    ])
@endsection
