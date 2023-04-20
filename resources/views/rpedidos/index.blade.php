@extends('app')


@section('content')
    <div class="container">
        <div id="calendar"></div>
    </div>

@endsection

@section('scripts')
    <script>cambiar('rpedidos');</script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                // opciones y configuraciones del calendario aquí
            });
        });
    </script>
@endsection