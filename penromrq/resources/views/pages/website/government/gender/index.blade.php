@extends('pages.website.gender.layouts.layout')

@section('content')

    <style type="text/css">
        .c-height {
            height: 500px;
        }

        @media (max-width: 767px) {
            .c-height {
                height: 300px;
            }
        }

        @media (max-width: 574px) {
            .container {
                padding:0;
                margin:0;
            }
            .c-height {
                height: 300px;
            }
        }

        .content {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0); /* Fallback color */
            background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
            width: 100%;
            padding: 20px;
        }
        
        .content a {
            color: #f1f1f1;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

    </style>

    <section class="bg-light py-4" id="home">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($Carousel as $key => $value)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="@if($key == 0) active @endif"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($Carousel as $key => $value)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <img class="d-block w-100 c-height" src="{{ asset($value->carousel_path) }}" alt="{{ $value->carousel_text }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-light py-5" id="activities">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="" style="color: #4f31a3; font-weight: bold;"> GAD RELATED ACTIVITIES </h2>
                    <p class="lead hide" style="display: none;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
                </div>
            </div>
            <div id="activities-pagination">
                @include('pages.website.gender.includes.activities')
            </div>
        </div>
    </section>

    <section class="bg-light py-5" id="announcements">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <h2 class="" style="color: #4f31a3; font-weight: bold;"> ANNOUNCEMENTS </h2>
                    <p class="lead"></p>

                    <div id="announcement-pagination">
                        @include('pages.website.gender.includes.announcement')
                    </div>
                </div>
                <div class="col-lg-6 mx-auto">
                    <h2 class="" style="color: #4f31a3; font-weight: bold;"> CALENDAR </h2>

                    <div id="calendar-pagination" class="mt-3">
                        @include('pages.website.gender.includes.calendar')
                    </div>
                    
                </div>
            </div>

        </div>
    </section>

    <section class="bg-light py-5" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="" style="color: #4f31a3; font-weight: bold;"> MEDIA GALLERY </h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card card-shadow mb-4">
                        <div id="photoreleases" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($PhotoReleases as $key => $value)
                                <div class="carousel-item @if($key == 0) active @endif">
                                    <img class="d-block w-100" style="height: 300px;" src="{{ asset($value->photos->file_path) }}" alt="{{ $value->photos->file_name }}">
                                    <div class="content text-center text-white d-none d-md-block">
                                        <a href="{{ $value->photos->file_link }}" @if($value->photos->file_tab == '1') target="_blank" @endif>{{ $value->photos->file_name }}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#photoreleases" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#photoreleases" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body d-none">
                            <h5 class="card-title text-info"> International Day of Rural Women </h5>
                            <small style="font-size: 12px; color:#999;">January 01, 2019 by <a href="">Probuilder.com</a></small>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content...</p>
                            <a href="#" class="btn btn-info btn-sm pull-right"> Read More <i class="fa fa-double-caret-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mx-auto">
                    <div class="card card-shadow mb-4">
                        <div id="featuredvideos" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($FeatureVideos as $key => $value)
                                <div class="carousel-item @if($key == 0) active @endif" style="background-image: url({{ asset($value->videos->file_path)}} ); background-size: 100% 100%; height: 300px;">
                                    <a href="{{ $value->videos->file_link }}" target="_blank">
                                        <div class="d-flex justify-content-center" style="margin-top: 85px;">
                                            <svg height="30%" version="1.1" viewBox="0 0 68 48" width="30%">
                                                <path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#FF0000" fill-opacity="0.9"></path><path d="M 45,24 27,14 27,34" fill="#fff">
                                                </path>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="content text-center text-white d-none d-md-block">
                                        <a href="{{ $value->videos->file_link }}" @if($value->videos->file_tab == '1') target="_blank" @endif>
                                            {{ $value->videos->file_name }}
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#featuredvideos" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#featuredvideos" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body d-none">
                            <h5 class="card-title text-info"> International Day of Rural Women </h5>
                            <small style="font-size: 12px; color:#999;">January 01, 2019 by <a href="">Probuilder.com</a></small>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content...</p>
                            <a href="#" class="btn btn-info btn-sm pull-right"> Read More <i class="fa fa-double-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 d-none" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="" style="color: #4f31a3; font-weight: bold;"> ABOUT US </h2>
                    <p class="lead d-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
                </div>
                <div class="col-lg-6 text-center">
                    <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                    <h2>VISION</h2>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                    {{-- <p class="lead"><a class="btn btn-info" href="#" role="button">View details »</a></p> --}}
                </div>
                <div class="col-lg-6 text-center">
                    <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                    <h2>MISSION</h2>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                    {{-- <p class="lead"><a class="btn btn-info" href="#" role="button">View details »</a></p> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5" id="contact" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="" style="color: #4f31a3; font-weight: bold;"> CONTACT US </h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
                </div>
            </div>
            <div class="row featurette my-4">
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" style="width: 500px; height: 500px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22500%22%20height%3D%22500%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20500%20500%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16e636b833e%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A25pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16e636b833e%22%3E%3Crect%20width%3D%22500%22%20height%3D%22500%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22185.125%22%20y%3D%22261.2828125%22%3E500x500%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control input-xl" name="" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control input-xl" name="" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control input-xl" style="min-height: 175px;" name="" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-lg btn-default btn-flat"> Send </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

