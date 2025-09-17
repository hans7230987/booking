<h1>我的資料</h1>

<p>名字: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>電話: {{ $user->phone ?? '-' }}</p>
<p>生日: {{ $user->birthday ?? '-' }}</p>
<p>地址: {{ $user->address ?? '-' }}</p>

<a href="{{ route('profile.edit') }}">編輯資料</a>
