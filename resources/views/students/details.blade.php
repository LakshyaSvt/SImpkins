@extends('layouts.master')

@section('title')
    {{ __('students') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('students') }}
            </h3>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ __('list') . ' ' . __('students') }}
                        </h4>
                        <div id="toolbar">
                            <div class="row">
                                <div class="col">
                                    <select name="filter_class_section_id" id="filter_class_section_id"
                                        class="form-control">
                                        <option value="">{{ __('select_class_section') }}</option>
                                        @foreach ($class_section as $class)
                                            <option value={{ $class->id }}>
                                                {{ $class->class->name . ' ' . $class->section->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <table aria-describedby="mydesc" class='table table-responsive' id='table_list'
                                    data-toggle="table" data-url="{{ url('students-list') }}" data-click-to-select="true"
                                    data-side-pagination="server" data-pagination="true" data-show-export="true"
                                    data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true"
                                    data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true"
                                    data-fixed-columns="true" data-fixed-number="2" data-fixed-right-number="1"
                                    data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id"
                                    data-sort-order="desc" data-maintain-selected="true" data-export-types='["excel"]'
                                    data-export-options='{ "fileName": "students-list-<?= date('d-m-y') ?>" ,"ignoreColumn":
                                    ["operate"]}' data-query-params="StudentDetailQueryParams"
                                    data-check-on-init="true">

                                    <thead>
                                        <tr>
                                            <th scope="col" data-field="id" data-sortable="true" data-visible="false">
                                                {{ __('id') }}</th>

                                            <th scope="col" data-field="no" data-sortable="true">{{ __('no') }}</th>
                                            @canany(['student-edit', 'student-delete'])
                                                <th data-events="studentEvents" scope="col" data-field="operate"
                                                    data-sortable="false">{{ __('action') }}</th>
                                            @endcanany
                                            <th scope="col" data-field="image" data-formatter="imageFormatter" data-sortable="true">{{ __('image') }}</th>
                                            <th scope="col" data-field="user_id" data-sortable="false"
                                                data-visible="false">{{ __('user_id') }}</th>
                                            <th scope="col" data-field="admission_no" data-sortable="false">
                                                {{ __('admission_no') }}</th>
                                            <th scope="col" data-field="full_name" data-sortable="false">
                                                {{ __('full_name') }}</th>
                                            <th scope="col" data-field="father_full_name" data-sortable="false">
                                                {{ __('father') . ' ' . __('name') }}</th>
                                            <th scope="col" data-field="mother_full_name" data-sortable="false">
                                                {{ __('mother') . ' ' . __('name') }}</th>
                                            <th scope="col" data-field="religion" data-sortable="false">
                                                {{ __('religion') }}</th>
                                            <th scope="col" data-field="gender" data-sortable="false">
                                                {{ __('gender') }}</th>
                                            <th scope="col" data-field="category_name" data-sortable="false">
                                                {{ __('category') }}</th>
                                            <th scope="col" data-field="dob" data-sortable="false">{{ __('dob') }}
                                            </th>
                                            <th scope="col" data-field="admitted_class" data-sortable="false">
                                                {{ __('admitted_class') }}
                                            </th>
                                            <th scope="col" data-field="class_section_name" data-sortable="false">
                                                {{ __('class') . ' ' . __('section') }}</th>
                                            <th scope="col" data-field="admission_date" data-sortable="false">
                                                {{ __('admission_date') }}</th>
                                            <th scope="col" data-field="father_mobile" data-sortable="false">
                                                {{ __('father') . ' ' . __('mobile') }}</th>
                                            <th scope="col" data-field="mother_mobile" data-sortable="false">
                                                {{ __('mother') . ' ' . __('mobile') }}</th>
                                            <th scope="col" data-field="current_address" data-sortable="false">
                                                {{ __('current_address') }}</th>
                                            <th scope="col" data-field="father_annual_income" data-sortable="false">
                                                {{ __('father') . ' ' . __('annual_income') }}</th>
                                            <th scope="col" data-field="aadhar_card" data-sortable="false">
                                                {{ __('aadhar_card') }}</th>
                                            <th scope="col" data-field="is_handicap_text" data-sortable="false">
                                                {{ __('is_handicap') }}</th>
                                            <th scope="col" data-field="is_only_child_text" data-sortable="false">
                                                {{ __('is_only_child') }}</th>
                                            <th scope="col" data-field="is_minority_text" data-sortable="false">
                                                {{ __('is_minority') }}</th>

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

    @can('student-edit')
        <div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{ __('edit') . ' ' . __('students') }}</h4><br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    <form id="edit-form" class="edit-student-registration-form" novalidate="novalidate"
                        action="{{ url('students') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="edit_id" id="edit_id">

                            <div class="row">
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('full_name') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('full_name', null, [
                                        'placeholder' => __('full_name'),
                                        'class' => 'form-control',
                                        'id' => 'edit_full_name',
                                    ]) !!}

                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mobile') }}</label>
                                    {!! Form::tel('mobile', null, ['placeholder' => __('mobile'), 'class' => 'form-control', 'id' => 'edit_mobile']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('gender', 'male', null, ['class' => 'form-check-input edit', 'id' => 'gender']) !!}
                                                {{ __('male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('gender', 'female', null, ['class' => 'form-check-input edit', 'id' => 'gender']) !!}
                                                {{ __('female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('gender', 'male', ['class' => 'form-check-input edit', 'id' => 'male']) !!}
                                                {{ __('male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('gender', 'female', ['class' => 'form-check-input edit', 'id' => 'female']) !!}
                                                {{ __('female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('image') }}</label>
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
                                        <img src="" id="edit-student-image-tag" class="img-fluid w-100" />
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('dob') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('dob', null, [
                                        'readonly',
                                        'placeholder' => __('dob'),
                                        'class' => 'datepicker-popup form-control',
                                        'id' => 'edit_dob',
                                    ]) !!}
                                    <span class="input-group-addon input-group-append">
                                    </span>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('class') . ' ' . __('section') }} <span class="text-danger">*</span></label>
                                    <select required name="class_section_id" class="form-control" id="edit_class_section_id">
                                        <option value="">{{ __('select') . ' ' . __('class') . ' ' . __('section') }}
                                        </option>
                                        @foreach ($class_section as $section)
                                            <option value="{{ $section->id }}">{{ $section->class->name }} -
                                                {{ $section->section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-4">
                                    <label> {{ __('category') }} <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control" id="edit_category_id">
                                        <option value="">{{ __('select') . ' ' . __('category') }}</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('admission_no') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('admission_no', null, [
                                        'placeholder' => __('admission_no'),
                                        'class' => 'form-control',
                                        'id' => 'edit_admission_no',
                                    ]) !!}

                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('roll_no') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('roll_number', null, [
                                        'placeholder' => __('roll_no'),
                                        'class' => 'form-control',
                                        'id' => 'edit_roll_number',
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('caste') }}</label>
                                    {!! Form::text('caste', null, ['placeholder' => __('caste'), 'class' => 'form-control', 'id' => 'edit_caste']) !!}

                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('religion') }}</label>
                                    {!! Form::text('religion', null, [
                                        'placeholder' => __('religion'),
                                        'class' => 'form-control',
                                        'id' => 'edit_religion',
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('admission_date') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('admission_date', null, [
                                        'readonly',
                                        'placeholder' => __('admission_date'),
                                        'class' => 'datepicker-popup form-control',
                                        'id' => 'edit_admission_date',
                                    ]) !!}
                                    <span class="input-group-addon input-group-append">
                                    </span>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('blood_group') }}</label>
                                    <select name="blood_group" class="form-control" id="edit_blood_group">
                                        <option value="">{{ __('select') . ' ' . __('blood_group') }}</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('session') }} </label>
                                    {!! Form::text('session', null, [
                                        'placeholder' => __('session'),
                                        'class' => 'form-control',
                                        'id' => 'edit_session',
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('status') }} </label>
                                    <select name="status" class="form-control edit">
                                        <option value="">{{ __('select') . ' ' . __('status') }}</option>
                                        <option value="1" id="active_status">Active</option>
                                        <option value="0" id="inactive_status">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('address') }} <span class="text-danger">*</span></label>
                                    {!! Form::textarea('current_address', null, [
                                        'placeholder' => __('current_address'),
                                        'class' => 'form-control',
                                        'id' => 'current_address',
                                        'id' => 'edit_current_address',
                                        'rows' => 2,
                                    ]) !!}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('permanent_address') }}</label>
                                    {!! Form::textarea('permanent_address', null, [
                                        'placeholder' => __('permanent_address'),
                                        'class' => 'form-control',
                                        'id' => 'permanent_address',
                                        'id' => 'edit_permanent_address',
                                        'rows' => 2,
                                    ]) !!}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('admitted_class') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('admitted_class', null, [
                                        'placeholder' => __('admitted_class'),
                                        'class' => 'form-control',
                                        'id' => 'edit_admitted_class',
                                    ]) !!}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('aadhar_card') }}</label>
                                    {!! Form::text('aadhar_card', null, [
                                        'placeholder' => __('aadhar_card'),
                                        'class' => 'form-control',
                                        'id' => 'edit_aadhar_card',
                                    ]) !!}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('is_handicap') }}</label>
                                    {{ Form::checkbox('is_handicap', '1', false, ['id' => 'edit_is_handicap', 'placeholder' => __('is_handicap')]) }}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('is_only_child') }}</label>
                                    {{ Form::checkbox('is_only_child', '1', false, ['id' => 'edit_is_only_child', 'placeholder' => __('is_only_child')]) }}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('is_minority') }}</label>
                                    {{ Form::checkbox('is_minority', '1', false, ['id' => 'edit_is_minority', 'placeholder' => __('is_minority')]) }}
                                </div>
                            </div>
                            <hr>
                            <h4>Parent Guardian Details</h4><br>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('father_email') }}</label>
                                    <select class="edit-father-search w-100" id="edit_father_email"
                                        name="father_email"></select>
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father') . ' ' . __('full_name') }} <span
                                            class="text-danger">*</span></label>
                                    {!! Form::text('father_full_name', null, [
                                        'placeholder' => __('father') . ' ' . __('full_name'),
                                        'class' => 'form-control',
                                        'id' => 'edit_father_full_name',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father') . ' ' . __('mobile') }}</label>
                                    {!! Form::text('father_mobile', null, [
                                        'placeholder' => __('father') . ' ' . __('mobile'),
                                        'class' => 'form-control',
                                        'id' => 'edit_father_mobile',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father') . ' ' . __('dob') }}</label>
                                    {!! Form::text('father_dob', null, [
                                        'placeholder' => __('father') . ' ' . __('dob'),
                                        'class' => 'form-control datepicker-popup form-control',
                                        'id' => 'edit_father_dob',
                                        'readonly' => true,
                                    ]) !!}
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father') . ' ' . __('occupation') }}</label>
                                    {!! Form::text('father_occupation', null, [
                                        'placeholder' => __('father') . ' ' . __('occupation'),
                                        'class' => 'form-control',
                                        'id' => 'edit_father_occupation',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father') . ' ' . __('annual_income') }}</label>
                                    {!! Form::text('father_annual_income', null, [
                                        'placeholder' => __('father') . ' ' . __('annual_income'),
                                        'class' => 'form-control',
                                        'id' => 'edit_father_annual_income',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father') . ' ' . __('image') }}</label>
                                    <input type="file" name="father_image" class="father_image file-upload-default" />
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="{{ __('father') . ' ' . __('image') }}" />
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme"
                                                type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                    <div style="width: 100px;">
                                        <img src="" id="edit-father-image-tag" class="img-fluid w-100" />
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('mother_email') }} </label>
                                    <select class="edit-mother-search w-100" id="edit_mother_email"
                                        name="mother_email"></select>
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mother') . ' ' . __('full_name') }} <span
                                            class="text-danger">*</span></label>
                                    {!! Form::text('mother_full_name', null, [
                                        'placeholder' => __('mother') . ' ' . __('full_name'),
                                        'class' => 'form-control',
                                        'id' => 'edit_mother_full_name',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mother') . ' ' . __('mobile') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('mother_mobile', null, [
                                        'placeholder' => __('mother') . ' ' . __('mobile'),
                                        'class' => 'form-control',
                                        'id' => 'edit_mother_mobile',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mother') . ' ' . __('dob') }}</label>
                                    {!! Form::text('mother_dob', null, [
                                        'placeholder' => __('mother') . ' ' . __('dob'),
                                        'class' => 'form-control datepicker-popup form-control',
                                        'id' => 'edit_mother_dob',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mother') . ' ' . __('occupation') }}</label>
                                    {!! Form::text('mother_occupation', null, [
                                        'placeholder' => __('mother') . ' ' . __('occupation'),
                                        'class' => 'form-control',
                                        'id' => 'edit_mother_occupation',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mother') . ' ' . __('image') }} </label>
                                    <input type="file" name="mother_image" class="file-upload-default" />
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="{{ __('mother') . ' ' . __('image') }}" />
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme"
                                                type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                    <div style="width: 100px;">
                                        <img src="" id="edit-mother-image-tag" class="img-fluid w-100" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                            id="show-edit-guardian-details">{{ __('guardian_details') }}
                                    </label>
                                </div>
                            </div>
                            <div class="row" id="edit_guardian_div" style="display:none;">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('guardian') . ' ' . __('email') }}</label>
                                    <select class="edit-guardian-search form-control" id="edit_guardian_email"
                                        name="guardian_email"></select>
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('guardian') . ' ' . __('full_name') }}</label>
                                    {!! Form::text('guardian_full_name', null, [
                                        'placeholder' => __('guardian') . ' ' . __('full_name'),
                                        'class' => 'form-control',
                                        'id' => 'edit_guardian_full_name',
                                        'readonly' => true,
                                    ]) !!}
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('guardian') . ' ' . __('mobile') }}</label>
                                    {!! Form::text('guardian_mobile', null, [
                                        'placeholder' => __('guardian') . ' ' . __('mobile'),
                                        'class' => 'form-control',
                                        'id' => 'edit_guardian_mobile',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('guardian') . ' ' . __('dob') }}</label>
                                    {!! Form::text('guardian_dob', null, [
                                        'placeholder' => __('guardian') . ' ' . __('dob'),
                                        'class' => 'form-control datepicker-popup form-control',
                                        'id' => 'edit_guardian_dob',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('guardian') . ' ' . __('occupation') }}</label>
                                    {!! Form::text('guardian_occupation', null, [
                                        'placeholder' => __('guardian') . ' ' . __('occupation'),
                                        'class' => 'form-control',
                                        'id' => 'edit_guardian_occupation',
                                        'readonly' => true,
                                    ]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('guardian') . ' ' . __('image') }} </label>
                                    <input type="file" name="guardian_image" class="file-upload-default" />
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="{{ __('guardian') . ' ' . __('image') }}" />
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme"
                                                type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                    <div style="width: 100px;">
                                        <img src="" id="edit-guardian-image-tag" class="img-fluid w-100" />
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
    @endcan
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
