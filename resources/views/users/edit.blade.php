@extends('layouts.default')
@section('page-title', 'Editar Usuário')
@section('page-actions')
    <a href="{{ route('users.index') }}" class="btn btn-primary">Listagem</a>
@endsection
@section('content')
    @session('status')
        <div class="alert alert-success">
            {{ $value }}
        </div>
    @endsession
    @include('users.parts.basic-details')
    <br>
    @include('users.parts.profile')
    <br>
    @include('users.parts.interests')
    <br>
    @include('users.parts.roles')
@endsection
