<x-app head-title="Поиск (Карточки)">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <h1 class="h3 mb-3"><i class="fal fa-fw fa-search text-secondary"></i>&nbsp;Поиск (Карточки посетителей)</h1>
            </div>
            <div class="col-auto ms-auto text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fal fa-fw fa-backward"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Поиск (Карточки посетителей)
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                            <thead>
                            <tr>
{{--                                <th class="text-nowrap" scope="col">#</th>--}}
{{--                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-key"></i></th>--}}
{{--                                <th class="text-nowrap" scope="col">Фамилия</th>--}}
{{--                                <th class="text-nowrap" scope="col">Имя</th>--}}
{{--                                <th class="text-nowrap" scope="col">Отчество</th>--}}
{{--                                <th class="text-nowrap" scope="col">Компания</th>--}}
{{--                                <th class="text-nowrap" scope="col">Специализация</th>--}}
{{--                                <th class="text-nowrap" scope="col">Выставка</th>--}}
{{--                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-globe"></i></th>--}}
{{--                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-envelope"></i></th>--}}
{{--                                <th class="text-nowrap" scope="col"><i class="fal fa-fw fa-phone"></i></th>--}}
{{--                                <th class="text-nowrap" scope="col"></th>--}}
{{--                                <th class="text-nowrap" scope="col"></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cards as $card)
{{--                                <tr>--}}
{{--                                    <th scope="row">{{ $card->id }}</th>--}}
{{--                                    @if( $card->visitor_id == 0 )--}}
{{--                                        <td class="table-danger"><i class="fal fa-fw fa-user-slash"></i></td>--}}
{{--                                    @else--}}
{{--                                        <td class="table-success"><i class="fal fa-fw fa-user"></i></td>--}}
{{--                                    @endif--}}
{{--                                    <td>{{ $card->last_name }}</td>--}}
{{--                                    <td>{{ $card->first_name }}</td>--}}
{{--                                    <td>{{ $card->second_name }}</td>--}}
{{--                                    <td>{{ $card->company }}</td>--}}
{{--                                    <td>{{ $card->cardtopic->name_ru   }}</td>--}}
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $exhibitions = $card->exhibitions;--}}
{{--                                            $string = '';--}}
{{--                                            foreach ($exhibitions as $exhibition) {--}}
{{--                                                $string .='<span class="badge text-bg-light me-1">'.$exhibition->name.'</span>';--}}
{{--                                            }--}}
{{--                                            echo $string;--}}
{{--                                        @endphp--}}
{{--                                    </td>--}}
{{--                                    <td>{{$card->cardcountry->code}}</td>--}}
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $emails = $card->emails;--}}
{{--                                            $string = '';--}}
{{--                                            foreach ($emails as $email) {--}}
{{--                                                $string .='<span class="badge text-bg-light me-1">'.$email->email.'</span>';--}}
{{--                                            }--}}
{{--                                            echo $string;--}}
{{--                                        @endphp--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $phones = $card->phone;--}}
{{--                                            $string = '';--}}
{{--                                            foreach ($phones as $phone) {--}}
{{--                                                $string .='<span class="badge text-bg-light me-1">'.$phone->number.'</span>';--}}
{{--                                            }--}}
{{--                                            echo $string;--}}
{{--                                        @endphp--}}
{{--                                    </td>--}}
{{--                                    <td><a href="/cards/show/{{$card->id}}" target="_blank"><i class="fal fa-fw fa-eye"></i></a></td>--}}
{{--                                    <td><a href="/cards/edit/{{$card->id}}"><i class="fal fa-fw fa-edit"></i></a></td>--}}
{{--                                </tr>--}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center">
                        {!! $cards->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
