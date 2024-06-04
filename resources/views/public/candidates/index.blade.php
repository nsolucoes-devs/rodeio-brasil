@extends('layouts.main')

@section('content')
    <x-header-start />
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Candidados</h6>
                <h1 class="mb-5">Candidados 2024</h1>
            </div>
            <div class="row g-4">
                @foreach ($candidates as $candidate)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <a href="/candidate.html">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ asset('/img/candidates/'.$candidate->slug. '-1').'.jpg'}}" alt="">
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $candidate->name }}</h5>
                                        <small><i class="fa {{ $candidate->sex == 'F' ? 'fa-venus' : 'fa-mars'}} text-primary me-2"></i> {{ $candidate->sex == 'F' ? 'Feminino' : 'Masculino'}} </small>
                                    </div>
                                    <div class="d-flex mb-3">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-sm btn-primary rounded py-2 px-4" href="/candidatos/{{$candidate->slug}}">Mais detalhes</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
