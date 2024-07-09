@extends('Dashboard.layouts.master')
@section('css')
@include('Dashboard.layouts.tableCSS')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{trans('dashboard/main-sidebar_trans.sections')}}/</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">{{trans('dashboard/main-sidebar_trans.view_all')}}</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


@include('Dashboard.messages_alert')
				<!-- row -->
				<div class="row">


					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                            {{trans('dashboard/sections_trans.add_sections')}}
                                        </button>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">{{trans('dashboard/sections_trans.name_sections')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('sections_trans.description')}}</th>
                                                <th class="wd-20p border-bottom-0">{{trans('dashboard/sections_trans.created_at')}}</th>
                                                <th class="wd-20p border-bottom-0">{{trans('dashboard/sections_trans.Processes')}}</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($sections as $section)

                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><a href={{route('sections.show', $section->id)}}>{{$section->name}}</a></td>
                                                <td><a href={{route('sections.show', $section->id)}}>{{\Str::limit($section->description, 20, '...')}}</a> </td>
                                                <td>{{ $section->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$section->id}}"><i class="las la-pen"></i></a>
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$section->id}}"><i class="las la-trash"></i></a>
                                                </td>

                                                @include('Dashboard.Sections.edit')
                                                @include('Dashboard.Sections.delete')
                                            @endforeach


										</tbody>
									</table>
								</div>
                                @include('Dashboard.Sections.add')
							</div>
						</div>
					</div>
					<!--/div-->




				</div>


			<!-- Container closed -->

		<!-- main-content closed -->
@endsection
@section('js')
            @include('Dashboard.layouts.tableJS')
@endsection
