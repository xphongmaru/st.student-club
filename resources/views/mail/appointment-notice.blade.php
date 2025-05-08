<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thư mời phỏng vấn tham gia Câu lạc bộ</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f2f5; padding: 20px;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    <tr>
        <td style="padding: 20px;">
            <h2 style="color: #2c3e50;">🎉 Thư mời phỏng vấn tham gia Câu lạc bộ {{$club->name}}</h2>

            <p>Chào bạn <strong>{{$receiver->full_name}}</strong>,</p>

            <p>Cảm ơn bạn đã quan tâm và đăng ký tham gia <strong>Câu lạc bộ {{$club->name}}</strong>. Chúng mình rất vui khi nhận được hồ sơ của bạn!</p>

            <p>Để hiểu rõ hơn về bạn cũng như tạo điều kiện để bạn tìm hiểu thêm về CLB, chúng mình trân trọng mời bạn đến buổi phỏng vấn với thông tin như sau:</p>

            <ul>
                <li><strong>⏰ Thời gian:</strong> {{$date}}</li>
                <li><strong>👥 Hình thức:</strong> {{$content}}</li>
                <li><strong>📍 Địa điểm:</strong> {{$address}}</li>
                @if($note)
                    <li><strong>📝 Ghi chú:</strong> {{$note}}</li>
                @endif
            </ul>

            <p>👉 Vui lòng phản hồi lại email này để xác nhận bạn sẽ tham gia phỏng vấn.</p>

            <p>Nếu bạn có bất kỳ thắc mắc nào, đừng ngần ngại liên hệ với chúng mình qua:</p>
            <ul>
                <li>Email: <a href="mailto:[email]">{{$club->email}}</a></li>
                <li>SĐT/Zalo: {{$club->phone}}</li>
            </ul>

            <p>Chúc bạn một ngày thật tốt lành,</p>

            <p>Thân mến,<br>
                <strong>{{$sender->full_name}}</strong><br>
                Câu lạc bộ {{$club->name}}</p>
        </td>
    </tr>
</table>
</body>
</html>
