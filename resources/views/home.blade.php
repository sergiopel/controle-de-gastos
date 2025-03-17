@extends('layouts.default')

@section('page-title', 'Dashboard')

@php
    $breadcrumbs = [['label' => 'Home', 'route' => '']];
@endphp

@section('content') {{-- esse conteúdo é injetado em default.blade.php (que é a extends acima)com a diretiva @yield('content') --}}
    <!--begin::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $totalExpenses }}</h3>
                    <p>Despesas</p>
                </div>
                <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                </svg>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 2-->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $totalIncomes }}</h3>
                    <p>Receitas</p>
                </div>
                <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                    fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 2-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 4-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $saldo }}</h3>
                    <p>Saldo</p>
                </div>
                <i class="bi bi-currency-dollar small-box-icon"></i>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 4-->
        </div>
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 3-->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Total de Usuários</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                    </path>
                </svg>
                <a href="#"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 3-->
        </div>
        <!--end::Col-->
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-7 connectedSortable">
            <canvas id="myPieChart" width="400" height="400"></canvas>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Sales Value</h3>
                </div>
                <div class="card-body">
                    <div id="revenue-chart"></div>
                </div>
            </div>
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>
                    <div class="card-tools">
                        <span title="3 New Messages" class="badge text-bg-primary"> 3 </span>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-lte-toggle="chat-pane">
                            <i class="bi bi-chat-text-fill"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the start -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                <span class="direct-chat-timestamp float-end"> 23 Jan 2:00 pm </span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="../../dist/assets/img/user1-128x128.jpg"
                                alt="message user image" />
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        <!-- Message to the end -->
                        <div class="direct-chat-msg end">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                <span class="direct-chat-timestamp float-start"> 23 Jan 2:05 pm </span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="../../dist/assets/img/user3-128x128.jpg"
                                alt="message user image" />
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">You better believe it!</div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        <!-- Message. Default to the start -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                <span class="direct-chat-timestamp float-end"> 23 Jan 5:37 pm </span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="../../dist/assets/img/user1-128x128.jpg"
                                alt="message user image" />
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Working with AdminLTE on a great new app! Wanna join?
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        <!-- Message to the end -->
                        <div class="direct-chat-msg end">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                <span class="direct-chat-timestamp float-start"> 23 Jan 6:10 pm </span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="../../dist/assets/img/user3-128x128.jpg"
                                alt="message user image" />
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">I would love to.</div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div>
                    <!-- /.direct-chat-messages-->
                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../../dist/assets/img/user1-128x128.jpg"
                                        alt="User Avatar" />
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Count Dracula
                                            <small class="contacts-list-date float-end"> 2/28/2023
                                            </small>
                                        </span>
                                        <span class="contacts-list-msg"> How have you been? I was...
                                        </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../../dist/assets/img/user7-128x128.jpg"
                                        alt="User Avatar" />
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Sarah Doe
                                            <small class="contacts-list-date float-end"> 2/23/2023
                                            </small>
                                        </span>
                                        <span class="contacts-list-msg"> I will be waiting for...
                                        </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../../dist/assets/img/user3-128x128.jpg"
                                        alt="User Avatar" />
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Nadia Jolie
                                            <small class="contacts-list-date float-end"> 2/20/2023
                                            </small>
                                        </span>
                                        <span class="contacts-list-msg"> I'll call you back at...
                                        </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../../dist/assets/img/user5-128x128.jpg"
                                        alt="User Avatar" />
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Nora S. Vans
                                            <small class="contacts-list-date float-end"> 2/10/2023
                                            </small>
                                        </span>
                                        <span class="contacts-list-msg"> Where is your new... </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../../dist/assets/img/user6-128x128.jpg"
                                        alt="User Avatar" />
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            John K.
                                            <small class="contacts-list-date float-end"> 1/27/2023
                                            </small>
                                        </span>
                                        <span class="contacts-list-msg"> Can I take a look at...
                                        </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../../dist/assets/img/user8-128x128.jpg"
                                        alt="User Avatar" />
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Kenneth M.
                                            <small class="contacts-list-date float-end"> 1/4/2023
                                            </small>
                                        </span>
                                        <span class="contacts-list-msg"> Never mind I found... </span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control" />
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.direct-chat -->
        </div>
        <!-- /.Start col -->
        <!-- Start col -->
        <div class="col-lg-5 connectedSortable">
            <div class="card text-white bg-primary bg-gradient border-primary mb-4">
                <div class="card-header border-0">
                    <h3 class="card-title">Sales Value</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="world-map" style="height: 220px"></div>
                </div>
                <div class="card-footer border-0">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-4 text-center">
                            <div id="sparkline-1" class="text-dark"></div>
                            <div class="text-white">Visitors</div>
                        </div>
                        <div class="col-4 text-center">
                            <div id="sparkline-2" class="text-dark"></div>
                            <div class="text-white">Online</div>
                        </div>
                        <div class="col-4 text-center">
                            <div id="sparkline-3" class="text-dark"></div>
                            <div class="text-white">Sales</div>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
            </div>
        </div>
        <!-- /.Start col -->
    </div>
    <!-- /.row (main row) -->
@endsection
