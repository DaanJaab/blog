@if (session('message'))
    <div class="col-md-4 alert alert-{{ session('message.0') }}" role="alert">
        {{ session('message.1') }}
    </div>
@endif
