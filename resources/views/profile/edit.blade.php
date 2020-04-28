@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
@include('alerts.success')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Perfil') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Nombre') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Saldo') }}</h5>
                </div>
                <form method="post" action="{{ route('pago.pago',auth()->user()) }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('GET')
                        <div class="form-group{{ $errors->has('balance') ? ' has-danger' : '' }}">
                            <label>{{ __('Saldo') }}</label>
                            <input name="balance" class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" placeholder="{{ __('Saldo') }}" value="{{ old('balance', auth()->user()->balance) }}" readonly>
                            <label>{{ __('Saldo para Ingresar') }}</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Saldo" min="5" step="0.01"> 
                            @include('alerts.feedback', ['field' => 'balance'])
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Añadir saldo') }}</button>
                    </div>
                </form>
            </div>
        </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Contraseña') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Contraseña Actual') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña actual') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('Nueva Contraseña') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Nueva Contraseña') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirmar Nueva Contraseña') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirmar Nueva Contraseña') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ auth()->user()->rol }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">  
                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
