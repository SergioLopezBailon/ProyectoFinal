@extends('layouts.app',["pageSlug"=>"buscaminas"])
@section('content')
    <div class="container text-center">
        <h1>Buscaminas</h1>
        <div class="card">
            <div class="card-header">
                <form action="" method="POST" class="form-inline">
                    @csrf
                    @method('PUT')
                    <div class="ml-auto">
                        <input type="radio" name="mode" value="1"><label class="form-control">1</label>
                        <input type="radio"  name="mode" value="5"><label class="form-control">5</label>
                        <input type="radio"  name="mode" value="7"><label class="form-control">7</label>
                        <input type="radio"  name="mode" value="24"><label class="form-control">24</label>
                    </div>
                    <input type="submit" value="Jugar" class="btn form-control ml-auto">
                </form>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
@endsection