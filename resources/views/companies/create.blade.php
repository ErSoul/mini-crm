@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Company Create') }}</div>
                    {!! Form::open(['route' => ['companies.store'], 'method' => 'POST', 'files' => true, 'id' => 'companies_form']) !!}
                    <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="py-10 px-lg-17">
                                <div class="scroll-y me-n7 pe-7">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">{{__('Name')}}</label>
                                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="name" placeholder="{{__('Name')}}" required>
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-bold fs-6 mb-2">{{__('Email')}}</label>
                                        <input type="email" class="form-control form-control-solid mb-3 mb-lg-0" name="email" placeholder="{{__('Email')}}">
                                    </div>
                                    
                                    <div class="fv-row mb-7">
                                        <label class="fw-bold fs-6 mb-2">{{__('Logo')}}</label>
                                        <input class="form-control form-control-solid mb-3 mb-lg-0" name="logo" type="file">
                                    </div>  

                                    <div class="fv-row mb-7">
                                        <label class="fw-bold fs-6 mb-2">{{__('Web Site')}}</label>
                                        <input type="url" class="form-control form-control-solid mb-3 mb-lg-0" name="website" placeholder="{{__('Web Site')}}">
                                    </div>
                                </div> 
                                
                                <div class="flex-center pt-4"  style="text-align: right;">
                                    <a href="{{ route('companies.index') }}" class="btn btn-light me-3 form-modal-dismiss w-300px">{{__('Back')}}</a>
                                    <button type="submit"  class="btn btn-success w-300px">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
