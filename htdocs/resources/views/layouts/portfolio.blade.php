<section class="page-section bg-light" id="portfolio">
    <div class="container">

        @yield('portfolio')

        @php
            $temRegistro = ($registros ?? false);
            $viewPortfolio = ($viewPortfolio ?? false);
            $defaultPortfolio = ($defaultPortfolio ?? 'true');
        @endphp

        @if($defaultPortfolio != 'false')
            Josimar
            <div class="text-center">
                <h2 class="section-heading text-uppercase">{{$nomePortfolio ?? 'Portfolio'}}</h2>
                <h3 class="section-subheading text-muted">{{$descriptPortfolio ?? 'portfolio'}}</h3>
            </div>

            @if ($viewPortfolio)
                @if ($temRegistro)
                    <div class="row">
                    @foreach($registros as $key => $value)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{$value->id}}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="assets/img/portfolio/01-thumbnail.jpg" alt="" />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{$value->titulo}}</div>
                                    <div class="portfolio-caption-subheading text-muted">{{$value->descricao}}</div>
                                    <x-formulario action="{{route('sign', $value->id)}}" method="post">
                                        <a class="btn btn-warning" href="{{route('rodadas', $value->id)}}">Rodadas</a>
                                        @if($value->subscriber ?? false)
                                            <button class="btn btn-success">Deixar bolão</button>
                                        @else
                                            <button class="btn btn-danger">Participar</button>
                                        @endif
                                    </x-formulario>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>

                    @foreach($registros as $key => $value)
                        <div class="portfolio-modal modal fade" id="portfolioModal{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="modal-body">
                                                    <h2 class="text-uppercase">{{$value->titulo}}</h2>
                                                    <p class="item-intro text-muted">{{$value->nome_usuario}}</p>
                                                    <!-- <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/01-full.jpg" alt="" /> -->
                                                    <p>{{$value->titulo}}</p>
                                                    <ul class="list-inline">
                                                        <li>Resultado: {{$value->pontosresultado}}</li>
                                                        <li>Extra:  {{$value->pontosextra}}</li>
                                                        <li>Taxa:  {{$value->pontostaxa}}</li>
                                                    </ul>
                                                    <x-formulario action="{{route('sign', $value->id)}}" method="post">
                                                        @if($value->subscriber ?? false)
                                                            <button class="btn btn-success">Deixar bolão</button>
                                                        @else
                                                            <button class="btn btn-danger">Participar</button>
                                                        @endif
                                                        <button class="btn btn-primary" data-dismiss="modal" type="button">
                                                            <i class="fas fa-times mr-1"></i>
                                                            Close
                                                        </button>
                                                    </x-formulario>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                @endif
            @else
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/01-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Threads</div>
                            <div class="portfolio-caption-subheading text-muted">Illustration</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/02-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Explore</div>
                            <div class="portfolio-caption-subheading text-muted">Graphic Design</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/03-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Finish</div>
                            <div class="portfolio-caption-subheading text-muted">Identity</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/04-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Lines</div>
                            <div class="portfolio-caption-subheading text-muted">Branding</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/05-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Southwest</div>
                            <div class="portfolio-caption-subheading text-muted">Website Design</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/06-thumbnail.jpg" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Window</div>
                            <div class="portfolio-caption-subheading text-muted">Photography</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>
</section>
