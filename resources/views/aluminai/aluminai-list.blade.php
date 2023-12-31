@extends('layouts.master')

@section('title')
    {{ __('aluminai') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('alumni') }}
            </h3>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ __('list') . ' ' . __('alumni') }}
                        </h4>
                        <div class="row">
                            <div class="col-12">
                                <table aria-describedby="mydesc" class='table table-responsive' id='table_list'
                                    data-toggle="table" data-url="{{ url('aluminai_list') }}" data-click-to-select="true"
                                    data-side-pagination="server" data-pagination="true"
                                    data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true"
                                    data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true"
                                    data-fixed-columns="true" data-fixed-number="2" data-fixed-right-number="1"
                                    data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id"
                                    data-sort-order="desc" data-maintain-selected="true" data-export-types='["txt","excel"]'
                                    data-export-options='{ "fileName": "teacher-list-<?= date('d-m-y') ?>"
                                    ,"ignoreColumn":
                                    ["operate"]}' data-show-export="true" data-query-params="StudentDetailQueryParams"
                                    data-check-on-init="true">

                                    <thead>
                                        <tr>
                                            <th scope="col" data-field="image" data-formatter="imageFormatter"
                                                data-sortable="true">{{ __('image') }}</th>

                                            <th scope="col" data-field="name" data-sortable="true" data-visible="true">
                                                {{ __('Name') }}</th>
                                            <th scope="col" data-field="std_title" data-sortable="true">
                                                {{ __('description') }}</th>

                                            {{-- <th scope="col" data-field="description" data-sortable="false">
                                                {{ __('description') }}</th> --}}

                                            <th data-events="aluminaiEvents" scope="col" data-field="operate"
                                                data-sortable="false">{{ __('action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @can('teacher-edit') --}}
    <div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{ __('edit') . ' ' . __('alumni') }}</h4><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                </div>
                <form id="edit-form" class="edit-student-registration-form" novalidate="novalidate"
                    action="{{ url('aluminai') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="edit_id" id="edit_id">

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('name') }} <span class="text-danger">*</span></label>
                                {!! Form::text('name', null, [
                                    'placeholder' => __('name'),
                                    'class' => 'form-control',
                                    'id' => 'edit_name',
                                    'required' => true,
                                ]) !!}
                            </div>
                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('description') }} <span class="text-danger">*</span></label>
                                {!! Form::text('std_title', null, [
                                    'placeholder' => __('std_title'),
                                    'class' => 'form-control',
                                    'id' => 'edit_std_title',
                                    'required' => true,
                                ]) !!}
                            </div>
                            {{-- <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('description') }} <span class="text-danger">*</span></label>
                                {!! Form::text('description', null, [
                                    'placeholder' => __('description'),
                                    'class' => 'form-control',
                                    'id' => 'edit_description',
                                    'required' => true,
                                ]) !!}
                            </div> --}}
                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('image') }} <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="file-upload-default" />
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                        placeholder="{{ __('image') }}" required="required" id="edit_image" />
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-theme"
                                            type="button">{{ __('upload') }}</button>
                                    </span>
                                </div>
                                <div style="width: 100px;">
                                    <img src="" id="edit-aluminai-image-tag" class="img-fluid w-100" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-theme" type="submit" value={{ __('submit') }}>
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @endcan --}}
@endsection


@section('js')
    <script type="text/javascript">
        function queryParams(p) {
            return {
                limit: p.limit,
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                search: p.search
            };
        }
    </script>
@endsection
