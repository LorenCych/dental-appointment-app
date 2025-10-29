<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status Update - LC Happy Care Dental Clinic</title>
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
        .warning-box {
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
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Appointment Status Update</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello, {{ $user_name }},
            </div>

            <div class="appointment-card">
                <h3>⏰ Appointment Expired</h3>
                <p style="margin: 0; font-size: 18px;">Your appointment time has passed</p>
            </div>

            <div class="message">
                <p>We want to inform you that your dental appointment scheduled with Dr. {{ $dentist_name }} has been marked as expired because the appointment time has passed.</p>
                
                <p>This may have occurred due to various reasons such as a missed appointment or scheduling conflicts.</p>
            </div>

            <div class="appointment-details">
                <div class="detail-row">
                    <span class="detail-label">📅 Date:</span>
                    <span class="detail-value">{{ $appointment_date }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🕐 Time:</span>
                    <span class="detail-value">{{ $appointment_time }}</span>
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
                    <span class="detail-value" style="color: #dc3545; font-weight: bold;">{{ $status }}</span>
                </div>
            </div>

            <div class="warning-box">
                <strong>⚠️ What this means:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>Your appointment slot has been released</li>
                    <li>No dental services were provided</li>
                    <li>You will need to book a new appointment if you still need dental care</li>
                    <li>Please note our cancellation and no-show policy</li>
                </ul>
            </div>

            <div class="action-box">
                <strong>📋 Next Steps - We're Here to Help:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li><strong>Book a New Appointment:</strong> Contact us to schedule your next visit</li>
                    <li><strong>Online Booking:</strong> Use our patient portal to find available times</li>
                    <li><strong>Emergency Care:</strong> Contact us immediately if you have urgent dental needs</li>
                    <li><strong>Questions?</strong> Our team is available to assist you with rescheduling</li>
                </ul>
            </div>

            <div class="message">
                <p>We understand that schedules can change unexpectedly. Our priority is still providing you with excellent dental care when you're ready.</p>
                
                <p>Please don't hesitate to contact our clinic to schedule a new appointment. We're here to accommodate your dental health needs.</p>
                
                <p style="color: #c59203; font-weight: 500;">Thank you for choosing LC Happy Care Dental Clinic - we look forward to serving you soon!</p>
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