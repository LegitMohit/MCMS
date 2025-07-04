# 🏥 Medical Clinic Management System (MCMS)

A full-featured web application built using **CakePHP 4.x** that manages the day-to-day operations of a medical clinic, including patient and doctor records, appointment scheduling, and secure user authentication.

---

## 📌 Features

### 🧑‍⚕️ Patient Management
- Register new patients
- View and edit patient profiles
- Search patients by name, phone, or email

### 👨‍⚕️ Doctor Management
- Add/edit doctor profiles
- Assign specializations to doctors
- View doctor schedules

### 📅 Appointment Management
- Book appointments between doctors and patients
- View, cancel, or reschedule appointments
- Prevent double booking and enforce future-dated appointments

### 🔐 Authentication & Authorization
- JWT-based API authentication
- Role-based access control (Admin, Doctor, Patient)
- Secure user login and registration

### 🔧 Admin Features
- Manage all users, doctors, and patients
- View system-wide analytics (optional bonus feature)
- Manage appointments and system settings

---

## 🚀 Tech Stack

- **CakePHP 4.x**
- **MySQL** with CakePHP ORM
- **Composer** for dependency management
- **JWT Authentication Plugin**
- **AJAX** for dynamic appointment interactions
- Optional: Email service for notifications

---

## 🌐 Deployment Guide for Railway.app

### Prerequisites
1. A [Railway.app](https://railway.app) account
2. [Git](https://git-scm.com/) installed on your machine
3. [Railway CLI](https://docs.railway.app/develop/cli) (optional but recommended)

### Step 1: Prepare Your Application
1. Ensure your `.gitignore` includes:
   ```
   /config/app_local.php
   /tmp/*
   /logs/*
   /vendor/*
   ```
2. Create a `Procfile` in your project root:
   ```
   web: vendor/bin/heroku-php-apache2 webroot/
   ```
3. Add a `railway.json` file:
   ```json
   {
       "build": {
           "builder": "NIXPACKS"
       },
       "deploy": {
           "startCommand": "vendor/bin/heroku-php-apache2 webroot/",
           "restartPolicyType": "ON_FAILURE",
           "restartPolicyMaxRetries": 10
       }
   }
   ```

### Step 2: Database Configuration
1. In Railway.app dashboard:
   - Create a new project
   - Add a MySQL database service
   - Note down the connection details

2. Update `config/app_local.php`:
   ```php
   'Datasources' => [
       'default' => [
           'host' => getenv('MYSQLHOST'),
           'username' => getenv('MYSQLUSER'),
           'password' => getenv('MYSQLPASSWORD'),
           'database' => getenv('MYSQLDATABASE'),
           'url' => getenv('DATABASE_URL'),
           'port' => getenv('MYSQLPORT'),
           'ssl_ca' => getenv('MYSQL_ATTR_SSL_CA'),
       ],
   ]
   ```

### Step 3: Deploy to Railway
1. **Using Railway CLI**:
   ```bash
   # Login to Railway
   railway login

   # Link your project
   railway link

   # Deploy your application
   railway up
   ```

2. **Using GitHub Integration**:
   - Connect your GitHub repository in Railway dashboard
   - Enable automatic deployments
   - Push your changes to GitHub

### Step 4: Post-Deployment Setup
1. Run database migrations:
   ```bash
   railway run bin/cake migrations migrate
   ```

2. Set environment variables in Railway dashboard:
   - `APP_NAME`: Your application name
   - `DEBUG`: `false` for production
   - `SECURITY_SALT`: Your security salt
   - Database variables are automatically set by Railway

### Step 5: SSL/HTTPS Setup
1. Railway automatically provides SSL certificates
2. Ensure your application forces HTTPS:
   ```php
   // in config/app.php
   'App' => [
       'fullBaseUrl' => 'https://your-app-name.up.railway.app'
   ]
   ```

### Troubleshooting
1. **Database Connection Issues**:
   - Verify environment variables in Railway dashboard
   - Check if the database service is running
   - Ensure proper SSL configuration

2. **Application Errors**:
   - Check Railway logs in dashboard
   - Enable debug mode temporarily
   - Verify file permissions

3. **Common Solutions**:
   - Clear application cache
   - Rebuild application
   - Check Railway status page

### Maintenance
1. **Updating Your Application**:
   ```bash
   # Pull latest changes
   git pull origin main

   # Deploy updates
   railway up
   ```

2. **Database Backups**:
   - Railway automatically handles database backups
   - Manual backup through Railway dashboard
   - Export data using MySQL tools

3. **Monitoring**:
   - Use Railway dashboard metrics
   - Set up notification alerts
   - Monitor application logs

For more detailed information, visit [Railway.app Documentation](https://docs.railway.app/).


