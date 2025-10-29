<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to LC Happy Care Dental Clinic</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .welcome-message {
            font-size: 18px;
            color: #28a745;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .verification-code {
            display: inline-block;
            background: linear-gradient(135deg, #e3f2fd 0%, #f1f8e9 100%);
            border: 3px solid #28a745;
            border-radius: 12px;
            padding: 20px 30px;
            margin: 25px 0;
            font-size: 36px;
            font-weight: bold;
            color: #1b5e20;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .instructions {
            background-color: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 30px 0;
            text-align: left;
            border-radius: 0 8px 8px 0;
        }
        .instructions h3 {
            color: #28a745;
            margin-top: 0;
            font-size: 18px;
        }
        .instructions ol {
            margin: 15px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin: 8px 0;
            font-size: 15px;
        }
        .benefits {
            background-color: #e8f5e8;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
        }
        .benefits h3 {
            color: #1b5e20;
            margin-top: 0;
            display: flex;
            align-items: center;
        }
        .benefits ul {
            margin: 15px 0;
            padding-left: 20px;
        }
        .benefits li {
            margin: 8px 0;
            font-size: 15px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
            text-align: left;
        }
        .warning .icon {
            color: #856404;
            font-size: 18px;
            margin-right: 8px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #6c757d;
        }
        .contact-info {
            margin-top: 15px;
            font-size: 13px;
            color: #6c757d;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }
            .content {
                padding: 30px 20px;
            }
            .verification-code {
                font-size: 28px;
                letter-spacing: 4px;
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🦷 LC Happy Care</h1>
            <p>Dental Clinic - Your Smile, Our Priority</p>
        </div>

        <div class="content">
            <div class="welcome-message">
                🎉 Welcome to LC Happy Care Dental Clinic!
            </div>
            
            <p>Thank you for choosing us for your dental care needs. To complete your account registration and verify your email address, please use the verification code below:</p>

            <div class="verification-code">
                {{ $verificationCode }}
            </div>

            <div class="instructions">
                <h3>📋 How to Complete Your Registration:</h3>
                <ol>
                    <li>Return to the registration form on our website</li>
                    <li>Enter the 6-digit verification code above in the "Verification Code" field</li>
                    <li>Complete the remaining form fields if not already filled</li>
                    <li>Click "Sign Up" to create your account</li>
                </ol>
            </div>

            <div class="benefits">
                <h3>🌟 What You Can Do With Your Account:</h3>
                <ul>
                    <li><strong>Book Appointments:</strong> Schedule dental appointments at your convenience</li>
                    <li><strong>Track History:</strong> View your appointment history and treatment records</li>
                    <li><strong>Manage Profile:</strong> Update your personal information and preferences</li>
                    <li><strong>Receive Updates:</strong> Get important notifications about your dental care</li>
                </ul>
            </div>

            <div class="warning">
                <span class="icon">⚠️</span>
                <strong>Important Security Information:</strong>
                <ul style="margin: 10px 0; padding-left: 25px;">
                    <li>This verification code expires in <strong>15 minutes</strong></li>
                    <li>Do not share this code with anyone</li>
                    <li>If you didn't request this, please ignore this email</li>
                    <li>You can request a new code if this one expires</li>
                </ul>
            </div>

            <p style="margin-top: 30px; color: #6c757d;">
                Having trouble? Feel free to contact our support team, and we'll be happy to help you get started with your dental care journey.
            </p>
        </div>

        <div class="footer">
            <p><strong>LC Happy Care Dental Clinic</strong></p>
            <p>Providing quality dental care with a smile</p>
            
            <div class="contact-info">
                <p>📧 Email: {{ config('mail.from.address') }}</p>
                <p>🏥 Your trusted dental care partner</p>
                <p style="margin-top: 15px; font-size: 12px;">
                    This is an automated message. Please do not reply to this email.
                </p>
            </div>
        </div>
    </div>
</body>
</html>