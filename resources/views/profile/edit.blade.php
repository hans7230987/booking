@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">編輯我的資料</h3>
        </div>

        <div class="card-body">
            {{-- 成功訊息 --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">名字</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">電話</label>
                    <input type="text" 
                           class="form-control @error('phone') is-invalid @enderror"
                           name="phone"
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">生日</label>
                    <input type="date" 
                           class="form-control @error('birthday') is-invalid @enderror"
                           name="birthday"
                           value="{{ old('birthday', $user->birthday) }}">
                    @error('birthday')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">地址</label>
                    <input type="text" 
                           class="form-control @error('address') is-invalid @enderror"
                           name="address"
                           value="{{ old('address', $user->address) }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
