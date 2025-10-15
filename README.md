# Personal File Transfer

A minimalist local network file transfer application built with Laravel. Transfer files securely between devices on your local network without requiring internet connection.

## Features

- Upload and download files within your local network
- Completely offline - no internet required
- Fast transfers over LAN
- Clean, minimalist web interface with no external dependencies
- Mobile-friendly responsive design
- Drag and drop file upload
- Automatic local IP detection and display
- Real-time file management (upload, download, delete)

## Requirements

- PHP >= 8.1
- Composer
- Apache/Nginx web server
- Local network connection

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/alfahrelrifananda/Personal-File-Transfer.git
   cd Personal-File-Transfer
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Create storage link**
   ```bash
   php artisan storage:link
   ```

5. **Set permissions**
   ```bash
   sudo chown -R $USER:www-data storage bootstrap/cache
   chmod -R 777 storage bootstrap/cache
   chmod -R g+s storage bootstrap/cache
   ```

6. **Configure your web server** (Apache/Nginx) to point to the `public` directory

## Usage

### Access from Local Network

1. **Find your local IP address:**
   ```bash
   # Linux (recommended command)
   ip route get 1.1.1.1 | awk '{print $7}'
   
   # Alternative Linux commands
   hostname -I
   ip addr show
   
   # Mac
   ifconfig
   
   # Windows
   ipconfig
   ```

2. **Access the application:**
   - From host machine: `http://localhost` or `http://127.0.0.1`
   - From other devices: `http://YOUR_LOCAL_IP` (e.g., `http://192.168.1.100`)

   The application automatically displays your local IP address at the top of the page for easy access from mobile devices.

### Transferring Files

1. Open the application in your browser
2. Click or drag files to the upload area (supports up to 33MB by default)
3. Files appear instantly in the file list with colored extension badges
4. Download or delete files from any device on the same network
5. All devices on the same WiFi can access the same files

## Configuration

### Upload Limits

To increase the file size limit, edit your `php.ini` file:

**For Apache on Void Linux:**
```bash
sudo vim /etc/php/php.ini
```

Add or modify these values:
```ini
upload_max_filesize = 33M
post_max_size = 33M
memory_limit = 256M
max_execution_time = 300
```

**Also update `.htaccess` in the `public` folder:**
```apache
php_value upload_max_filesize 33M
php_value post_max_size 33M
php_value memory_limit 256M
php_value max_execution_time 300
```

**Don't forget to update the validation in `FileController.php`:**
```php
$request->validate([
    'file' => 'required|file|max:33792', // 33MB in kilobytes
]);
```

**Restart Apache:**
```bash
sudo sv restart apache
```

### Storage Path

Files are stored in `storage/app/public/uploads/` by default. The public disk is used for easy access and download functionality.

## Security Notes

**Important:** This application is designed for LOCAL NETWORK USE ONLY.

- ⚠️ Do not expose this application to the public internet
- Only accessible within your local network (192.168.x.x, 10.x.x.x, 172.x.x.x)
- No authentication by default - add authentication for shared/public networks
- Consider firewall rules for additional security
- The application is completely self-contained with no external dependencies, ensuring offline operation

## Troubleshooting

### Permission Denied Errors
```bash
sudo chown -R $USER:www-data storage bootstrap/cache
chmod -R 777 storage bootstrap/cache
chmod -R g+s storage bootstrap/cache
```

### Cannot Access from Other Devices

- Verify all devices are connected to the same WiFi network
- Check that your firewall allows connections on port 80/443
- For Apache, ensure it's listening on `0.0.0.0` not just `127.0.0.1`
- Test connectivity with `ping YOUR_LOCAL_IP` from the other device

### File Upload Fails with "File too large" Error

- Check and increase PHP upload limits in `php.ini`
- Update `.htaccess` file limits
- Verify storage directory has write permissions
- Check available disk space with `df -h`
- Restart web server after configuration changes

### IP Address Not Showing

The application uses `ip route get 1.1.1.1 | awk '{print $7}'` to detect your local IP. This command:
- Does NOT require internet connection
- Works completely offline
- Queries your local routing table only

If the IP doesn't show, verify the command works in your terminal first.

## Development

### Using Laravel Development Server

```bash
# Run Laravel development server (accessible from network)
php artisan serve --host=0.0.0.0 --port=8000

# Access from any device on the same network
http://YOUR_LOCAL_IP:8000
```

### Using with Custom php.ini

```bash
# Create php.ini with custom settings
php -c php.ini artisan serve --host=0.0.0.0 --port=8000
```

## Technical Details

- **Framework:** Laravel 11.x
- **UI:** Minimalist design with no external CSS/JS dependencies
- **File Icons:** Color-coded extension badges (PDF, DOC, XLS, etc.)
- **Storage:** Laravel public disk with symbolic link
- **Upload Method:** Multipart form data with drag-and-drop support
- **Network Detection:** Shell command for reliable local IP detection

## Design Philosophy

This application follows a minimalist approach:
- Zero external dependencies (no Bootstrap, no icon fonts)
- All CSS and JavaScript inline
- Works 100% offline on local network
- Clean, professional interface
- Fast and lightweight
- Mobile-first responsive design

## License

Open source - feel free to modify and use for personal purposes.

## Contributing

This is a personal project, but suggestions and improvements are welcome! Feel free to open issues or submit pull requests.

---

**⚠️ Security Warning:** Keep this application on your local network only. Never expose it to the public internet without implementing proper authentication, encryption, and security measures.
