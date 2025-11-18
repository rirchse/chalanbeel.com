# Chalanbeel Technology - ISP Management System

A comprehensive Internet Service Provider (ISP) management system built with Laravel 10, designed for managing customers, packages, services, payments, and network infrastructure.

## 🚀 Features

### Customer Management
- User registration and authentication
- Customer account management
- User location mapping with interactive map
- Account status tracking (New, Active, Online, Offline, Expired)

### Package & Service Management
- Internet package management
- Service creation and management
- Package selection and assignment
- Billing and payment tracking

### Payment System
- Multiple payment methods support
- Payment verification and tracking
- Transaction history
- Payment status management

### Admin Dashboard
- Comprehensive admin panel
- Service management
- User management
- Payment management
- Location/Area management
- Device management
- Reports and analytics

### Frontend Features
- Modern Material UI design
- Responsive layout (mobile-friendly)
- Bengali and English language support
- Interactive user map with Leaflet.js
- YouTube video background support
- Professional header and footer

## 🛠️ Technology Stack

- **Framework**: Laravel 10
- **PHP Version**: ^8.1
- **Frontend**: Material Dashboard CSS, Bootstrap, Font Awesome
- **Icons**: Material Icons, Font Awesome
- **Maps**: Leaflet.js
- **Database**: MySQL

## 📋 Requirements

- PHP >= 8.1
- Composer
- MySQL
- Apache/Nginx (or Laragon for Windows)

## 🔧 Installation

### Using Laragon (Windows)

1. Clone the repository:
```bash
git clone <repository-url>
cd chalanbeel.com
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
copy .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chalanbeel
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations:
```bash
php artisan migrate
```

7. Start Laragon and access the application:
   - Start Apache and MySQL from Laragon
   - Access via: `http://chalanbeel.test` (if virtual host configured)
   - Or use: `http://127.0.0.1:8000` with `php artisan serve`

### Using PHP Development Server

1. Follow steps 1-6 from above

2. Start the development server:
```bash
php artisan serve
```

3. Access the application at `http://127.0.0.1:8000`

## 📁 Project Structure

```
chalanbeel.com/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   │   ├── Admin/           # Admin controllers
│   │   ├── User/            # User controllers
│   │   └── ...
│   └── Models/              # Eloquent models
├── resources/
│   └── views/
│       ├── homes/           # Public pages
│       ├── admins/          # Admin panel views
│       └── users/           # User dashboard views
├── routes/
│   └── web.php             # Web routes
├── public/                 # Public assets
└── database/              # Migrations and seeds
```

## 🌐 Key Pages

### Public Pages
- **Home** (`/`) - Landing page with hero section, packages, services, and contact info
- **About** (`/about`) - Company information
- **Services** (`/services`) - Service offerings
- **Packages** (`/package`) - Available internet packages
- **Users Map** (`/view-user-on-map`) - Interactive map showing user locations
- **Register** (`/register/create`) - User registration
- **Login** (`/login`) - User login
- **Payment Check** (`/check_payment`) - Payment verification

### Admin Pages
- Admin Dashboard
- User Management
- Service Management
- Payment Management
- Package Management
- Location Management
- Device Management

## 🎨 Design Features

- **Color Scheme**: Black and white Material UI design
- **Responsive**: Mobile-first responsive design
- **Icons**: Material Icons and Font Awesome
- **Typography**: Bengali and English support
- **Layout**: Max-width containers (1400px) for optimal viewing

## 🔗 External Integrations

- **Inventory System**: `https://inventory.chalanbeel.com/`
- **Bazar**: `https://grameenbazar.vercel.app/`

## 📝 Configuration

### Environment Variables

Key environment variables in `.env`:
- `APP_NAME` - Application name
- `APP_URL` - Application URL
- `DB_*` - Database configuration
- `MAIL_*` - Email configuration (if needed)

### Storage

Ensure these directories exist and are writable:
- `storage/framework/sessions`
- `storage/framework/cache`
- `storage/framework/views`
- `storage/logs`

## 🚀 Development

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Run Migrations
```bash
php artisan migrate
```

### Generate Application Key
```bash
php artisan key:generate
```

## 📞 Contact Information

**Chalanbeel Technology**
- Location: Chanchkoir Bazar, Gurudaspur Natore
- Phone: 017 78 57 33 96, 017 03 58 79 11
- Email: info@chalanbeel.com, support@chalanbeel.com
- Hours: সকাল ৯টা - রাত ১০টা, সপ্তাহে ৭ দিন

## 📄 License

This project is proprietary software. All rights reserved.

## 👥 Credits

Built with Laravel Framework and Material Dashboard.

---

For setup instructions specific to Laragon, see [LARAGON_SETUP.md](LARAGON_SETUP.md)
