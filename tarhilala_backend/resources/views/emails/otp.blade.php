<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Tarhilala</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            background: #2563eb;
            padding: 24px 20px;
            text-align: center;
        }

        .header h2 {
            color: white;
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }

        .header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            margin-top: 6px;
        }

        .content {
            padding: 32px 24px;
        }

        .greeting {
            font-size: 15px;
            color: #333;
            margin-bottom: 16px;
        }

        .message {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .otp-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            margin: 20px 0;
            border: 1px solid #e2e8f0;
        }

        .otp-code {
            font-size: 40px;
            font-weight: 700;
            letter-spacing: 8px;
            color: #1e293b;
            font-family: 'Courier New', monospace;
        }

        .expiry {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 12px;
        }

        .warning {
            background: #fef2f2;
            border-left: 3px solid #ef4444;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 24px 0;
        }

        .warning-text {
            font-size: 12px;
            color: #991b1b;
            line-height: 1.5;
        }

        .footer {
            background: #f9fafb;
            padding: 20px 24px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            color: #9ca3af;
            font-size: 11px;
            margin: 4px 0;
        }

        @media (max-width: 480px) {
            .content {
                padding: 24px 20px;
            }

            .otp-code {
                font-size: 32px;
                letter-spacing: 6px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Tarhilala</h2>
            <p>Verifikasi Keamanan Akun</p>
        </div>

        <div class="content">
            <div class="greeting">
                Halo Pengguna Tarhilala,
            </div>

            <div class="message">
                Kami menerima permintaan reset password. Gunakan kode OTP berikut untuk melanjutkan:
            </div>

            <div class="otp-box">
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <div class="warning">
                <div class="warning-text">
                    <strong>🔒 Jangan bagikan kode ini</strong><br>
                    Tim Tarhilala tidak akan pernah meminta kode OTP Anda.
                </div>
            </div>

            <div style="text-align: center; margin-top: 16px;">
                <p style="color: #9ca3af; font-size: 12px;">
                    Jika Anda tidak meminta reset password, abaikan email ini.
                </p>
            </div>
        </div>

        <div class="footer">
            <p>© 2024 Tarhilala. All rights reserved.</p>
            <p>support@tarhilala.com</p>
        </div>
    </div>
</body>
</html>
