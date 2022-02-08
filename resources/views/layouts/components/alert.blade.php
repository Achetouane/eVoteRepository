@if (session('message'))
    <div class="text-center alert alert-{{ session('color') }}" role="alert">
        {{ session('message') }}
    </div>
@endif