@extends('layouts.templates.home_template')

@section('content-home')
    <section class="section-property section-t8">
        <div class="container">

            <!-- Novidades: Sliders -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">Novidades</h2>
                        </div>
                        <div class="title-link">
                            <a href="property-grid.html">Todos os comunicados
                                <span class="bi bi-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro intro-carousel swiper position-relative">
                <div class="swiper-wrapper">

                    <div class="swiper-slide carousel-item-a intro-item bg-image"
                         style="background-image: url(home/img/slide-1.jpg)">
                        <div class="overlay overlay-a"></div>
                        <div class="intro-content display-table">
                            <div class="table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="intro-body">
                                                <p class="intro-title-top">Doral, Florida
                                                    <br> 78345
                                                </p>
                                                <h1 class="intro-title mb-4 ">
                                                    <span class="color-b">204 </span> Mount
                                                    <br> Olive Road Two
                                                </h1>
                                                <p class="intro-subtitle intro-price">
                                                    <a href="#"><span class="price-a">rent | $ 12.000</span></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide carousel-item-a intro-item bg-image"
                         style="background-image: url(home/img/slide-2.jpg)">
                        <div class="overlay overlay-a"></div>
                        <div class="intro-content display-table">
                            <div class="table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="intro-body">
                                                <p class="intro-title-top">Doral, Florida
                                                    <br> 78345
                                                </p>
                                                <h1 class="intro-title mb-4">
                                                    <span class="color-b">204 </span> Rino
                                                    <br> Venda Road Five
                                                </h1>
                                                <p class="intro-subtitle intro-price">
                                                    <a href="#"><span class="price-a">rent | $ 12.000</span></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide carousel-item-a intro-item bg-image"
                         style="background-image: url(home/img/slide-3.jpg)">
                        <div class="overlay overlay-a"></div>
                        <div class="intro-content display-table">
                            <div class="table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="intro-body">
                                                <p class="intro-title-top">Doral, Florida
                                                    <br> 78345
                                                </p>
                                                <h1 class="intro-title mb-4">
                                                    <span class="color-b">204 </span> Alira
                                                    <br> Roan Road One
                                                </h1>
                                                <p class="intro-subtitle intro-price">
                                                    <a href="#"><span class="price-a">rent | $ 12.000</span></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- Campanhas: Carousel rifa -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">Campanhas recentes</h2>
                        </div>
                        <div class="title-link">
                            <a href="property-grid.html">Todas as campanhas
                                <span class="bi bi-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="property-carousel" class="swiper">
                <div class="swiper-wrapper">
                    @foreach($rifas as $rifa)

                        @php
                            $numeros_selecionados = [];

                            foreach ($transacoes as $transacao) {
                                if ($transacao->rifa_id == $rifa->id) {
                                    $numeros = explode(",", $transacao->numero_selecionado);
                                    $numeros_selecionados = array_merge($numeros_selecionados, $numeros);
                                }
                            }

                            $total_numeros = count($numeros_selecionados);
                            $numeros_restantes = $rifa->limite_numeros - $total_numeros;

                            $status = $rifa->status->value;

                            $bg = "";

                            if($status === "aberto") {
                                $btnRifa = "EM BREVE";
                                $valor = $rifa->valor;
                                $status = "EM BREVE";
                                $bg = "bg-warning";
                            } else if ($status === "andamento") {
                                $btnRifa = "PARTICIPAR";
                                $valor = $rifa->valor;
                            } else {
                                $btnRifa = "FINALIZADO";
                                $valor = $rifa->valor;
                                $bg = "bg-danger";
                            }
                        @endphp

                        <div class="carousel-item-b swiper-slide">
                            <div class="card-box-a card-shadow">
                                <div class="img-box-a">
                                    <img src="{{'storage/'.$rifa->imagem}}" style="height: 350px;"
                                         class="img-a img-fluid">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-overlay-a-content">
                                        <div class="card-header-a">
                                            <h2 class="card-title-a">
                                                <a href="property-single.html">{{strtoupper($rifa->titulo)}}</a>
                                            </h2>
                                        </div>
                                        <div class="card-body-a">
                                            <div class="price-box d-flex">
                                                <span class="price-a mt-2">{{ $status }} | R$ {{$valor}}</span>
                                            </div>
                                            <a href="{{route('filament.app.resources.transacao-rifas.create', $rifa->id)}}" class="btn btn-b-n my-3 {{$bg}}">
                                                {{$btnRifa}}
                                            </a>
                                        </div>
                                        <div class="card-footer-a">
                                            <ul class="card-info d-flex justify-content-around text-center">
                                                <li>
                                                    <h4 class="card-info-title">Total Núm</h4>
                                                    <span>{{$rifa->limite_numeros}}</span>
                                                </li>
                                                <li>
                                                    <h4 class="card-info-title">Número Restantes</h4>
                                                    <span>{{$numeros_restantes}}</span>
                                                </li>
                                                <li>
                                                    <h4 class="card-info-title">Sorteio</h4>
                                                    <span>{{\Carbon\Carbon::parse($rifa->data_previsao_sorteio)->format('d/m/Y')}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="propery-carousel-pagination carousel-pagination"></div>
        </div>
    </section>
@endsection
