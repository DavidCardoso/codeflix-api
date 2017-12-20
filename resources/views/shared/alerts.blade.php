{{-- Alerts by Session Flash Message (success, warning, danger, info, primary, default) --}}
@if(Session::has('success'))
    <div class="container">
        {!! Alert::success(Session::get('success'))->close() !!}
    </div>
@endif

@if(Session::has('warning'))
    <div class="container">
        {!! Alert::warning(Session::get('warning'))->close() !!}
    </div>
@endif

@if(Session::has('error'))
    <div class="container">
        {!! Alert::danger(Session::get('error'))->close() !!}
    </div>
@endif