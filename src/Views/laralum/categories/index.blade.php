@extends('laralum::layouts.master')
@section('icon', 'ion-grid')
@section('title', __('laralum_forum::general.category_list'))
@section('subtitle', __('laralum_forum::general.categories_desc'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_forum::general.home')</a></li>
        <li><span>@lang('laralum_forum::general.category_list')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-5@l uk-width-1-1@m"></div>
            <div class="uk-width-3-5@l uk-width-1-1@m">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_forum::general.category_list')
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('laralum_forum::general.name')</th>
                                        <th>@lang('laralum_forum::general.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td class="uk-table-shrink">
                                                <div class="uk-button-group">
                                                    <a class="uk-button uk-button-default uk-button-small" href="{{ route('laralum::forum.categories.show', ['id' => $category->id]) }}">
                                                        @lang('laralum_forum::general.view')
                                                    </a>
                                                    @can('update', $category)
                                                        <a class="uk-button uk-button-default uk-button-small" href="{{ route('laralum::forum.categories.edit', ['id' => $category->id]) }}">
                                                            @lang('laralum_forum::general.update')
                                                        </a>
                                                    @else
                                                        <button disabled class="uk-button uk-button-default uk-button-small">
                                                            @lang('laralum_forum::general.update')
                                                        </button>
                                                    @endcan
                                                    @can('delete', $category)
                                                        <a class="uk-button uk-button-small uk-button-danger" href="{{ route('laralum::forum.categories.destroy.confirm', ['id' => $category->id]) }}">
                                                            @lang('laralum_forum::general.delete')
                                                        </a>
                                                    @else
                                                        <button disabled class="uk-button uk-button-small uk-button-danger">
                                                            @lang('laralum_forum::general.delete')
                                                        </button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-5@l uk-width-1-1@m"></div>
        </div>
    </div>
@endsection
