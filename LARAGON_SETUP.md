# Laragon Virtual Host Setup Guide

## Quick Setup Steps

### Step 1: Stop Laravel Development Server
- Press `Ctrl+C` in the terminal where `php artisan serve` is running

### Step 2: Configure Virtual Host in Laragon

**Option A: Using Laragon GUI (Recommended)**
1. Right-click the **Laragon icon** in the system tray (bottom-right)
2. Go to **Apache** → **Virtual Hosts** → **Add Virtual Host**
3. Enter the following:
   - **Domain**: `chalanbeel.test`
   - **Document Root**: `E:\Projects\chalanbeel.com\public`
4. Click **OK**

**Option B: Manual Configuration**
1. Navigate to: `C:\laragon\etc\apache2\sites-enabled\`
2. Create a new file: `chalanbeel.test.conf`
3. Copy the configuration from `vhost-config.conf` (created in this directory)
4. Save the file

### Step 3: Update Windows Hosts File
1. Open Notepad as **Administrator** (Right-click → Run as administrator)
2. Open file: `C:\Windows\System32\drivers\etc\hosts`
3. Add this line at the end:
   ```
   127.0.0.1    chalanbeel.test
   127.0.0.1    www.chalanbeel.test
   ```
4. Save the file

### Step 4: Restart Laragon Services
1. In Laragon, click **Stop All**
2. Then click **Start All**
3. Wait for Apache and MySQL to start

### Step 5: Access Your Application
- Open browser and go to: **http://chalanbeel.test**
- The search form should now work at: **http://chalanbeel.test/check**

## Troubleshooting

### If you get "403 Forbidden" error:
- Check that the Document Root points to the `public` folder
- Verify file permissions in Laragon

### If you get "Site can't be reached":
- Make sure Apache is running in Laragon
- Check that the hosts file entry is correct
- Try clearing browser cache

### If routes don't work:
- Make sure `.htaccess` file exists in the `public` folder (it should)
- Check Apache `mod_rewrite` is enabled (Laragon enables it by default)

## Alternative Domain Names
You can use any of these instead of `chalanbeel.test`:
- `chalanbeel.local`
- `chalanbeel.dev`
- `localhost.chalanbeel`

Just make sure to:
1. Use the same name in Laragon virtual host
2. Add the same name to Windows hosts file

