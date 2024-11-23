# Project Setup Guide

## Prerequisites

### System Requirements
- PHP 5.6 or newer (recommended PHP 7.2+)
- Apache Web Server (2.4+) with mod_rewrite enabled

### Recommended Development Environment
- XAMPP
- MAMP
- WAMP
- Local development server

## Installation Steps

### 1. Clone the Repository
```bash
git clone https://github.com/novlihalsi/test-with-ci.git
cd test-with-ci
```

### 2. Configure Environment
Edit `application/config/config.php` files with your specific configuration:
   - Update base URL (if needed)

### 3. Running the Project

#### Using Apache/XAMPP
1. Place project in `htdocs` directory
2. Configure virtual host (optional)
3. Access via `http://localhost/test-with-ci`

#### Routing
Custom routes can be defined in `application/config/routes.php`

## Common Troubleshooting

### 1. 404 Errors
- Ensure `mod_rewrite` is enabled
- Check `.htaccess` configuration
- Verify `base_url` in `config.php`

### 2. Permissions
- Ensure `application/cache` and `application/logs` are writable

## Additional Resources
- [CodeIgniter 3 User Guide](https://codeigniter.com/userguide3/)
- [CodeIgniter Community Forums](https://forum.codeigniter.com/)
