# Personal File Transfer

A simple local network file transfer application built with Laravel. Transfer files securely between devices on your local network using IP addresses.

## Features

- Upload and download files within your local network
- Local network only - no internet required
- Fast transfers over LAN
- Web-based interface accessible from any device
- Mobile-friendly design

## Requirements

- PHP >= 8.1
- Composer
- Apache/Nginx web server
- Local network connection

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/alfahrelrifananda/Personal-File-Transfer.git
   cd laravel-test
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

4. **Set permissions**
   ```bash
   sudo chown -R $USER:www-data storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   chmod -R g+s storage bootstrap/cache
   ```

5. **Configure your web server** (Apache/Nginx) to point to the `public` directory

## Usage

### Access from Local Network

1. **Find your local IP address:**
   ```bash
   # Linux/Mac
   ip addr show
   # or
   ifconfig
   
   # Windows
   ipconfig
   ```

2. **Access the application:**
   - From host machine: `http://localhost` or `http://127.0.0.1`
   - From other devices: `http://YOUR_LOCAL_IP` (e.g., `http://192.168.1.100`)

### Transferring Files

1. Open the application in your browser
2. Upload files from any device on your network
3. Share the download link with other devices on the same network
4. Files remain accessible until deleted

## Configuration

### Upload Limits

Edit `php.ini` to increase upload size limits:

```ini
upload_max_filesize = 100M
post_max_size = 100M
max_execution_time = 300
```

### Storage Path

Files are stored in `storage/app/` by default. You can modify the storage path in the application configuration.

## Security Notes

**Important:** This application is designed for LOCAL NETWORK USE ONLY.

- Do not expose this application to the public internet
- Only accessible within your local network (192.168.x.x, 10.x.x.x)
- Consider setting up firewall rules if needed
- No authentication by default - add authentication for shared networks

## Troubleshooting

### Permission Denied Errors

```bash
sudo chown -R $USER:www-data /srv/www/apache/laravel-test
chmod -R 775 storage bootstrap/cache
```

### Cannot Access from Other Devices

- Verify devices are on the same network
- Check firewall settings
- Ensure Apache/Nginx is listening on `0.0.0.0` not just `127.0.0.1`

### Upload Fails

- Check PHP upload limits in `php.ini`
- Verify storage directory permissions
- Check available disk space

## Development

```bash
# Run Laravel development server
php artisan serve --host=0.0.0.0 --port=8000

# Access from network
http://YOUR_LOCAL_IP:8000
```

## License

Open source - feel free to modify and use for personal purposes.

## Contributing

This is a personal project, but suggestions and improvements are welcome!

---

**Note:** Keep this application private and local. Never expose it to the public internet without proper security measures.
