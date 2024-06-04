@extends('layouts.blank')

@section('title', 'Cadastrar')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/auth/register.js') }}"></script>
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
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
                        <h4 class="mb-2">Adventure starts here 🚀</h4>

                        <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="post">
                            <input type="hidden" name="action" value="new-subscriber">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Informe seu nome completo" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Informe seu email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone</label>
                                <input type="text" class="form-control phone" id="phone" name="phone" placeholder="Informe seu telefone">
                            </div>
                            <div class="mb-3">
                                <label for="document" class="form-label">Documento (CPF ou CNPJ)</label>
                                <input type="text" class="form-control document" id="document" name="document" placeholder="Informe seu documento">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Senha</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="********" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Confirme a Senha</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="********" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="use_terms_accepted">
                                    <label class="form-check-label" for="terms-conditions">
                                        Eu concordo com os
                                        <a href="javascript:void(0);">Termos e Condições</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">
                                Cadastrar
                            </button>
                        </form>

                        <p class="text-center">
                            <span>Você já tem uma conta?</span>
                            <a href="{{ route('login') }}">
                                <span>Entrar</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection
