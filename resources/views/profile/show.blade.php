@extends('layouts.app')

@section('content')
<div class="container2 my-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">我的資料</h3>
        </div>

        <div class="card-body">
            <dl class="row mb-4">
                <dt class="col-sm-3 text-muted">名字</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3 text-muted">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3 text-muted">電話</dt>
                <dd class="col-sm-9">{{ $user->phone ?? '-' }}</dd>

                <dt class="col-sm-3 text-muted">生日</dt>
                <dd class="col-sm-9">{{ $user->birthday ?? '-' }}</dd>

                <dt class="col-sm-3 text-muted">地址</dt>
                <dd class="col-sm-9">{{ $user->address ?? '-' }}</dd>
            </dl>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100">
                編輯資料
            </a>
        </div>
    </div>
</div>
@endsection
