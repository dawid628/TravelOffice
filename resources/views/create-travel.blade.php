@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card myform">
                <div class="card-header text-danger">Nowa podróz</div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{ route('store-travel') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nazwa: </label>
                            <input class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                            <label>Opis:</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Miasto:</label>
                            <select name="city_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Obraz:</label>
                            <input type="file" class="form-control" name="file"></input>
                        </div>
                        <div class="form-group">
                            <label>Dzień wyjazdu:</label>
                            <input type="date" class="form-control" name="date_from"/>
                        </div>
                        <div class="form-group">
                            <label>Dzień powrotu:</label>
                            <input type="date" class="form-control" name="date_to"/>
                        </div>
                        <div class="form-group">
                            <label>Ilość miejsc:</label>
                            <input type="number" class="form-control" name="places"/>
                        </div>
                        <div class="form-group">
                            <label>Cena za osobę:</label>
                            <input type="number" class="form-control" name="price"/>
                        </div>
                        <div class="form-group">
                            <label>All inclusive:</label>
                            <select class="form-control" name="all_inclusive">
                                <option selected value="0">nie</option>
                                <option value="1">tak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Last minute:</label>
                            <select class="form-control" name="last_minute">
                                <option selected value="0">nie</option>
                                <option value="1">tak</option>
                            </select>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection