# Troubleshooting

Having issues with your Laravel Blade Starter Kit? This guide covers common problems and their solutions.

## Common Installation Issues

### Composer Install Fails

**Problem**: `composer install` fails with dependency errors.

**Solution**:
1. Make sure you're using PHP 8.1 or higher: `php --version`
2. Update Composer: `composer self-update`
3. Clear Composer cache: `composer clear-cache`
4. Try installing again: `composer install`

### NPM Install Issues

**Problem**: `npm install` fails or takes too long.

**Solution**:
1. Clear npm cache: `npm cache clean --force`
2. Delete node_modules: `rm -rf node_modules`
3. Delete package-lock.json: `rm package-lock.json`
4. Reinstall: `npm install`

### Database Migration Errors

**Problem**: `php artisan migrate` fails.

**Solution**:
1. Check database connection in `.env`
2. Make sure database exists
3. Check database permissions
4. For SQLite, ensure the file path is correct and writable

## Common Runtime Issues

### Page Not Found (404)

**Problem**: Getting 404 errors for valid routes.

**Solution**:
1. Check if the web server is configured correctly
2. Ensure `.htaccess` file exists (for Apache)
3. Check route definitions in `routes/web.php`
4. Clear route cache: `php artisan route:clear`

### Styles Not Loading

**Problem**: CSS/JS assets not loading properly.

**Solution**:
1. Run asset compilation: `npm run dev`
2. For production: `npm run build`
3. Check if Vite is running for development
4. Clear browser cache

### Permission Denied Errors

**Problem**: Laravel showing permission errors.

**Solution**:
1. Set correct permissions:
   ```bash
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   ```
2. Set ownership (if on Linux/Mac):
   ```bash
   chown -R www-data:www-data storage
   chown -R www-data:www-data bootstrap/cache
   ```

## Environment Issues

### APP_KEY Missing

**Problem**: "No application encryption key has been specified."

**Solution**:
1. Generate application key: `php artisan key:generate`
2. Check that `APP_KEY` is set in `.env`

### Debug Mode Issues

**Problem**: Not seeing detailed error messages.

**Solution**:
1. Set `APP_DEBUG=true` in `.env`
2. Set `APP_ENV=local` for development
3. Clear config cache: `php artisan config:clear`

## Help System Issues

### Help Pages Not Loading

**Problem**: Help pages showing 404 or not found.

**Solution**:
1. Check that markdown files exist in `resources/views/help/`
2. Verify file permissions are readable
3. Check the help route is registered in `routes/web.php`

### Breadcrumbs Not Working

**Problem**: Breadcrumb links not working for subdirectories.

**Solution**:
1. Ensure index files exist for directories (e.g., `getting-started/index.md`)
2. Check file paths in breadcrumb logic
3. Verify route parameters are being passed correctly

## Getting More Help

If these solutions don't resolve your issue:

1. Check the [Laravel documentation](https://laravel.com/docs)
2. Review the [FAQ]({{ route('help', ['page' => 'faq']) }})
3. Enable debug mode and check the logs in `storage/logs/laravel.log`
4. Search for similar issues on GitHub or Stack Overflow

## Reporting Issues

When reporting issues, please include:

- PHP version
- Laravel version
- Error messages (full stack trace)
- Steps to reproduce
- Environment details (OS, web server, etc.)
