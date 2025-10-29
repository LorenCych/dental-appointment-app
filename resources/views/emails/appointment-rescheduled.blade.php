<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Rescheduled - LC Happy Care Dental Clinic</title>
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
            background: linear-gradient(135deg, #c59203, #daa400);
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
        .schedule-comparison {
            display: flex;
            gap: 20px;
            margin: 25px 0;
        }
        .schedule-box {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .old-schedule {
            background-color: #f8d7da;
            border: 2px solid #f5c6cb;
        }
        .new-schedule {
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
        }
        .schedule-header {
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .old-schedule .schedule-header {
            color: #721c24;
        }
        .new-schedule .schedule-header {
            color: #155724;
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
        .info-box {
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
            .schedule-comparison {
                flex-direction: column;
                gap: 15px;
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
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Appointment Rescheduled</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello, {{ $user_name }},
            </div>

            <div class="appointment-card">
                <h3>📅 Appointment Rescheduled</h3>
                <p style="margin: 0; font-size: 18px;">Your appointment time has been updated</p>
            </div>

            <div class="message">
                <p>Dr. {{ $dentist_name }} has rescheduled your dental appointment. Please note the new date and time below:</p>
            </div>

            <div class="schedule-comparison">
                <div class="schedule-box old-schedule">
                    <div class="schedule-header">❌ Previous Schedule</div>
                    <div style="font-size: 16px; line-height: 1.6;">
                        <strong>{{ $original_date }}</strong><br>
                        {{ $original_time }}
                    </div>
                </div>
                <div class="schedule-box new-schedule">
                    <div class="schedule-header">✅ New Schedule</div>
                    <div style="font-size: 16px; line-height: 1.6;">
                        <strong>{{ $new_date }}</strong><br>
                        {{ $new_time }}
                    </div>
                </div>
            </div>

            <div class="appointment-details">
                <div class="detail-row">
                    <span class="detail-label">📅 New Date:</span>
                    <span class="detail-value">{{ $new_date }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🕐 New Time:</span>
                    <span class="detail-value">{{ $new_time }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">👤 Patient:</span>
                    <span class="detail-value">{{ $appointee_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🦷 Services:</span>
                    <span class="detail-value">{{ $services }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">👨‍⚕️ Dentist:</span>
                    <span class="detail-value">Dr. {{ $dentist_name }}</span>
                </div>
                @if($dentist_contact)
                <div class="detail-row">
                    <span class="detail-label">📞 Dentist Contact:</span>
                    <span class="detail-value" style="color: #c59203; font-weight: bold;">{{ $dentist_contact }}</span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">📋 Status:</span>
                    <span class="detail-value" style="color: #daa400; font-weight: bold;">{{ $status }}</span>
                </div>
            </div>

            <div class="info-box">
                <strong>📋 Important Reminders:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>Please arrive <strong>15 minutes early</strong> for your rescheduled appointment</li>
                    <li>Mark your calendar with the new date and time: <strong>{{ $new_date }} at {{ $new_time }}</strong></li>
                    <li>Bring a valid ID and insurance card (if applicable)</li>
                    <li>If this new time doesn't work for you, please contact us immediately to reschedule</li>
                </ul>
            </div>

            <div class="message">
                <p>We apologize for any inconvenience caused by this schedule change. Dr. {{ $dentist_name }} is looking forward to providing you with excellent dental care at your new appointment time.</p>
                
                @if($dentist_contact)
                <p>If you have any questions about the rescheduled appointment, you can contact Dr. {{ $dentist_name }} directly at <strong style="color: #c59203;">{{ $dentist_contact }}</strong>, or reach out to our clinic for further assistance.</p>
                @else
                <p>If you have any questions about the rescheduled appointment or need to make further changes, please don't hesitate to contact our clinic.</p>
                @endif
                
                <p style="color: #c59203; font-weight: 500;">Thank you for your understanding and for choosing LC Happy Care Dental Clinic!</p>
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