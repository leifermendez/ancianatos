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
    {{--    <section style="padding:0.5rem 1.5rem;height: 5rem;">--}}
    {{--        <div style="">--}}
    {{--            <div style="width: 30%;text-align: left;float: left">--}}
    {{--                <img src="{{resource_path('images/gobierno.png')}}" width="80px" alt="">--}}
    {{--            </div>--}}
    {{--            <div style="width: 70%;text-align: right;color: gray;font-size: .7rem;float: right">--}}
    {{--                Gobierno de Venado Tuerto <br>--}}
    {{--                Secretaria de Control Urbano y Convivencia <br>--}}
    {{--                Dirección Municipal de Inspección General y Convivencia--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <section style="padding: 0.5rem;">
        <h4 style="text-align: center;margin: 0;">{{trans('general.list')}}: {{$data['title']}}</h4>
    </section>
    <section style="padding: 0rem;background-color: #f9f9f9;">
        <table style="width: 100%">
            <thead>
            <tr style="height: 50px;background-color: #e4e4e4;text-align: center;font-weight: 600;padding: .3rem">
                @foreach($data['keys'] as $key => $value)
                    <td style="width: 60%;padding: .5rem;">{{$value}}</td>
                @endforeach

            </tr>

            </thead>
            <tbody>
            @foreach($data['data'] as $lines)
                <tr style="height: 2rem;background-color: #fff;text-align: center;font-weight: 600">
                    @foreach($lines as $lk => $lv)
                        @if((strpos($lk, '_id') === false) && (gettype($lv) !== 'array') && (gettype($lv) !== 'object'))
                            <td>{{$lv}}</td>
                        @elseif(strpos($lk, '_id') !== false)
                            @if($lk==='user_id')
                                <td>{{$lines['user']['name']}} <br> {{$lines['user']['address']}}</td>
                            @endif
                            @if($lk==='institutions_id')
                                    <td>{{$lines['institution']['name']}} <br> {{$lines['institution']['address']}}</td>
                            @endif
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>

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
