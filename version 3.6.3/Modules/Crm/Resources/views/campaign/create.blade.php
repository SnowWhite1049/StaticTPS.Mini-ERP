@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

@section('content')
@include('crm::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header no-print">
   <h1>
        @lang('crm::lang.campaigns')
        <small>@lang('lang_v1.create')</small>
    </h1>
</section>
<section class="content no-print">
    <div class="box box-solid">
        <div class="box-body">
            {!! Form::open(['url' => action('\Modules\Crm\Http\Controllers\CampaignController@store'), 'method' => 'post', 'id' => 'campaign_form' ]) !!}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('name', __('crm::lang.campaign_name') . ':*' )!!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' ]) !!}
                       </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('campaign_type', __('crm::lang.campaign_type') .':*') !!}
                            {!! Form::select('campaign_type', ['sms' => __('crm::lang.sms'), 'email' => __('business.email')], 'email', ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if(!empty($contact_ids))
                        @php
                            $default_value = explode(',', $contact_ids);
                        @endphp
                    @else
                        @php
                            $default_value = null;
                        @endphp
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('contact_id', __('lang_v1.customers') .':*') !!}
                            {!! Form::select('contact_id[]', $customers, $default_value, ['class' => 'form-control select2', 'multiple', 'id' => 'contact_id', 'style' => 'width: 100%;']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('lead_id', __('crm::lang.leads') .':*') !!}
                            {!! Form::select('lead_id[]', $leads, $default_value, ['class' => 'form-control select2', 'multiple', 'id' => 'lead_id', 'style' => 'width: 100%;']); !!}
                        </div>
                    </div>
                </div>
                <div class="row email_div">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('subject', __('crm::lang.subject') . ':*' )!!}
                            {!! Form::text('subject', null, ['class' => 'form-control', 'required' ]) !!}
                       </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('email_body', __('crm::lang.email_body') . ':*') !!}
                            {!! Form::textarea('email_body', null, ['class' => 'form-control ', 'id' => 'email_body', 'required']); !!}
                        </div>
                    </div>
                </div>
                <div class="row sms_div">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('sms_body', __('crm::lang.sms_body') . ':') !!}
                            {!! Form::textarea('sms_body', null, ['class' => 'form-control ', 'id' => 'sms_body', 'rows' => '6', 'required']); !!}
                        </div>
                    </div>
                </div>
                <strong>@lang('lang_v1.available_tags'):</strong>
                <p class="help-block">
                    {{implode(', ', $tags)}}
                </p>

                <button type="submit" class="btn btn-primary btn-sm pull-right submit-button draft m-5" name="send_notification" value="0" data-style="expand-right">
                    <span class="ladda-label">
                        <i class="fas fa-save"></i>
                        @lang('sale.draft')
                    </span>
                </button>

                <button type="submit" class="btn btn-warning btn-sm pull-right submit-button notif m-5" name="send_notification" value="1" data-style="expand-right">
                    <span class="ladda-label">
                        <i class="fas fa-envelope-square"></i>
                        @lang('crm::lang.send_notification')
                    </span>
                </button>

            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('javascript')
    <script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>
@endsection