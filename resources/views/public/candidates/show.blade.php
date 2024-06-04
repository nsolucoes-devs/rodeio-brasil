@extends('layouts.main')

@section('content')
    <!-- Page Header Start -->
    <x-header-start />
    <!-- Page Header End -->

    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Candidata</h6>
                <h1 class="mb-5">Anna Winchester</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6">
                    <div id="carousel-images-candidate" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner h-100">
                            <div class="carousel-item active">
                                <img class="w-100 expand-image" src="img/candicates/anna-winchester/1716861188jpg.jpg" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 expand-image" src="img/candicates/anna-winchester/image00001.jpg" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 expand-image" src="img/candicates/anna-winchester/AirBrush_20240525133811.jpg" alt="Image">
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
                                    <div class="form-floating">
                                        <span class="form-control bg-white">20 anos</span>
                                        <label class="text-black" for="first-name">Idade:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <span class="form-control bg-white">Ribeirão Preto/SP</span>
                                        <label class="text-black" for="last-name">Cidade:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <span class="form-control bg-white">1,92 m</span>
                                        <label class="text-black" for="last-name">Altura:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <span class="form-control bg-white">72 kg</span>
                                        <label class="text-black" for="last-name">Peso:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <span class="form-control bg-white">Modelo</span>
                                        <label class="text-black" for="last-name">Profissão:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <span class="form-control bg-white">Modelo</span>
                                        <label for="last-name">Profissão:</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <h5>Por que você quer ser a Miss Rodeio Brasil 2024?</h5>
                                        <div style="text-align: justify">
                                            <p>Acredito que, como Miss, posso inspirar outras pessoas a irem atrás dos seus sonhos, de se espelharem com os ideais que carrego, ser referência para as meninas que sonham em ter uma faixa e encoraja-las a seguir seus sonhos se isso for, além de promover a importância de preservar nossa herança cultural que vem se perdendo aos poucos com o passar do tempo, quero ser um elo entre as tradições do passado e as oportunidades do futuro, mostrando a todos a verdadeira essência do espírito do rodeio brasileiro.<p>
                                            <p>Meu desejo de ser Miss Rodeio Brasil 2024 não é apenas um sonho pessoal, mas sim um compromisso profundo com tudo que esse título significa, estou pronta para representar com honra, humildade e dedicação, e espero ter a chance de compartilhar minha paixão e ideais com todos que também amam esse universo.</p>
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
                        2.040 Votos
                    </span>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary w-100 py-3 pulse" type="submit">Votar agora</button>
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
            <div class="owl-carousel outher-candidates-carousel py-5">
                <div class="candidate-item rounded shadow overflow-hidden my-2 mx-2" data-wow-delay="0.3s">
                    <a href="#">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/candicates/alice-gabriely/1715993405jpg.jpg" alt="">
                        </div>
                        <div class="text-center p-4 mt-3">
                            <h5 class="fw-bold mb-0">Alice Gabriely</h5>
                            <small>Dobrada/SP</small>
                        </div>
                    </a>
                </div>
                <div class="candidate-item rounded shadow overflow-hidden my-2 mx-2" data-wow-delay="0.3s">
                    <a href="#">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/candicates/barbara-fernandes/1716861594jpg.jpg" alt="">
                        </div>
                        <div class="text-center p-4 mt-3">
                            <h5 class="fw-bold mb-0">Bárbara Fernandes</h5>
                            <small>Ribeirão Preto/SP</small>
                        </div>
                    </a>
                </div>
                <div class="candidate-item rounded shadow overflow-hidden my-2 mx-2" data-wow-delay="0.3s">
                    <a href="#">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/candicates/daniela-mendonca/1715993811jpg.jpg" alt="">
                        </div>
                        <div class="text-center p-4 mt-3">
                            <h5 class="fw-bold mb-0">Daniela Mendonça</h5>
                            <small>Brazópolis/MG</small>
                        </div>
                    </a>
                </div>
                <div class="candidate-item rounded shadow overflow-hidden my-2 mx-2" data-wow-delay="0.3s">
                    <a href="#">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/candicates/bruno-furman/1716404445jpg.jpg" alt="">
                        </div>
                        <div class="text-center p-4 mt-3">
                            <h5 class="fw-bold mb-0">Bruno Furma</h5>
                            <small>Contenda/PR</small>
                        </div>
                    </a>
                </div>
                <div class="candidate-item rounded shadow overflow-hidden my-2 mx-2" data-wow-delay="0.3s">
                    <a href="#">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/candicates/julia-camylle/1715994645jpg.jpg" alt="">
                        </div>
                        <div class="text-center p-4 mt-3">
                            <h5 class="fw-bold mb-0">Julia Camylle</h5>
                            <small>Barretos/SP</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Outher Candidates End -->
@endsection
