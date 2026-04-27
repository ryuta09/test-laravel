<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Company</h1>
  <p>カンパニーページです！</p>
  <a href="/profile">プロフィール</a>
  <a href="{{ route('profile') }}">プロフィールルート</a>

  <a href="{{ route('admin.dashboard') }}">admin/dashboard</a>
  <a href="{{ route('admin.users') }}">admin/users</a>

</body>
</html>