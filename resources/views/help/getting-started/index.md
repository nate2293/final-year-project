# Getting Started

Welcome to the Laravel Blade Starter Kit! This section will help you set up and configure your modern Laravel application template.

## Quick Navigation

- **[Installation](/help?page=getting-started/installation)** - Step-by-step installation guide
- **[Configuration](/help?page=getting-started/configuration)** - Configure your application settings
- **[Troubleshooting](/help?page=getting-started/troubleshooting)** - Common issues and solutions

## What's Included

The Laravel Blade Starter Kit provides a modern foundation for web applications:

### Core Technology Stack
- **Laravel 12** - Latest Laravel framework with modern PHP features
- **UI** - Blade component library
- **Livewire 4.0** - Full-stack reactivity without writing JavaScript
- **AlpineJS** - Minimal framework for interactive behavior
- **Tailwind CSS** - Utility-first CSS framework with dark mode

### Built-in Features
- **Complete Authentication** - Registration, login, password reset with role-based access
- **Help Documentation System** - Automatic markdown page discovery and navigation
- **Development Tools** - Laravel Pail, Pint, and Vite for optimal developer experience
- **SQLite Database** - Pre-configured with seeded users (easily changeable)

### User Roles & Authentication
The starter kit includes three pre-configured user roles:
- **Admin** (`admin@mail.com` / `password`) - Full system access
- **User** (`user@mail.com` / `password`) - Full system access
- **Guest** (`guest@mail.com` / `password`) - Limited access

## Prerequisites

Before you begin, ensure you have:

- **PHP 8.3+** - Latest PHP version for optimal performance
- **Composer** - PHP dependency manager
- **Node.js & npm** - For asset compilation and frontend tooling
- **Web Server** - Apache, Nginx, or Laravel's built-in development server
- **Basic Laravel Knowledge** - Understanding of Laravel's directory structure and concepts

## First Steps

1. **Install the application** following our installation guide
2. **Configure your environment** with the configuration guide
3. **Explore the UI components** using the ui documentation
4. **Create your first Livewire component** to see the reactivity in action

## Development Workflow

The starter kit is optimized for modern Laravel development:

```bash
# Start development
php artisan serve
npm run dev

# View logs in real-time
php artisan pail

# Format code
./vendor/bin/pint
```

Alternatively you can run the development server and vite server using
```bash
# Start Development
composer run dev
```


## Getting Help

If you encounter any issues during setup:

1. Check the [Troubleshooting guide](/help?page=getting-started/troubleshooting)
2. Review the [FAQ](/help?page=faq)
3. Consult the Laravel documentation

Let's get started with the [installation process](/help?page=getting-started/installation)!
