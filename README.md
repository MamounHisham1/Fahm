# Fahm - Educational Management Platform

[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-v3-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Filament](https://img.shields.io/badge/Filament-v3.3-FFAA00?style=for-the-badge&logo=filament&logoColor=white)](https://filamentphp.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)

A modern, multi-tenant educational management platform that connects educators with students through interactive learning experiences. Built with Laravel, Livewire, and Filament for powerful admin capabilities.

## ✨ Features

### 🎓 **Core Educational Features**
- **Multi-tenant Architecture** - Separate instances for different educational institutions
- **Subject & Lesson Management** - Organize content by subjects with structured lessons
- **Assignment System** - Create, distribute, and grade assignments
- **Video Lessons** - Upload and stream educational videos with Cloudinary integration
- **Progress Tracking** - Monitor student progress and lesson completion
- **Interactive Comments** - Enable discussions on lessons and assignments

### 👥 **User Management**
- **Role-based Access Control** - Students, Teachers, and Admins with appropriate permissions
- **Client-based Isolation** - Each educational institution operates independently
- **Profile Management** - Comprehensive user profiles with customization options
- **Authentication System** - Secure login/registration with email verification

### 🛠 **Administrative Features**
- **Filament Admin Panel** - Modern, intuitive admin interface
- **Grade & Classroom Management** - Organize students into grades and classrooms
- **Resource Management** - Full CRUD operations for all educational entities
- **Dual Admin System** - Separate panels for super admins and client admins

### 🎨 **User Experience**
- **Responsive Design** - Mobile-first approach with TailwindCSS
- **Dark Mode Support** - Toggle between light and dark themes
- **Real-time Interactions** - Powered by Livewire for seamless user experience
- **Video Player Integration** - Custom video player for educational content

## 🚀 Tech Stack

- **Backend**: Laravel 12.0 with PHP 8.2+
- **Frontend**: Livewire 3.0 + TailwindCSS 4.0
- **Admin Panel**: Filament 3.3
- **Database**: MySQL/PostgreSQL compatible
- **File Storage**: Cloudinary for video and media management
- **Build Tools**: Vite for asset compilation
- **Testing**: PHPUnit with comprehensive test suite

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL or PostgreSQL database
- Cloudinary account (for video uploads)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/fahm.git
   cd fahm
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   ```env
   APP_NAME=Fahm
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fahm
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   
   # Cloudinary Configuration
   CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name
   ```

6. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔧 Development

### Running in Development Mode
```bash
# Start all development services concurrently
composer run dev

# This runs:
# - Laravel development server
# - Queue worker
# - Log monitoring (Pail)
# - Vite development server
```

### Available Commands
```bash
# Code formatting
./vendor/bin/pint

# Run tests
php artisan test

# Clear application cache
php artisan optimize:clear

# Generate IDE helper files
php artisan ide-helper:generate
```

## 🏗 Architecture

### Models & Relationships
- **Client**: Multi-tenant entity representing educational institutions
- **User**: Students, Teachers, and Admins with role-based access
- **Subject**: Academic subjects within each client
- **Lesson**: Individual lessons with video content and materials
- **Assignment**: Tasks assigned to students with due dates
- **Grade**: Academic grade levels
- **Classroom**: Physical or virtual classrooms

### Key Design Patterns
- **Multi-tenancy**: Client-based data isolation
- **Policy-based Authorization**: Comprehensive permission system
- **Trait Composition**: Reusable functionality across models
- **Livewire Components**: Interactive frontend components
- **Filament Resources**: Admin panel CRUD operations

## 📚 API Documentation

The application provides a web-based interface with the following key routes:

### Public Routes
- `/` - Landing page
- `/pricing` - Pricing information
- `/features` - Feature overview
- `/about` - About page
- `/contact` - Contact information

### Client Interface (Multi-tenant)
- `/{client}.domain.com/` - Client dashboard
- `/{client}.domain.com/assignments` - Assignment management
- `/{client}.domain.com/lectures` - Video lessons
- `/{client}.domain.com/subjects` - Subject overview

### Admin Panels
- `/admin` - Super admin panel (Filament)
- `/{client}.domain.com/admin` - Client admin panel

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run with coverage
php artisan test --coverage
```

## 📝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style
- Follow PSR-12 coding standards
- Use Laravel Pint for code formatting
- Write descriptive commit messages
- Add tests for new features

## 🔒 Security

- All user inputs are validated and sanitized
- CSRF protection enabled for all forms
- Role-based access control implemented
- SQL injection prevention through Eloquent ORM
- XSS protection with proper output escaping

For security vulnerabilities, please email [security@fahm.com](mailto:security@fahm.com).

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework for web artisans
- [Livewire](https://livewire.laravel.com) - Full-stack framework for Laravel
- [Filament](https://filamentphp.com) - Admin panel and form builder
- [TailwindCSS](https://tailwindcss.com) - Utility-first CSS framework
- [Cloudinary](https://cloudinary.com) - Cloud-based media management

## 📞 Support

- Documentation: [docs.fahm.com](https://docs.fahm.com)
- Issues: [GitHub Issues](https://github.com/your-username/fahm/issues)
- Discussions: [GitHub Discussions](https://github.com/your-username/fahm/discussions)
- Email: [support@fahm.com](mailto:support@fahm.com)

---

<div align="center">
  <p>Built with ❤️ for educators worldwide</p>
  <p>
    <a href="#fahm---educational-management-platform">Back to top</a>
  </p>
</div> 