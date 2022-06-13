@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee Edit') }}</div>
                <form action="{{route('employees.update', $employee->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="py-10 px-lg-17">
                            <div class="scroll-y me-n7 pe-7">
                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">{{__('First Name')}}</label>
                                    <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="firstName" placeholder="{{__('First Name')}}" value="{{$employee->firstName}}">
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">{{__('Last Name')}}</label>
                                    <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="lastName" placeholder="{{__('Last Name')}}" value="{{$employee->lastName}}">
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">{{__('Email')}}</label>
                                    <input type="email" class="form-control form-control-solid mb-3 mb-lg-0" name="email" placeholder="{{__('Email')}}" value="{{$employee->email}}">
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">{{__('Phone')}}</label>
                                    <input type="tel" class="form-control form-control-solid mb-3 mb-lg-0" name="phone" placeholder="{{__('Phone')}}" value="{{$employee->phone}}">
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">{{__('Company')}}</label>
                                    <br>
                                    <select name="company_id" class="form-control fw-bold fs-6 mb-2 form-select" required>
                                        @foreach($companies as $company)
                                            @if($company->id === $employee->company->id)
                                            <option value="{{$company->id}}" selected>{{$company->name}}</option>
                                            @else
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                            </div> 
                            
                            <div class="flex-center pt-4"  style="text-align: right;">
                                <a href="{{ route('employees.index') }}" class="btn btn-light me-3 form-modal-dismiss w-300px">{{__('Back')}}</a>
                                <button type="submit"  class="btn btn-success w-300px">{{__('Save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
