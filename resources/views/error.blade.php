@if(session('error'))
    {{ session('error') }}
@elseif(session('success'))
    {{ session('success') }}
@endif