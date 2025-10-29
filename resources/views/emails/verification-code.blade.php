<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification Code</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #daa400, #855c0a);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .verification-code {
            background: linear-gradient(135deg, #f9d616, #cdb114);
            color: white;
            font-size: 36px;
            font-weight: bold;
            padding: 20px 40px;
            border-radius: 10px;
            display: inline-block;
            letter-spacing: 8px;
            margin: 30px 0;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }
        .instructions {
            background-color: #e8f4f8;
            border-left: 4px solid #17a2b8;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
            text-align: left;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .security-icon {
            font-size: 48px;
            color: #17a2b8;
            margin-bottom: 15px;
        }
        @media (max-width: 600px) {
            .container {
                margin: 0;
                box-shadow: none;
            }
            .content, .header, .footer {
                padding: 20px;
            }
            .verification-code {
                font-size: 28px;
                padding: 15px 25px;
                letter-spacing: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="security-icon">🔐</div>
            <h1>LC Happy Care Dental Clinic</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Account Verification Code</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello, {{ $user->first_name }} {{ $user->last_name }},
            </div>

            <p style="font-size: 16px; margin-bottom: 30px;">
                You requested to update your account information. For your security, please use the verification code below:
            </p>

            <div class="verification-code">
                {{ $verificationCode }}
            </div>

            <div class="instructions">
                <h4 style="margin-top: 0; color: #17a2b8;">📝 How to use this code:</h4>
                <ol style="text-align: left; margin: 10px 0;">
                    <li>Return to the account management page</li>
                    <li>Enter this 6-digit code in the "Verification Code" field</li>
                    <li>Click "Save Changes" to update your account</li>
                </ol>
            </div>

            <div class="warning">
                <strong>⚠️ Important Security Information:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px; text-align: left;">
                    <li>This verification code will expire in <strong>10 minutes</strong></li>
                    <li>Never share this code with anyone</li>
                    <li>If you didn't request this code, please ignore this email</li>
                    <li>For security, you can only use this code once</li>
                </ul>
            </div>

            <p style="margin-top: 30px; color: #6c757d;">
                This code was requested for account: <strong>{{ $user->email }}</strong>
            </p>

            <p style="margin-top: 20px;">
                If you have any questions or need assistance, please contact our clinic staff.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>
                <strong>LC Happy Care Dental Clinic</strong><br>
                Secure Patient Account Management<br>
                <em>This is an automated security email, please do not reply.</em>
            </div>
            
            <div style="margin-top: 15px; font-size: 12px; color: #adb5bd;">
                If you continue to have issues, please visit our clinic or contact us directly.
            </div>
        </div>
    </div>
</body>
</html>