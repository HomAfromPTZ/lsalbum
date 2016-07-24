@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Привет {{$user->name}}! Ты вошел!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title')
    Альбом пользователя {{$user->name}}
@endsection