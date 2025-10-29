<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        
        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
            background: #fff;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1b513;
        }
        
        .clinic-name {
            font-size: 22px;
            font-weight: bold;
            color: #c59203;
            text-align: center;
            margin-bottom: 8px;
        }
        
        .clinic-info {
            color: #666;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .receipt-title {
            background: linear-gradient(135deg, #f1b513 0%, #daa400 100%);
            color: rgb(88, 51, 0);
            text-align: center;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        
        .receipt-info div {
            flex: 1;
            margin-right: 15px;
        }
        
        .receipt-info div:last-child {
            margin-right: 0;
        }
        
        .receipt-info h4 {
            color: #c59203;
            margin-bottom: 5px;
            font-size: 12px;
        }
        
        .receipt-info p {
            margin-bottom: 2px;
            font-size: 11px;
        }
        
        .appointment-details {
            background: #fff;
            border: 2px solid #f1b513;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 15px;
        }
        
        .appointment-header {
            background: #f1b513;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .appointment-body {
            padding: 15px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .detail-label {
            font-weight: bold;
            color: #c59203;
            width: 150px;
            flex-shrink: 0;
            font-size: 12px;
        }
        
        .detail-value {
            flex: 1;
            color: #333;
            font-size: 12px;
        }
        
        .services-list {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-top: 5px;
        }
        
        .services-list h4 {
            color: #c59203;
            margin-bottom: 6px;
            font-size: 12px;
        }
        
        .service-item {
            padding: 4px 0;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }
        
        .service-item:last-child {
            border-bottom: none;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-completed {
            background: #28a745;
            color: white;
        }
        
        .status-assigned {
            background: #f1b513;
            color: white;
        }
        
        .status-pending {
            background: transparent;
            color: #f1b513;
            border: 2px solid #f1b513;
        }
        
        .status-withdrawn {
            background: #dc3545;
            color: white;
        }
        
        .status-expired {
            background: #6c757d;
            color: white;
        }
        
        .status-rescheduled {
            background: #17a2b8;
            color: white;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            padding-top: 12px;
            border-top: 2px solid #f1b513;
        }
        
        .footer-message {
            color: #666;
            font-size: 10px;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        
        .contact-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        
        .contact-info h4 {
            color: #c59203;
            margin-bottom: 6px;
            font-size: 12px;
        }
        
        .contact-details {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            font-size: 10px;
            color: #666;
        }
        
        .contact-item strong {
            color: #333;
        }
        
        .print-date {
            text-align: right;
            font-size: 9px;
            color: #999;
            margin-top: 10px;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .receipt-container {
                padding: 0;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <div class="clinic-name">LC HAPPY CARE DENTAL CLINIC</div>
            <div class="clinic-info">
                Sampaguita St., Bagumbayan, Roxas, Oriental Mindoro, Philippines<br>
                Monday to Sunday: 8:00 AM - 5:00 PM<br>
                Bringing Life to Your Smile
            </div>
        </div>
        
        <!-- Receipt Title -->
        <div class="receipt-title">
            APPOINTMENT RECEIPT
        </div>
        
        <!-- Receipt Information -->
        <div class="receipt-info">
            <div>
                <h4>PATIENT INFORMATION</h4>
                <p><strong>{{ $appointment->user->fullname() }}</strong></p>
                <p>{{ $appointment->user->email }}</p>
                @if($appointment->user->phone)
                <p>{{ $appointment->user->phone }}</p>
                @endif
            </div>
            <div>
                <h4>RECEIPT NO.</h4>
                <p><strong>{{ sprintf('RCP-%06d', $appointment->id) }}</strong></p>
                <p>{{ now()->format('M d, Y g:i A') }}</p>
            </div>
            <div>
                <h4>STATUS</h4>
                <p>
                    @if(strtolower($appointment->status) === 'completed')
                        <span class="status-badge status-completed">{{ ucfirst($appointment->status) }}</span>
                    @elseif(strtolower($appointment->status) === 'assigned')
                        <span class="status-badge status-assigned">{{ ucfirst($appointment->status) }}</span>
                    @elseif(strtolower($appointment->status) === 'pending')
                        <span class="status-badge status-pending">{{ ucfirst($appointment->status) }}</span>
                    @elseif(strtolower($appointment->status) === 'withdrawn')
                        <span class="status-badge status-withdrawn">{{ ucfirst($appointment->status) }}</span>
                    @elseif(strtolower($appointment->status) === 'expired')
                        <span class="status-badge status-expired">{{ ucfirst($appointment->status) }}</span>
                    @elseif(strtolower($appointment->status) === 'rescheduled')
                        <span class="status-badge status-rescheduled">{{ ucfirst($appointment->status) }}</span>
                    @else
                        <span class="status-badge status-pending">{{ ucfirst($appointment->status ?? 'Unknown') }}</span>
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Appointment Details -->
        <div class="appointment-details">
            <div class="appointment-header">
                APPOINTMENT DETAILS
            </div>
            <div class="appointment-body">
                <div class="detail-row">
                    <div class="detail-label">Date & Time:</div>
                    <div class="detail-value">
                        <strong>{{ \Carbon\Carbon::parse($appointment->appointment_sched)->format('M j, Y \a\t g:i A') }}</strong>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Dental Specialist:</div>
                    <div class="detail-value">
                        <strong>{{ $appointment->dentist ? $appointment->dentist->fullname() : 'To be assigned' }}</strong>
                        @if($appointment->dentist && $appointment->dentist->contact_number)
                            <br><small style="font-size: 10px;">Contact: {{ $appointment->dentist->contact_number }}</small>
                        @endif
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Requested Services:</div>
                    <div class="detail-value">
                        @if($appointment->services && $appointment->services->count())
                            <div class="services-list">
                                <h4>Treatment/Services:</h4>
                                <div class="service-item">
                                    <strong>
                                        @foreach($appointment->services as $index => $service)
                                            {{ $service->service_name }}@if($index < count($appointment->services) - 1), @endif
                                        @endforeach
                                        @if($appointment->other_services)
                                            @if($appointment->services->count() > 0), @endif{{ $appointment->other_services }}
                                        @endif
                                    </strong>
                                    @if($appointment->services->where('description', '!=', null)->count() > 0)
                                        <br><small>
                                            @foreach($appointment->services as $index => $service)
                                                @if($service->description)
                                                    {{ $service->service_name }}: {{ $service->description }}@if($index < count($appointment->services) - 1); @endif
                                                @endif
                                            @endforeach
                                        </small>
                                    @endif
                                </div>
                            </div>
                        @else
                            <em>No specific services selected</em>
                        @endif
                    </div>
                </div>
                
                @if($appointment->chief_complaint)
                <div class="detail-row">
                    <div class="detail-label">Chief Complaint:</div>
                    <div class="detail-value">{{ $appointment->chief_complaint }}</div>
                </div>
                @endif
                
                @if($appointment->medical_history)
                <div class="detail-row">
                    <div class="detail-label">Medical History:</div>    
                    <div class="detail-value">{{ $appointment->medical_history }}</div>
                </div>
                @endif
                
                <div class="detail-row">
                    <div class="detail-label">Created:</div>
                    <div class="detail-value">
                        {{ $appointment->created_at->format('M j, Y g:i A') }}
                        @if($appointment->updated_at != $appointment->created_at)
                            <br><small style="font-size: 10px;">Updated: {{ $appointment->updated_at->format('M j, Y g:i A') }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-message">
                Thank you for choosing LC Happy Care Dental Clinic for your oral health needs.<br>
                We are committed to providing you with the highest quality dental care.
            </div>
            
            <div class="contact-info">
                <h4>CLINIC CONTACT INFORMATION</h4>
                <div class="contact-details">
                    <div class="contact-item">
                        <strong>Email:</strong> leddieczarinaapara@gmail.com
                    </div>
                    <div class="contact-item">
                        <strong>Phone:</strong> 09451996006 or 09292297847
                    </div>
                </div>
            </div>
            
            <div class="print-date">
                This receipt was generated on {{ now()->format('F j, Y \a\t g:i A') }}
            </div>
        </div>
    </div>
</body>
</html>