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
    <section style="padding:0.5rem 1.5rem;height: 5rem;">
        <div style="">
            <div style="width: 30%;text-align: left;float: left">
                <img src="{{resource_path('images/gobierno.png')}}" width="80px" alt="">
            </div>
            <div style="width: 70%;text-align: right;color: gray;font-size: .7rem;float: right">
                Gobierno de Venado Tuerto <br>
                Secretaria de Control Urbano y Convivencia <br>
                Dirección Municipal de Inspección General y Convivencia
            </div>
        </div>
    </section>
    <section style="padding: 0.5rem;">
        <h4 style="text-align: center;margin: 0;">FORMULARIO CONTROL DE ESTADO - ORD. N° 4049</h4>
        <br>
        <div style="font-size: .8rem">
            <b>Razón Social: </b>{{(isset($single->name)) ? $single->name : ''}}
            <b>CUIT: </b>
            <b>Dirección: </b>{{(isset($single->address)) ? $single->address : ''}}
            <b>Teléfono: </b>{{(isset($single->phone)) ? $single->phone : ''}}
            <b>Teléfono celular: </b>{{(isset($single->phone)) ? $single->phone : ''}}
            <b>Nombre y Apellido contacto: </b>{{(isset($single->name)) ? $single->name : ''}}
        </div>
    </section>
    @foreach($forms as $form)
        <section style="padding: 0rem;background-color: #f9f9f9;">
            <table style="width: 100%">
                <thead>
                <tr style="height: 50px;background-color: #e4e4e4;text-align: center;font-weight: 600;padding: .3rem">
                    <td style="width: 60%;padding: .5rem;">CONDICIONES PRESENTES EN EL ESTABLECIMIENTO</td>
                    <td style="width: 10%;padding: .5rem;">SI</td>
                    <td style="width: 10%;padding: .5rem;">NO</td>
                    <td style="width: 20%;padding: .5rem;">OBSERVACIONES</td>
                </tr>
                <tr style="height: 2rem;background-color: #cce1ff;text-align: center;font-weight: 600">
                    <td colspan="4" style="text-align: center;padding: .5rem">{{$form->form_title}}</td>
                </tr>
                </thead>
                <tbody>

                if (strpos($a, 'are') !== false) {
                echo 'true';
                }
                @foreach($form->values as $key => $value)
                    @if((strpos($key, 'question') !== false) && strpos($key, 'label') === false)
                        <tr>
                            <td style="text-align: left;">{{$form->values['label_'.$key]}}</td>
                            <td style="text-align: center;">{{($value === '1') ? 'SI' : ''}}</td>
                            <td style="text-align: center;">{{($value === '0') ? 'NO' : ''}}</td>
                            <td>{{(isset($form->values[str_replace('question','observation',$key)]) ? $form->values[str_replace('question','observation',$key)] : '')}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </section>
    @endforeach

    {{--    <div>--}}
    {{--        <b>{{$name}}</b>--}}
    {{--    </div>--}}
    {{--    <div>--}}
    {{--        <b>Direccion:</b>--}}
    {{--        <p>{{$address}}</p>--}}
    {{--    </div>--}}
    {{--    <div>--}}
    {{--        <b>Descripcion:</b>--}}
    {{--        <p>{{$description}}</p>--}}
    {{--    </div>--}}
</div>
