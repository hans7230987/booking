<h1>編輯我的資料</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('profile.update') }}" method="POST">
    @csrf
    <label>名字</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}">
    
    <label>電話</label>
    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
    
    <label>生日</label>
    <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}">
    
    <label>地址</label>
    <input type="text" name="address" value="{{ old('address', $user->address) }}">
    
    <button type="submit">更新</button>
</form>