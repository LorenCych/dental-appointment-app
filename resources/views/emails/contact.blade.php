<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #ffc249;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field label {
            font-weight: bold;
            color: #555;
        }
        .field p {
            margin: 5px 0;
            padding: 10px;
            background-color: white;
            border-left: 4px solid #ffc249;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LC Happy Care Dental Clinic</h1>
        <h2>New Contact Form Submission</h2>
    </div>
    
    <div class="content">
        <div class="field">
            <label>From:</label>
            <p><strong>{{ $contactName ?? 'Unknown' }}</strong> ({{ $contactEmail ?? 'Unknown' }})</p>
        </div>
        
        <div class="field">
            <label>Message:</label>
            <p>{{ $contactMessage ?? 'No message provided' }}</p>
        </div>

    </div>
    
    <div class="footer">
        <p>This message was sent from the LC Happy Care Dental Clinic website contact form.</p>
        <p>Reply directly to this email to respond to the sender.</p>
    </div>
</body>
</html>