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
    <div class="row d-flex">
        <div class="col-lg-6 connectedSortable">
            <!--begin::Card-->
            <div class="card h-100">
                <div class="card-body">
                    <div id="chart_apex" style="min-height: 400px;"></div>
                </div>
            </div>
            <!--end::Card-->
        </div>

        <div class="col-lg-6 connectedSortable">
            <!--begin::Card-->
            <div class="card h-100">
                <div class="card-body">
                    <div id="chart_apex_2" style="min-height: 400px;"></div>
                </div>
            </div>
            <!--end::Card-->
        </div>

    </div>

    <script>
        var expensesByCategory = @json($expensesByCategory);
        var incomesByCategory = @json($incomesByCategory);
    </script>
    <!-- /.row (main row) -->
@endsection
