@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('verify_email.verify') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('verify_email.notification1') }}
                        </div>
                    @endif

                    {{ trans('verify_email.notification2') }}
                    {{ trans('verify_email.notification3') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ trans('verify_email.request_button') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
