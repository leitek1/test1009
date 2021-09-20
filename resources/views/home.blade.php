@extends('layout')
@section('title')
Конвертор
@endsection
@section('main_content')

<form action="/convert" method="post">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="row justify-content-start">
                    <div class="col-auto">
                        <h5>Конвертор валют</h5>
                        <h6>
                            <font color="gray">by Lukmanov R.</font>
                        </h6>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-auto">
                        <h6>Из валюты:</h6>
                        <select class="form-select" aria-label="Default select example" name="from" id="from">
                            @foreach ($data['currenciesList'] as $key => $value)
                                <option @php if($key == $data['from']) {echo 'selected';} else {echo '';} @endphp>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <h6>В валюту:</h6>
                        <select class="form-select" aria-label="Default select example" name="to" id="to">
                            @foreach ($data['currenciesList'] as $key => $value)
                                <option @php if($key == $data['to']) {echo 'selected';} else {echo '';} @endphp>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-auto">
                        <p>
                        <h6>Введите сумму:</h6>
                        </p>
                        <input class="form-control" name="amount" id="amount" autocomplete="on" placeholder="Число" pattern="\d+(,\d{2})?" value="{{ $data['amount'] }}">
                    </div>
                </div>
                <p></p>
                <div class="row justify-content-center">
                    <div class="col-auto alert alert-success" role="alert">
                        <h6>  {!! $data['result'] !!}</h6>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Конвертировать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


@endsection