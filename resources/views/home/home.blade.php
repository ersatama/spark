@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row min-vh-100 flex-column flex-md-row mt-4">
            <aside class="col-12 col-md-2 p-0 flex-shrink-1">
                @include('home.layouts.sidebar')
            </aside>
            <main class="col col-md-10 bg-faded py-3 flex-grow-1">
                <div class="container">
                    <h2>Здраствуите, {{join(' ',[Auth::user()->name,Auth::user()->surname,Auth::user()->lastname])}}</h2>
                    <h5>Список ваших заявок за последние 30 дней</h5>
                    <div class="table-responsive">
                        <table class="table mt-3 table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-nowrap">Дата создания</th>
                                <th class="text-nowrap">Номер заказа</th>
                                <th class="text-nowrap">Номер накладной</th>
                                <th class="text-nowrap">Откуда</th>
                                <th class="text-nowrap">Куда</th>
                                <th class="text-nowrap">Тип доставки</th>
                                <th class="text-nowrap">Места</th>
                                <th class="text-nowrap">Вес (кг)</th>
                                <th class="text-nowrap">Обьем (м3)</th>
                                <th class="text-nowrap">Статус</th>
                                <th class="text-nowrap">Примечание</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @php
                                        $invoice = '';
                                        $invoiceStatus = '';
                                        $invoiceData = json_decode($order['invoice']['data'], true);
                                        $i = 1;
                                        foreach ($invoiceData['shippings'] as &$value) {
                                            $bgColor = (sizeof($invoiceData['shippings'])>1)?(($i%2)?'bg-warning text-dark':'bg-success text-white'):'';
                                            $invoice .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.$value['invoice_number'].'</div>';
                                            $invoiceStatus = $invoiceModel->getStatusByInvoice($value['invoice_number'], Auth::user()->iin);
                                            $i++;
                                        }
                                        $receiver = '';
                                        $deliver = '';
                                        $place = '';
                                        $weight = '';
                                        $volume = '';
                                        $annotation = '';
                                        $i = 1;
                                        foreach ($order['receiver'] as &$value) {
                                            $city = $cityModel->getCityById($value['city']);
                                            $deliverData = $deliverModel->getTypeById($value['deliver_type']);
                                            $bgColor = (sizeof($order['receiver'])>1)?(($i%2)?'bg-warning text-dark':'bg-success text-white'):'';
                                            $receiver .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.$city['russian_name'].'</div>';
                                            $deliver .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.$deliverData['russian_name'].'</div>';
                                            $place .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.$value['place'].'</div>';
                                            $weight .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.$value['weight'].'</div>';
                                            $volume .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.$value['volume'].'</div>';
                                            $annotation .= '<div class="text-no-wrap '.$bgColor.' p-1 text-center">'.(trim($value['annotation'])==''?'-':$value['annotation']).'</div>';
                                            $i++;
                                        }
                                    @endphp
                                    <tr class="text-capitalize">
                                        <th class="text-nowrap">
                                            <div class="text-no-wrap p-1 text-center">
                                                {{date('j M Y', strtotime($order['created_at']))}}
                                            </div>
                                        </th>
                                        <td class="text-nowrap">
                                            <div class="text-no-wrap p-1 text-center">
                                                {{$invoiceData['order_number']}}
                                            </div>
                                        </td>
                                        <td class="text-nowrap">{!! $invoice !!}</td>
                                        <td class="text-nowrap">{{$order['city']['russian_name']}}</td>
                                        <td class="text-nowrap">{!! $receiver !!}</td>
                                        <td class="text-nowrap">{!! $deliver !!}</td>
                                        <td class="text-nowrap">{!! $place !!}</td>
                                        <td class="text-nowrap">{!! $weight !!}</td>
                                        <td class="text-nowrap">{!! $volume !!}</td>
                                        <td class="text-nowrap">{{$invoiceStatus}}</td>
                                        <td class="text-nowrap">{!! $annotation !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav class="mt-5">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </main>
        </div>
    </div>

@php
/*
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
*/
@endphp
@endsection
