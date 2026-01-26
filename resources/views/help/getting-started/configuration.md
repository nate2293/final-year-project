# Configuration

Learn how to configure your Laravel Blade Starter Kit.

## Environment Variables

The application uses several environment variables that you can customize in your `.env` file:

### Database Configuration

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### Application Settings

```env
APP_NAME="My Application"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
```

### Mail Configuration

```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

## Layout Configuration

You can switch between different layouts by editing `resources/views/components/layouts/app.blade.php`.

Available layouts:
- **Sidebar Layout** (default)
- **Navbar Layout**

## UI Theme

The application supports both light and dark themes automatically based on user preference.

## Authentication

Default users created by the seeder:
- Admin: `admin@mail.com` / `password`
- User: `user@mail.com` / `password`
- Guest: `guest@mail.com` / `password`
