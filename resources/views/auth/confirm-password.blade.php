<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Password — {{ config('app.name') }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Segoe UI',Arial,sans-serif; background:#f3eeff; display:flex; align-items:center; justify-content:center; min-height:100vh; }

.card {
    width:440px; background:white; border-radius:24px;
    box-shadow:0 0 40px rgba(180,128,255,0.18); overflow:hidden;
}
.card-header {
    background:linear-gradient(135deg, #b480ff, #d3aa95);
    padding:36px 32px; text-align:center; color:white;
}
.card-header .icon { font-size:48px; margin-bottom:12px; }
.card-header h1 { font-size:22px; font-weight:700; margin-bottom:6px; }
.card-header p  { font-size:12px; color:rgba(255,255,255,0.85); line-height:1.6; }

.card-body { padding:32px; }

.input-box { position:relative; margin-bottom:16px; }
.input-box input {
    width:100%; padding:14px 48px 14px 18px;
    background:#f0f0f0; border-radius:10px; border:none; outline:none;
    font-size:14px; color:#333; font-weight:500;
    font-family:'Segoe UI',sans-serif; transition:background 0.3s;
}
.input-box input:focus { background:#ece5ff; }
.input-box i { position:absolute; right:16px; top:50%; transform:translateY(-50%); font-size:18px; color:#b480ff; }
.msg-error { background:#fff5f5; border:1px solid #fc8181; color:#e53e3e; padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:16px; }

.btn {
    width:100%; height:48px;
    background:linear-gradient(90deg, #b480ff, #d3aa95);
    border-radius:30px; border:none; cursor:pointer;
    font-size:15px; color:white; font-weight:600;
    font-family:'Segoe UI',sans-serif; transition:0.3s;
}
.btn:hover { opacity:0.9; transform:translateY(-2px); box-shadow:0 4px 15px rgba(180,128,255,0.4); }
</style>
</head>
<body>
<div class="card">
    <div class="card-header">
        <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h1>Confirm Your Password</h1>
        <p>This is a secure area. Please confirm your password before continuing.</p>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="msg-error"><i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="input-box">
                <input type="password" name="password" placeholder="Your password" required autofocus>
                <i class="fa-solid fa-lock"></i>
            </div>
            <button type="submit" class="btn"><i class="fa-solid fa-shield-halved"></i> Confirm Password</button>
        </form>
    </div>
</div>
</body>
</html>
