@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

        <div class="alert alert-{{$msg}} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('alert-' . $msg) }}
        </div>

    @endif
@endforeach
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
