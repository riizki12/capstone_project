@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email Anda</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success">
                            Link verifikasi baru telah dikirim ke email Anda
                        </div>
                    @endif

                    <p>Sebelum melanjutkan, harap verifikasi email Anda</p>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0">
                            Kirim ulang verifikasi email
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection