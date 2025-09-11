@if (session()->has('primary'))
    <div class="alert alert-primary my-2 mx-3" role="alert">
        {{ session('primary') }}
    </div>
@endif
@if (session()->has('danger'))
    <div class="alert alert-danger my-2 mx-3" role="alert">
        {{ session('danger') }}
    </div>
@endif

@if (session()->has('secondary'))
    <div class="alert alert-secondary my-2 mx-3" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success my-2 mx-3" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-warning my-2 mx-3" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info my-2 mx-3" role="alert">
        {{ session('info') }}
    </div>
@endif

@if (session()->has('light'))
    <div class="alert alert-light my-2 mx-3" role="alert">
        {{ session('light') }}
    </div>
@endif

@if (session()->has('dark'))
    <div class="alert alert-dark my-2 mx-3" role="alert">
        {{ session('dark') }}
    </div>
@endif
@if (session()->has('now'))
    <div class="alert alert-dark my-2 mx-3" role="alert">
        {{ session('now') }}
    </div>
@endif
