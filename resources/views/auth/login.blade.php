@extends('layouts.blank')

@section('title', 'Entrar')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/auth/login.js') }}"></script>
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                                <span class="app-brand-text demo text-body fw-bold">{{config('variables.templateName')}}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Acessar do Sistema</h4>

                        <form id="formAuthentication" class="mb-3" method="GET" action="{{ route('authenticate')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Informe seu email de acesso" required="required" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Senha</label>
                                    <a href="{{url('auth/forgot-password-basic')}}">
                                        <small>Esqueceu a senha ?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        Lembrar-me
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Não tem uma conta ?</span>
                            <a href="{{ route('register') }}">
                                <span>Criar conta</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    </div>
@endsection
