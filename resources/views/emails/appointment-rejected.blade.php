<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Update - LC Happy Care Dental Clinic</title>
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
        .appointment-card {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            text-align: center;
        }
        .appointment-card h3 {
            margin: 0 0 15px 0;
            font-size: 20px;
        }
        .appointment-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #f1b513;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .detail-label {
            font-weight: bold;
            color: #c59203;
        }
        .detail-value {
            color: #2c3e50;
        }
        .rejection-box {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .action-box {
            background-color: #e3f2fd;
            border-left: 4px solid #c59203;
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
        .tooth-icon {
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
            .detail-row {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="tooth-icon">🦷</div>
            <h1>LC Happy Care Dental Clinic</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Appointment Update</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello {{ $user_name }},
            </div>

            <div class="appointment-card">
                <h3>❌ Appointment Not Approved</h3>
                <p style="margin: 0; font-size: 18px;">Your appointment request could not be accommodated</p>
            </div>

            <div class="message">
                <p>We regret to inform you that your dental appointment request has been reviewed and unfortunately cannot be accommodated at this time.</p>
                
                <p>This decision may be due to scheduling conflicts, unavailability of required services, or other operational considerations.</p>
            </div>

            <div class="appointment-details">
                <div class="detail-row">
                    <span class="detail-label">📅 Requested Date:</span>
                    <span class="detail-value">{{ $appointment_date }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🕐 Requested Time:</span>
                    <span class="detail-value">{{ $appointment_time }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">👤 Patient:</span>
                    <span class="detail-value">{{ $appointee_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🦷 Requested Services:</span>
                    <span class="detail-value">{{ $services }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📋 Status:</span>
                    <span class="detail-value" style="color: #dc3545; font-weight: bold;">{{ $status }}</span>
                </div>
            </div>

            <div class="rejection-box">
                <strong>📋 Common reasons for appointment rejection:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>The requested time slot is no longer available</li>
                    <li>Required dental equipment or specialists are unavailable</li>
                    <li>Scheduling conflicts with clinic operations</li>
                    <li>Incomplete or missing appointment information</li>
                </ul>
            </div>

            <div class="action-box">
                <strong>🔄 Next Steps - We Want to Help:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li><strong>Try Alternative Times:</strong> We may have other available slots</li>
                    <li><strong>Contact Our Office:</strong> Speak with our scheduling team for personalized assistance</li>
                    <li><strong>Online Booking:</strong> Check our patient portal for real-time availability</li>
                    <li><strong>Emergency Care:</strong> Contact us immediately if you have urgent dental needs</li>
                </ul>
            </div>

            <div class="message">
                <p>We sincerely apologize for any inconvenience this may cause. Our goal is to provide quality dental care to all our patients, and we want to work with you to find a suitable alternative.</p>
                
                <p>Please don't hesitate to contact our clinic directly. Our scheduling team will be happy to help you find an appointment time that works for both you and our practice.</p>
                
                <p style="color: #c59203; font-weight: 500;">Thank you for your understanding and for considering LC Happy Care Dental Clinic for your dental health needs!</p>
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
                Appointment ID: {{ $appointment_id }}
            </div>
        </div>
    </div>
</body>
</html>