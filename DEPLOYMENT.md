# Render.com Deployment Guide

## Environment Variables Configuration

Copy these environment variables to your Render.com Web Service:

### Application

```
APP_NAME=LC Happy Care Dental Clinic
APP_ENV=production
APP_KEY=base64:rAiBsf01IPaCn9Bvks0y7fgEgg4p4+fSswmRpMs2B/Y=
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
```

### Database (PostgreSQL)

```
DB_CONNECTION=pgsql
DB_HOST=your-render-postgres-host
DB_PORT=5432
DB_DATABASE=dental_clinic
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
```

### Session & Cache

```
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Mail Configuration

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME=LC Happy Care Dental Clinic
MAIL_ENCRYPTION=tls
MAIL_TIMEOUT=60
```

**Important Notes for Gmail:**

-   Use your full Gmail address for MAIL_USERNAME
-   Use a Gmail App Password (not your regular password) for MAIL_PASSWORD
-   Enable 2-factor authentication on your Gmail account first
-   Generate App Password: Google Account → Security → 2-Step Verification → App passwords

### Alternative Mail Services (Recommended for Production):

**Brevo API (Recommended - bypasses SMTP blocks):**

```
BREVO_API_KEY=your-brevo-api-key
MAIL_FROM_ADDRESS=your-verified-email@domain.com
MAIL_FROM_NAME=LC Happy Care Dental Clinic
```

**Steps to get Brevo API key:**

1. Sign up at https://brevo.com
2. Go to Account → SMTP & API → API Keys
3. Click "Generate a new API key"
4. Copy the API key and use it as BREVO_API_KEY

**Brevo SMTP (if API doesn't work):**

```
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-brevo-email@domain.com
MAIL_PASSWORD=your-brevo-smtp-key
MAIL_FROM_ADDRESS=your-verified-email@domain.com
MAIL_FROM_NAME=LC Happy Care Dental Clinic
MAIL_ENCRYPTION=tls
```

**SendGrid:**

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

**Mailtrap (Testing only):**

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

### SMS API

```
IPROG_SMS_API_TOKEN=your-real-sms-api-token
```

### Logging

```
LOG_CHANNEL=stderr
LOG_LEVEL=error
LOG_STDERR_FORMATTER=Monolog\Formatter\JsonFormatter
```

## Deployment Steps

1. Create PostgreSQL database in Render
2. Create Web Service connected to GitHub repo
3. Set Build Command: `./render-build.sh`
4. Set Start Command: `php artisan serve --host=0.0.0.0 --port=$PORT`
5. Add all environment variables above
6. Deploy!

## Important Notes

-   Replace `your-app-name.onrender.com` with your actual Render app URL
-   Replace database credentials with your actual Render PostgreSQL details
-   Use Gmail App Password for MAIL_PASSWORD (not your regular password)
-   Add your real SMS API token for IPROG_SMS_API_TOKEN
