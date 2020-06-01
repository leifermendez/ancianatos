<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
    .page-break {
        page-break-after: always;
    }
    td, tr {
        font-size: .7rem;
        padding: .5rem;
        font-family: 'Roboto', sans-serif;
    }
</style>
<div style="margin: 2% 1% 5% 1%;">
    <div style="font-size: 14px">
        <b>ANEXO 2</b>
        <br>
        <br>PREVENCION Y ABORDAJE de COVID -19 en Residencia de personas mayores.
        <br><br>-Médico/a Director/Responsable de la atención de los residentes.
        <br><br>-Enfermeros/as a cargo del cuidado de los residentes, modalidad de trabajo (ya sea
        permanente, o con visitas programadas). <br><br>
        -Plan de acción y contingencia de la Residencia, que especifique:
        <br><br> a) Medidas implementadas para la prevención para COVID – 19
        <br><br> b) Medidas implementadas para la respuesta ante casos sospechosos o confirmados
        <br><br> de COVID-19.
        <br><br> -Listado de empleados/asistentes/colaboradores que se encuentren realizando algún
        <br><br> tipo de trabajo dentro de la institución,
        <br><br> Esto ultimo es necesario para incluirlos dentro de la estrategia de prevención que
        <br><br> llevara adelante el Gobierno de Venado Tuerto con un acompañamiento en el testeo
        <br><br>de COVID-19 de forma semanal a través de un hisopado.
        <br><br> • Residencia de Adultos Mayores
        <br><br> o Personal estable de residencia de Adultos Mayores
        <br><br> Deberán concurrir una vez por semana a Laboratorios COVID-19 Venado
        <br><br> Tuerto para la toma de muestra y determinación de rt-PCR.
        <br><br>El día de toma debe corresponder a un día no laborable para el trabajador y
        <br><br>encontrarse a más de 12 horas de comenzar su jornada laboral.
        <br><br>Si el personal de la residencia comienza con fiebre o dos o más de los
        <br><br>siguientes síntomas: tos, odinofagia, dificultad respiratoria, anosmia, disgeusia; se
       <br><br> considerará Caso Sospechoso.
       <br><br> o Residentes permanentes
        Los residentes que comenzarán con fiebre o dos o más de algunos de los
        siguientes síntomas: tos, odinofagia, dificultad respiratoria, anosmia, disgeusia
        deberán informar al Centro de Testeo permanente para COVID-19
        <br><br>Las muestras de hisopado para las personas internadas en residencias de
        adultos mayores serán realizadas en la misma institución por el Centro de Testeo
        permanente para COVID-19.
        <br><br>Se adjunta los Protocolos Nacionales y Provinciales vinculados a Residencias de
        adultos mayores, en los cuales se debe de enmarcar lo solicitado.
        Teléfono de asesoramiento y contacto de 7 a 13HS 15520088
    </div>
    <div class="page-break"></div>
    <b>DECLARACION JURADA</b>
    <br>
    <br>
    <br>
    <div style="word-spacing: .5em;line-height: 40px;text-justify: inter-word;text-align:justify;width: 100%;">
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
            <br>
            <br>
            Adjunto: Medidas implementadas para la prevención y ante casos sospechosos
            o confirmados de COVID-19.
            <br>
            <br>
            <br>
        Fecha:........................................  Firma:...........................................
    </div>

</div>
