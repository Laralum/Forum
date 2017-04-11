@php
    $settings = \Laralum\Forum\Models\Settings::first();
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@lang('laralum_forum::general.edit_thread') - {{ Laralum\Settings\Models\Settings::first()->appname }}</title>
        @if ($settings->text_editor == 'wysiwyg')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.5/tinymce.min.js"></script>
            <script>
                tinymce.init({ selector:'textarea',   plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ] });
            </script>
        @endif
    </head>
    <body>
        <h1>@lang('laralum_forum::general.edit_thread')</h1>
        @if(Session::has('success'))
            <hr>
            <p style="color:green">
                {{Session::get('success')}}
            </p>
            <hr>
        @endif
        @if(Session::has('info'))
            <hr>
            <p style="color:blue">
                {{Session::get('info')}}
            </p>
            <hr>
        @endif
        @if(Session::has('error'))
            <hr>
            <p style="color:red">
                {{Session::get('error')}}
            </p>
            <hr>
        @endif
        @if(count($errors->all()))
            <hr>
            <p style="color:red">
                @foreach($errors->all() as $error) {{$error}}<br/>@endforeach
            </p>
            <hr>

        @endif


    </body>
</html>

<form  method="POST" action="{{ route('laralum_public::forum.threads.update', ['thread' => $thread->id]) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
        <div>
            <label>@lang('laralum_forum::general.title')</label>
            <input value="{{ old('title', $thread->title) }}" name="title" type="text" placeholder="@lang('laralum_forum::general.title')">
        </div>
        <div>
            <label>@lang('laralum_forum::general.description')</label>
            <input value="{{ old('description', $thread->description) }}" name="description" type="text" placeholder="@lang('laralum_forum::general.description')">
        </div>
        <div>
            <label>@lang('laralum_forum::general.category')</label>
            <select required name="category" class="uk-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($thread->category_id == $category->id) selected @endif >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>@lang('laralum_forum::general.content')</label>
            @if ($settings->text_editor == 'wysiwyg')
                <textarea name="content" rows="15">{{ old('content', $thread->content) }}</textarea>
            @else
                @php
                $text = old('content', $thread->content);
                if ($settings->text_editor == 'markdown') {
                    $converter = new League\HTMLToMarkdown\HtmlConverter();
                    $text = $converter->convert($text);
                }
                @endphp
                <textarea name="content" rows="15" placeholder="{{ __('laralum_forum::general.content') }}">{{ $text }}</textarea>
                @if ($settings->text_editor == 'markdown')
                    <i>@lang('laralum_forum::general.markdown')</i>
                @else
                    <i>@lang('laralum_forum::general.plain_text')</i>
                @endif
            @endif
        </div>

        <div>
            <a href="{{ route('laralum_public::forum.categories.show', ['category' => $category->id]) }}">@lang('laralum_forum::general.cancel')</a>
            <button type="submit">
                {{ __('laralum_forum::general.edit_thread') }}
            </button>
        </div>
</form>
