@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6" style="margin: auto;">
                            <div class="col-md-12">
                                <a href="{{ route('companies.index') }}" role="button" class="btn btn-primary" style="width: 100%;">{{__('View Registered Companies')}}</a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('employees.index') }}" role="button" class="btn btn-secondary" style="width: 100%;">{{__('View Registered Employees')}}</a>
                            </div>
                            <div class="col-md-12">
                                <a role="button" class="btn btn-success" href="{{route('localization')}}" style="width: 100%;">{{__('Change Language')}}</a>
                            </div>
                        </div>
                    </div>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
