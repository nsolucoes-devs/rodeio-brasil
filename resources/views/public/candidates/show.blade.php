@extends('layouts.main')

@section('content')
    <x-header-start />

    <input type="hidden" name="candidate" id="candidate" value="{{ $candidate->id }}">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">{{ $candidate->sex == 'F' ? 'Candidata' : 'Candidato'}}</h6>
                <h1 class="mb-5">{{ $candidate->name }}</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6">
                    <div id="carousel-images-candidate" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner h-100">
                            <div class="carousel-item active">
                                <img class="w-100 expand-image"  src="{{ asset('/img/candidates/'.$candidate->slug. '-1').'.jpg'}}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 expand-image" src="{{ asset('/img/candidates/'.$candidate->slug. '-2').'.jpg' }}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 expand-image" src="{{ asset('/img/candidates/'.$candidate->slug. '-3').'.jpg' }}" alt="Image">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-images-candidate"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-images-candidate"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content rounded-0 border-0 bg-transparent">
                                <div class="modal-body">
                                    <div class="text-end mb-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <img class="w-100 modal-image" src="" alt="Image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="text-black" for="first-name">Idade:</label>
                                        <span class="form-control bg-white d-flex align-items-center" style="height: 60px">{{ $candidate->age  }} anos</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="text-black" for="last-name">Cidade:</label>
                                        <span class="form-control bg-white d-flex align-items-center" style="height: 60px">{{ $candidate->city  }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="" > 
                                        <label class="text-black" for="last-name">Altura:</label>
                                        <span class="form-control bg-white d-flex align-items-center" style="height: 60px">{{ $candidate->display_weight  }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="" >
                                        <label class="text-black" for="last-name">Profissão:</label>
                                        <span class="form-control bg-white d-flex align-items-center" style="height: 60px"> {{ $candidate->profession }} </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="text-black" for="last-name">Cantor (a) /Dupla Sertaneja preferida:</label>
                                        <span class="form-control bg-white d-flex align-items-center" style="height: 60px"> {{ $candidate->bestSinger }} </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <h5>Por que você quer ser a Miss Rodeio Brasil 2024?</h5>
                                        <div style="text-align: justify">
                                            <p>{{ $candidate->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-end align-items-center">
                    <span class="badge bg-success rounded-pill fs-5">
                        <i class="fa fa-thumbs-up"></i>
                        {{ $candidate->votes }} Votos
                    </span>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary w-100 py-3 pulse" type="button" onclick="$('#makeVoteModal').modal('show')">Votar agora</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->

    <!-- Outher Candidates Start -->
    <div class="my-5 py-5 wow zoomIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Candidados 2024</h6>
            </div>
            <div class="row g-4 mt-3">
                @foreach ($candidates as $candidate)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <a href="/">
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

    <!-- Modal -->
    <div class="modal fade" id="makeVoteModal" tabindex="-1" role="dialog" aria-labelledby="makeVoteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="makeVoteModalTitle">Votar agora</h5>
                    {{-- <button class="btn"  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="form-content">
                        <label for="">Nome completo: <span class="text-danger">*</span> </label>
                        <input type="text" name="full_name" id="full_name" class="form-control">
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="">CPF: <span class="text-danger">*</span></label>
                            <input type="text" name="cpf" id="cpf" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Telefone: <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control" id="phone">
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="g-recaptcha" data-sitekey="6LeVCfEpAAAAAMSv86Hvnda44kK8ldPkf4yKR2Ea"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#makeVoteModal').modal('hide')">Fechar</button>
                    <button type="button" class="btn btn-primary" id="makeVote">Votar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
