<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
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
            background: linear-gradient(135deg, #f1b513, #c59203);
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
        }
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.8;
        }
        .reset-button {
            display: inline-block;
            background: #c59203;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.3s;
        }
.reset-button:hover {
    background: #daa400 !important; /* Use !important to try and force the override */
    border-color: #daa400 !important;
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
        .clinic-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        @media (max-width: 600px) {
            .container {
                margin: 0;
                box-shadow: none;
            }
            .content, .header, .footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🦷 LC Happy Care Dental Clinic</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Password Reset Request</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello Dr. {{ $admin->first_name }} {{ $admin->last_name }},
            </div>

            <div class="message">
                <p>We received a request to reset the password for your dentist account at LC Happy Care Dental Clinic.</p>
                
                <p>To reset your password, please click the button below:</p>
                
<div style="text-align: center; margin: 30px 0;">
    <a href="{{ $resetUrl }}"
       style="
           display: inline-block;
           background: #c59203; /* Button Background Color (Your Gold/Yellow) */
           color: #ffffff; /* CRUCIAL FIX: Explicit White Text Color */
           padding: 15px 30px;
           text-decoration: none;
           border-radius: 5px;
           font-weight: bold;
           font-size: 16px;
           margin: 20px 0;
           border: 1px solid #c59203; /* Optional: adds definition */
       "
    >
        Reset My Password
    </a>
</div>
                
                <p>Alternatively, you can copy and paste this link into your browser:</p>
                <p style="word-break: break-all; background-color: #f8f9fa; padding: 10px; border-radius: 4px; font-family: monospace;">
                    {{ $resetUrl }}
                </p>
            </div>

            <div class="warning">
                <strong>⚠️ Important Security Information:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>This password reset link will expire in <strong>2 hours</strong></li>
                    <li>If you did not request this password reset, please ignore this email</li>
                    <li>For your security, never share this reset link with anyone</li>
                </ul>
            </div>

            <div class="message">
                <p>If you're having trouble clicking the button, or if you didn't request this password reset, please contact the clinic administrator or try requesting a new reset link.</p>
                
                <p>Thank you for using our dental management system!</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="clinic-info">
                <strong>LC Happy Care Dental Clinic</strong><br>
                Professional Dental Care Management System<br>
                <em>This is an automated email, please do not reply.</em>
            </div>
            
            <div style="margin-top: 15px; font-size: 12px; color: #adb5bd;">
                If you have any questions, please contact your system administrator.
            </div>
        </div>
    </div>
</body>
</html>