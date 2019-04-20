<!-- resources/views/common/errors.blade.php -->
<!-- 
@if (count($errors) > 0)
    Form Error List
    <div class="alert alert-danger">
        <strong>Whoops! Something went wrong!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

@if ($errors->count() > 0)
    <div class="uk-alert uk-alert-danger" data-uk-alert>
        <a href="" class="uk-alert-close uk-close"></a>
        @foreach ($errors->all('<p>:message</p>') as $error)
            {{ $error }}
        @endforeach
    </div>
@endif