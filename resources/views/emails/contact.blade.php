<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 5px; }
        .header { background: #f8f9fa; padding: 10px 20px; border-bottom: 1px solid #ddd; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; margin-top: 20px; text-align: center; }
        .label { font-weight: bold; width: 100px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>New Contact Message</h3>
        </div>
        <div class="content">
            <p>You have received a new message from the DigiOH Contact Form.</p>
            
            <div style="margin-bottom: 10px;">
                <span class="label">Name:</span> {{ $data['name'] }}
            </div>
            <div style="margin-bottom: 10px;">
                <span class="label">Email:</span> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
            </div>
            <div style="margin-bottom: 10px;">
                <span class="label">Subject:</span> {{ $data['subject'] ?? 'General Inquiry' }}
            </div>
            
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            
            <div style="margin-bottom: 10px;">
                <strong>Message:</strong><br>
                <div style="background: #f9f9f9; padding: 15px; border-radius: 4px; margin-top: 5px;">
                    {!! nl2br(e($data['message'])) !!}
                </div>
            </div>
        </div>
        <div class="footer">
            This email was sent from the Contact Form on {{ config('app.name') }}.
        </div>
    </div>
</body>
</html>
