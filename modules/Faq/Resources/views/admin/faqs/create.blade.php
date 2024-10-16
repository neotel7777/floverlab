@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('faq::admin.name')]))

    <li><a href="{{ route('admin.faq.index') }}">{{ trans('faq::admin.name') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('faq::admin.name')]) }}</li>
@endcomponent

@section('content')
    <form
        x-data="postCreate"
        @input="errors.clear($event.target.name)"
        @submit.prevent
        class="faq-form form"
        id="faq-create-form"
        x-ref="form"
    >
        <div class="row">
            <div class="form-left-column col-lg-8 col-md-12">
                @include('faq::admin.faqs.groups.general')
            </div>

            <div class="form-right-column col-lg-4 col-md-12">
                @include('faq::admin.faqs.groups.publish')
            </div>
        </div>

        <div class="page-form-footer">
            <button
                type="button"
                class="btn btn-default"
                :class="{ 'btn-loading': formSubmissionType === 'save' }"
                :disabled="formSubmitting"
                @click="handleSubmit({
                    submissionType: 'save'
                })"
            >
                {{ trans('admin::admin.buttons.save') }}
            </button>

            <button
                type="button"
                class="btn btn-secondary"
                :class="{ 'btn-loading': formSubmissionType === 'save_and_edit' }"
                :disabled="formSubmitting"
                @click="handleSubmit({
                    submissionType: 'save_and_edit'
                })"
            >
                {{ trans('admin::admin.buttons.save_and_edit') }}
            </button>

            <button
                type="button"
                class="btn btn-primary"
                :class="{ 'btn-loading': formSubmissionType === 'save_and_exit' }"
                :disabled="formSubmitting"
                @click="handleSubmit({
                    submissionType: 'save_and_exit'
                })"
            >
                {{ trans('admin::admin.buttons.save_and_exit') }}
            </button>
        </div>
    </form>
@endsection

@include('faq::admin.faqs.partials.shortcuts')

@push('globals')
    @vite([
        'modules/Faq/Resources/assets/admin/items/sass/main.scss',
        'modules/Faq/Resources/assets/admin/items/js/create.js',
        'modules/Media/Resources/assets/admin/sass/main.scss',
        'modules/Media/Resources/assets/admin/js/main.js',
    ])
@endpush
