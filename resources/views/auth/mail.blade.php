<div style="width: 500px;
        margin: 0 auto;
        padding: 15px;
        text-align: center;">
    <span>Đây là tin nhắn xác nhận việc đổi mật khẩu của bạn đến từ {{ config('app.name') }}</span>
    <span>Để xác nhận và bắt đầu việc đổi mật khẩu của bạn vui lòng ấn nút bên dưới</span>
    <br>
    <a
        style="background-color: #00bcd4;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 10px;"
            href="{{ route('reset_password', $forgetPassword->token) }}">
        Đổi mật khẩu
    </a>
</div>