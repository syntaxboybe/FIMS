# Farm Information Management System (FIMS)

A comprehensive solution for modern farm management with a terminal-inspired interface using the Catppuccin Frappé color scheme.

## Overview

FIMS is a complete farm management system that helps farmers optimize operations, track resources, and make data-driven decisions. Built with Laravel and designed with a modern terminal aesthetic.

## Features

- **Livestock Management**: Track animal health, breeding, lineage, and productivity
- **Crop Planning**: Schedule plantings, track growth, and manage harvests
- **Financial Tracking**: Monitor income, expenses, and profitability with reports
- **Task Management**: Organize and assign farm tasks, set priorities, and track completion
- **Data Analytics**: Make informed decisions with insights and performance metrics
- **Mobile Access**: Access your farm data anytime, anywhere on any device

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL
- **UI Theme**: Catppuccin Frappé

## Installation

1. Clone the repository
```bash
git clone https://github.com/syntaxboybe/FIMS.git
```

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up the database
```bash
php artisan migrate --seed
```

5. Build assets
```bash
npm run build
```

6. Start the server
```bash
php artisan serve
```

## Deployment on Laravel Cloud

This application is optimized for deployment on Laravel Cloud, which provides:
- Auto-scaling PHP servers
- Database management
- SSL certificates
- Automatic GitHub integration
- Zero-downtime deployments

## License

[MIT License](LICENSE)
