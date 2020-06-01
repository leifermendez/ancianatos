<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    td, tr {
        font-size: .7rem;
        padding: .5rem;
        font-family: 'Roboto', sans-serif;
    }
</style>
<div style="margin: 2% 1% 5% 1%;">
    DECLARACION JURADA
    <br>
    <br>
    <br>


    @foreach($forms as $form)
        @if($form->form_mode === 'declaration')

{{--            @php--}}
{{--            foreach (){--}}
{{--    --}}
{{--}--}}
{{--            @endphp--}}

            @foreach($form->values as $key => $value)
                @if((strpos($key, 'question') !== false) && strpos($key, 'label') === false)
                    {{$form->values['label_'.$key]}}: {{$form->values[$key]}} <br>
{{--                    {{$form->values[$key]}}: {{$key}} <br>--}}
                @endif
                {{--                {{$key}} -> {{$value}}--}}

{{--                                Nombre de la Institución: {{$key}} <br>--}}
                {{--                Nombre del Responsable: {{(isset($single->user->name)) ? $single->user->name : ''}}<br>--}}
                {{--                Teléfono: {{(isset($single->phone)) ? $single->phone : ''}}<br>--}}
                {{--                Fecha de Inicio de la actividad: <br>--}}
                {{--                Nombre del Medico/a y horas semanales de trabajo: <br>--}}
                {{--                Nombre de Enfermero/a y horas semanales de trabajo: <br>--}}
                {{--                Servicio de Emergencia: <br>--}}
                {{--                Cantidad de Residentes: <br>--}}
                {{--                Cantidad de Empleados/colaboradores/asistentes: <br>--}}
                {{--                <br>--}}
                {{--                Adjunto:--}}
                {{--                <br>--}}
                {{--                Medidas implementadas para la prevención y ante casos sospechosos o confirmados de COVID-19.--}}
                {{--                <br>--}}
                {{--                Fecha: Firma:--}}
            @endforeach
        @endif

    @endforeach

</div>
