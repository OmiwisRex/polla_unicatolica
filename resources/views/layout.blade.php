<a href="{{ url('/') }}">Inicio</a>
@if (Auth::user())
    // dentro del if lo que solo se ve si se hizo login
    <a href="{{ url('categorias') }}">Categorías</a>
    @if (Auth::user()->rol->nombre == "Administrador")
        // aca solo lo que puede ver el administrador
    @endif
@endif