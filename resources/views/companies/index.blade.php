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
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Companies') }}</div>
            <div class="card-body">
                <div class="container-fluid">
                    @can('company_create') 
                        <a href="{{ route('companies.create') }}" class="btn btn-success">{{__('Create new company')}}</a>
                    @endcan
                    <div class="card">
                        <div class="card-body border-0 pt-6">
                            <div class="pt-0 table-responsive">
                                <table id="kt_datatable_example_1" class="table companies_table align-middle table-row-dashed fs-6 gs-10 gy-7 gx-7">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-60px">{{__('ID')}}</th>
                                            <th class="w-350px">{{__('Name')}}</th>
                                            <th class="w-350px">{{__('Email')}}</th>
                                            <th class="w-350px">{{__('Logo')}}</th>
                                            <th class="w-350px">{{__('Web Site')}}</th>
                                            @can('company_edit','company_delete') 
                                                <th>{{__('Actions')}}</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@php
$edit_route = route("companies.edit", ["company" => 'id-here']);
$delete_route = route("companies.destroy", ["company" => 'id-here']);
@endphp

<script>
    $(document).ready(function () {

        var actionsHtml = `@can('company_edit','company_delete') 
                            <div class="dropdown ">
                                <a class="w-100px btn btn-light btn-active-white btn-sm" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{__('Actions')}}<i class="fas fa-angle-down"></i>
                                </a>
                                <div class="menu dropdown-menu w-50 menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 fw-bold fs-7 w-200px py-4" aria-labelledby="dropdownMenuButton1">
                                    <div class="menu-item">
                                        <a href="{{ $edit_route }}" class="menu-link text-hover-inverse-light">
                                            <span class="mx-3"><i class="fas fa-edit"></i></span>
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <form class="delete-form" method="POST" action="{{ $delete_route }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="#" class="delete-item menu-link text-hover-inverse-light">
                                                <span class="mx-3"><i class="fas fa-trash-alt"></i></span>
                                                {{ __('Delete') }}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            @endcan`;

        var can = "{!!  auth()->user()->can('company_edit','company_delete') !!}";
        // console.log(can);
        var columns;
        if(can){
        
            columns = [ 
                { data: 'id' }, //Return ID in the ROW
                { data: 'name' },
                { data: 'email' },
                { data: 'logo' },
                { data: 'website' },
                { data: 'actions', render: function(data, type, row, meta){
                    let actions = actionsHtml.replaceAll('id-here', row.id);

                    return `${actions}`;
                }, className: 'actions-column', orderable: false, searchable: false},
            ];
        } else {
            columns = [ 
                { data: 'id' }, //Return ID in the ROW
                { data: 'name' },
                { data: 'email' },
                { data: 'logo' },
                { data: 'website' }
            ];
        }
        
		const table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            bFilter: false,
            info: false,
            lengthChange: false,
            ajax: {
                url: '{{ route('companies.index') }}',
                dataFilter: function(data){
                    var json = JSON.parse( data );
                    json.recordsTotal = json.last_page;
                    json.recordsFiltered = json.total;
        
                    return JSON.stringify( json );
                },
                data: function(data, settings){
                    const page = $('.table').DataTable().page.info().page;

                    for(let key in data.order){
                        const column = data.order[key].column;

                        data.order[key].column_name = settings.aoColumns[column].data;
                    }

                    data.page = page + 1;
                }
            },
            columns: columns,
            columnDefs: [    
                    {
                        targets: 3,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {

                            let logo = `{{asset('/images/logo.jpg')}}`;
                            return `<img src="${row.logo ?? logo}" alt="logo" width="60" height="60">`
                        },
                    }  ,            
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            let actions = actionsHtml.replaceAll('id-here', row.id);

                            return `${actions}`
                        },
                    }
                ],
            order: [[ 2, "desc" ]],
            language: {
                zeroRecords: "{{__('Nothing found - sorry')}}",
                infoEmpty: "{{__('No records available')}}",
                paginate: {
                    "next": "{{__('Next')}}",
                    "previous": "{{__('Previous')}}"
                }
            }
        });
	});

</script>
@endsection