@extends('layouts.frontend.master')
@section('title', 'Tentang Kami')
@section('content')
    <section class="page-header page-header-dark bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Tentang Kami</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="content">
        <div class="container">
            <div class="bg-white shadow-md rounded p-4">
                <h2 class="text-6 mb-3 text-center">Kelompok 3</h2>
                <div class="row d-flex align-items-stretch">
                    <div class="col-lg-4 col-sm-6 col-md-3">
                        <div class="team">
                            <img class="img-fluid rounded" alt="Horas" src="{{ asset('images/teams/horas.jpg') }}">
                            <h3>Horas Siregar</h3>
                            <p class="text-muted">CEO & Founder</p>
                            <ul class="social-icons social-icons-sm d-inline-flex">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/horas_96/" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social-icons-email">
                                    <a href="mailto:amsalsiregar12@gmail.com" target="_blank" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li class="social-icons-whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6282386143124" target="_blank"
                                        title="Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-3">
                        <div class="team">
                            <img class="img-fluid rounded" alt="Agus" src="{{ asset('images/teams/agus.jpg') }}">
                            <h3>Agus Sitorus</h3>
                            <p class="text-muted">Co-Founder</p>
                            <ul class="social-icons social-icons-sm d-inline-flex">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/_agussitorus/" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social-icons-email">
                                    <a href="mailto:" target="_blank" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li class="social-icons-whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6282274168228" target="_blank"
                                        title="Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-3">
                        <div class="team">
                            <img class="img-fluid rounded" alt="Rahel" src="{{ asset('images/teams/rahel.jpg') }}">
                            <h3>Rahel Sianipar</h3>
                            <p class="text-muted">Co-Founder</p>
                            <ul class="social-icons social-icons-sm d-inline-flex">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/rahelavs/" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i></a>
                                </li>
                                <li class="social-icons-email">
                                    <a href="mailto:rahelavs@gmail.com" target="_blank" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li class="social-icons-whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6281361299877" target="_blank"
                                        title="Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-md-3">
                        <div class="team">
                            <img class="img-fluid rounded" alt="" src="{{ asset('images/teams/juli.jpg') }}">
                            <h3>Julianti Sitorus</h3>
                            <p class="text-muted">CTO & Founder</p>
                            <ul class="social-icons social-icons-sm d-inline-flex">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/juliistr/" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social-icons-email">
                                    <a href="mailto:juliantisitorus071@mgail.com" target="_blank" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li class="social-icons-whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6283130196042" target="_blank"
                                        title="Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-3">
                        <div class="team">
                            <img class="img-fluid rounded" alt="" src="{{ asset('images/teams/emy.jpg') }}">
                            <h3>Emy Sinambela</h3>
                            <p class="text-muted">Co-Founder</p>
                            <ul class="social-icons social-icons-sm d-inline-flex">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/emy_sonia/" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social-icons-email">
                                    <a href="mailto:emysonia17@gmail.com" target="_blank" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li class="social-icons-whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6282277119407" target="_blank"
                                        title="Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-3">
                        <div class="team">
                            <img class="img-fluid rounded" alt="" src="{{ asset('images/teams/theofil.jpg') }}">
                            <h3>Theofil Naingolan</h3>
                            <p class="text-muted">Co-Founder</p>
                            <ul class="social-icons social-icons-sm d-inline-flex">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/theo_lucu/" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social-icons-email">
                                    <a href="mailto:theofiloktavia@gmail.com" target="_blank" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li class="social-icons-whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6281269149826" target="_blank"
                                        title="Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @auth
        <x-chat />
    @endauth
@endsection
