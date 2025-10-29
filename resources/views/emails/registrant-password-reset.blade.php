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
            background: #daa400;
        }
        .warning {
            background-color: #e3f2fd;
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
        .patient-icon {
            font-size: 48px;
            margin-bottom: 10px;
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
            <div class="patient-icon">🦷</div>
            <h1>LC Happy Care Dental Clinic</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Patient Password Reset</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello, {{ $user->first_name }} {{ $user->last_name }},
            </div>

            <div class="message">
                <p>We received a request to reset the password for your patient account at LC Happy Care Dental Clinic.</p>
                
                <p>To reset your password and regain access to your appointment booking system, please click the button below:</p>
                
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
                <p style="word-break: break-all; background-color: #f8f9fa; padding: 10px; border-radius: 4px; font-family: monospace; font-size: 12px;">
                    {{ $resetUrl }}
                </p>
            </div>

            <div class="warning">
                <strong>🔒 Important Security Information:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>This password reset link will expire in <strong>24 hours</strong></li>
                    <li>If you did not request this password reset, please ignore this email</li>
                    <li>For your security, never share this reset link with anyone</li>
                    <li>If you continue to have issues, please contact our clinic directly</li>
                </ul>
            </div>

            <div class="message">
                <p>Once you reset your password, you'll be able to:</p>
                <ul style="color: #c59203; font-weight: 500;">
                    <li>📅 Book new appointments online</li>
                    <li>👀 View your upcoming appointments</li>
                    <li>📋 Access your appointment history</li>
                    <li>👤 Manage your profile information</li>
                </ul>
                
                <p>If you need assistance or have any questions about your dental care, please don't hesitate to contact us.</p>
                
                <p style="color: #c59203; font-weight: 500;">Thank you for choosing LC Happy Care Dental Clinic for your dental health needs!</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="clinic-info">
                <strong>LC Happy Care Dental Clinic</strong><br>
                Professional Dental Care & Online Appointment System<br>
                <em>This is an automated email, please do not reply.</em>
            </div>
            
            <div style="margin-top: 15px; font-size: 12px; color: #adb5bd;">
                For assistance, please visit our clinic or contact us through our official channels.
            </div>
        </div>
    </div>
</body>
</html>