@extends('layouts.master')

@section('title')
    {{ __('teacher') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('teacher') }}
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ __('create') . ' ' . __('teacher') }}
                        </h4>
                        <form class="pt-3 teacher-registration-form" enctype="multipart/form-data"
                            action="{{ route('teachers.store') }}" method="POST" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('teacher_code') }} </label>
                                    {!! Form::text('teacher_code', $teacher_code, ['placeholder' => __('teacher_code'), 'readonly' => true, 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('name') }} </label>
                                    {!! Form::text('name', null, ['placeholder' => __('name'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mobile') }} </label>
                                    {!! Form::text('mobile', null, ['placeholder' => __('mobile'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('additional_mobile') }}</label>
                                    {!! Form::text('additional_mobile', null, ['placeholder' => __('additional_mobile'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('email') }}</label>
                                    {!! Form::text('email', null, ['placeholder' => __('email'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('father_name') }} </label>
                                    {!! Form::text('father_name', null, ['placeholder' => __('father_name'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('mother_name') }} </label>
                                    {!! Form::text('mother_name', null, ['placeholder' => __('mother_name'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('religion') }} </label>
                                    {!! Form::text('religion', null, ['placeholder' => __('religion'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('gender') }} </label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('gender', 'male') !!}
                                                {{ __('male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('gender', 'female') !!}
                                                {{ __('female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('image') }} <span class="text-danger">*</span> </label>
                                    <input type="file" name="image" class="file-upload-default" />
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="{{ __('image') }}" />
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme"
                                                type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('category') }} </label>
                                    {!! Form::text('category', null, ['placeholder' => __('category'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('dob') }} <span class="text-danger">*</span></label>
                                    {!! Form::text('dob', null, ['placeholder' => __('dob'), 'class' => 'datepicker-popup form-control']) !!}
                                    {{-- <span class="input-group-addon input-group-append">
                                    </span> --}}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('designation') }} </label>
                                    {!! Form::text('designation', null, ['placeholder' => __('designation'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('date_of_joining') }} </label>
                                    {!! Form::text('date_of_joining', null, [
                                        'placeholder' => __('date_of_joining'),
                                        'class' => 'datepicker-popup form-control',
                                    ]) !!}
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('address') }} </label>
                                    {!! Form::textarea('address', null, ['placeholder' => __('address'), 'class' => 'form-control', 'rows' => 2]) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('aadhar_card') }}</label>
                                    {!! Form::text('aadhar_card', null, ['placeholder' => __('aadhar_card'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('pancard') }}</label>
                                    {!! Form::text('pancard', null, ['placeholder' => __('pancard'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('bank_name') }}</label>
                                    {!! Form::text('bank_name', null, ['placeholder' => __('bank_name'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('bank_acc_no') }}</label>
                                    {!! Form::text('bank_acc_no', null, ['placeholder' => __('bank_acc_no'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('qualification') }} </label>
                                    {!! Form::text('qualification', null, ['placeholder' => __('qualification'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('ifsc_code') }}</label>
                                    {!! Form::text('ifsc_code', null, ['placeholder' => __('ifsc_code'), 'class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-12 col-md-12">
                                    <label>{{ __('marital_status') }}</label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('marital_status', 'Married') !!}
                                                {{ __('married') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('marital_status', 'Unmarried') !!}
                                                {{ __('unmarried') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                {!! Form::radio('marital_status', 'Not to be disclosed') !!}
                                                {{ __('not_to_be_disclosed') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('spouse') }}</label>
                                    {!! Form::text('spouse', null, ['placeholder' => __('spouse'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('pincode') }}</label>
                                    {!! Form::number('pincode', null, ['placeholder' => __('pincode'), 'class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('salary_mode') }}</label>
                                    <select name="salary_mode" class="form-control" id="edit_salary_mode">
                                        <option value="" selected disabled>{{ __('select') . ' ' . __('salary_mode') }}
                                        <option value="{{ __('cash') }}"> {{ __('cash') }}</option>
                                        <option value="{{ __('bank') }}">{{ __('bank') }}</option>
                                    </select>
                                    {{-- {!! Form::text('pincode', null, ['placeholder' => __('pincode'), 'class' => 'form-control']) !!} --}}
                                </div>
                            </div>
                            <input class="btn btn-theme" type="submit" value={{ __('submit') }}>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
