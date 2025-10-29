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
