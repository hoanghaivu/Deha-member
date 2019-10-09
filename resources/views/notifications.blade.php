@if(!empty(session(ERROR)))
    <div class="alert alert-danger" role="alert">
        {{ session(ERROR) }}
    </div>
@endif

@if(!empty(session(SUCCESS)))
    <div class="alert alert-success" role="alert">
        {{ session(SUCCESS) }}
    </div>
@endif