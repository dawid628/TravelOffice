@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('success'))
            <div class="alert alert-success mb-1" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-8">
            <div class="card myform">
                <div class="card-header text-danger">Welcome page</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Zostałeś zalogowany
                </div>
            </div>
        </div>
    </div>
</div>
@endsection