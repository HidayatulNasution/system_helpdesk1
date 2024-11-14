@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100 rtl'])
@section('content')
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <div class="container-fluid">
        @include('layouts.sidebar')
        @include('layouts.navbar')

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-4 col-sm-4 mb-lg-0 mb-4 ms-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <!-- Di dalam navbar.blade.php -->
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold on-progress-link"
                                            style="cursor: pointer;">On Progress</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            Count
                                            <span class="text-success text-sm font-weight-bolder">qty</span>
                                        </h5>
                                    </div>
                                </div>

                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Done</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            Waiting
                                            <span class="text-success text-sm font-weight-bolder">Done</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-9 mb-lg-0 mb-3 ms-auto">
                    <div class="card">
                        <div class="card-body p-3">

                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-6">

            </div>
        </div>


        {{-- grafik section --}}
        <div id="grafik-section">
            @include('layouts.grafik')
        </div>

        {{-- progress tiket section --}}
        {{-- <div id="progress-tiket-section">
            @include('layouts.progress-tiket')
        </div> --}}
    @endsection
