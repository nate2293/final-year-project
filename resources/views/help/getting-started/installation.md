# Installation

This guide will walk you through installing and setting up the Laravel Blade Starter Kit.

## Prerequisites

Ensure you have the following installed:

- **PHP 8.3+** - Required for Laravel 12 and modern features
- **Composer** - PHP dependency manager
- **Node.js 18+** - For asset compilation and frontend tooling
- **npm or yarn** - Package manager for JavaScript dependencies
- **Git** - Version control system
- **Web Server** - Apache, Nginx, or use Laravel's built-in development server

## Installation Steps

### 1. Clone or Download the Project

```bash
# If using Git
git clone <your-repository-url> my-project
cd my-project

# Or download and extract the project files
```

### 2. Install PHP Dependencies

```bash
composer install
```

This installs all Laravel dependencies including:
- Laravel 12 framework
- Livewire 4.0 
- Development tools (Pint, Pail)

### 3. Install JavaScript Dependencies

```bash
npm install
```

This installs frontend dependencies:
- Vite for asset building
- Tailwind CSS
- AlpineJS
- PostCSS plugins

### 4. Environment Configuration

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup

The starter kit uses SQLite by default for simplicity:

```bash
# Create and seed the database
php artisan migrate --seed
```

This creates:
- User authentication tables
- Cache and job tables  
- Two demo users (admin@mail.com and guest@mail.com)

### 6. Build Assets

```bash
# For development (with hot reload)
npm run dev

# For production
npm run build
```

### 7. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Post-Installation

### Default Login Credentials

- **Admin Role**: `admin@mail.com` / `password`
- **User Role**: `user@mail.com` / `password`
- **Guest Role**: `guest@mail.com` / `password`

### Verify Installation

1. Visit `http://localhost:8000`
2. Click "Login" and use the admin credentials
3. Navigate to `/help` to see the documentation system
4. Check that Tailwind CSS styling is working
5. Test Livewire functionality by interacting with components

### Development Tools

To run the server in devleopment mode run the following command. This runs the laravel server alongside the vite server.

```bash
# Laravel development server
composer run dev
```

## Alternative Database Setup

To use MySQL or PostgreSQL instead of SQLite:

1. Update your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

2. Create the database and run migrations:
```bash
php artisan migrate --seed
```

## Troubleshooting

### Common Issues

**Permission errors**: Ensure `storage/` and `bootstrap/cache/` are writable
```bash
chmod -R 775 storage bootstrap/cache
```

**Asset compilation fails**: Clear npm cache and reinstall
```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

**Database connection errors**: Verify database credentials in `.env`

**Styling not working**: Ensure assets are compiled
```bash
npm run dev
```

## Next Steps

- Read the [Configuration Guide]({{ route('help', ['page' => 'getting-started/configuration']) }})
- Explore the [FAQ]({{ route('help', ['page' => 'faq']) }}) for common questions
- Check out the main [Help Documentation]({{ route('help') }})

Your Laravel Blade Starter Kit is now ready for development!

Your application should now be running at `http://localhost:8000`.
