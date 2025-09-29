# Company Profile Management System

Sistem manajemen company profile dengan fitur authentication, CRUD articles, dan management profile perusahaan yang dibangun menggunakan Laravel 11 dan MongoDB.

## 🚀 Features

- **Authentication System**
  - Login & Logout
  - Session management
  - Protected routes dengan middleware

- **Article Management**
  - Create, Read, Update, Delete (CRUD)
  - Image upload untuk featured image
  - Status management (Draft/Published)
  - Auto-generate slug dari title
  - Pagination

- **Company Profile Management**
  - Update company information
  - Logo upload
  - Vision & Mission management
  - Social media links (Facebook, Instagram, Twitter, LinkedIn)
  - Contact information

- **Dashboard**
  - Statistics overview
  - Quick actions
  - Article counts by status

## 🛠️ Tech Stack

- **Backend:** Laravel 11
- **Database:** MongoDB
- **Frontend:** Bootstrap 5, Blade Template
- **Authentication:** Laravel Auth with MongoDB
- **File Storage:** Laravel Storage (Local)

## 📋 Requirements

- PHP >= 8.2
- Composer
- MongoDB >= 4.0
- MongoDB PHP Extension
- Node.js & NPM (optional, untuk asset compilation)

## 🔧 Installation

### 1. Clone Repository

```bash
git clone <repository-url>
cd company-profile
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy `.env.example` ke `.env`:

```bash
cp .env.example .env
```

Update konfigurasi database di `.env`:

```env
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=company_profile
DB_USERNAME=
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Storage Link

```bash
php artisan storage:link
```

### 6. Seed Database

```bash
php artisan db:seed
```

Ini akan membuat:
- 2 user accounts (admin & editor)
- 1 company profile default

### 7. Run Application

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

## 👤 Default Accounts

### Admin Account
- **Email:** admin@company.com
- **Password:** password123

### Editor Account
- **Email:** editor@company.com
- **Password:** password123

## 📁 Project Structure

```
company-profile/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Auth/
│   │       │   ├── LoginController.php
│   │       │   └── LogoutController.php
│   │       ├── ArticleController.php
│   │       ├── CompanyProfileController.php
│   │       └── DashboardController.php
│   └── Models/
│       ├── User.php
│       ├── Article.php
│       └── CompanyProfile.php
├── database/
│   └── seeders/
│       ├── UserSeeder.php
│       └── CompanyProfileSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   └── login.blade.php
│       ├── articles/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── company-profile/
│       │   ├── index.blade.php
│       │   └── edit.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## 🎯 Usage

### Login
1. Akses `http://127.0.0.1:8000/login`
2. Masukkan email dan password
3. Klik "Login"

### Manage Articles
1. Dari dashboard, klik "Articles" di navbar
2. Klik "Create New Article" untuk membuat artikel baru
3. Isi form (Title, Content, Image, Status)
4. Submit form
5. Untuk edit/delete, gunakan tombol di table list

### Manage Company Profile
1. Dari dashboard, klik "Company Profile" di navbar
2. Klik "Edit Profile"
3. Update informasi perusahaan
4. Upload logo (optional)
5. Submit form

## 🗄️ Database Collections

### users
```javascript
{
  _id: ObjectId,
  name: String,
  email: String,
  password: String (hashed),
  created_at: Date,
  updated_at: Date
}
```

### articles
```javascript
{
  _id: ObjectId,
  title: String,
  slug: String,
  content: Text,
  image: String (path),
  author: String,
  status: Enum ['draft', 'published'],
  published_at: Date,
  created_at: Date,
  updated_at: Date
}
```

### company_profiles
```javascript
{
  _id: ObjectId,
  company_name: String,
  description: Text,
  address: Text,
  phone: String,
  email: String,
  logo: String (path),
  vision: Text,
  mission: Text,
  social_media: {
    facebook: String,
    instagram: String,
    twitter: String,
    linkedin: String
  },
  created_at: Date,
  updated_at: Date
}
```

## 🔒 Security

- Password di-hash menggunakan bcrypt
- CSRF protection enabled
- Form validation di backend
- File upload validation (type, size)
- Authentication middleware untuk protected routes

## 📝 API Endpoints

### Authentication
- `GET /login` - Show login form
- `POST /login` - Process login
- `POST /logout` - Logout user

### Articles
- `GET /articles` - List all articles
- `GET /articles/create` - Show create form
- `POST /articles` - Store new article
- `GET /articles/{id}` - Show article detail
- `GET /articles/{id}/edit` - Show edit form
- `PUT /articles/{id}` - Update article
- `DELETE /articles/{id}` - Delete article

### Company Profile
- `GET /company-profile` - View company profile
- `GET /company-profile/edit` - Show edit form
- `PUT /company-profile` - Update company profile

## 🐛 Troubleshooting

### Error: "Class 'MongoDB\Driver\Manager' not found"
Install MongoDB PHP extension:

**Ubuntu/Debian:**
```bash
sudo apt-get install php-mongodb
```

**Windows:**
Download `php_mongodb.dll` dan tambahkan di `php.ini`:
```ini
extension=mongodb
```

### Error: "Storage not linked"
```bash
php artisan storage:link
```

### Error: "Route not found"
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### MongoDB Connection Failed
Pastikan MongoDB service running:

**Windows:**
```bash
net start MongoDB
```

**Linux/Mac:**
```bash
sudo systemctl start mongod
```

## 🚀 Deployment

### Production Checklist

1. **Set environment to production**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Setup proper file permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

4. **Use queue for background jobs** (optional)
   ```bash
   php artisan queue:work
   ```

5. **Setup backup untuk MongoDB**
   ```bash
   mongodump --db=company_profile --out=/backup/
   ```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Developed with ❤️ using Laravel 11 & MongoDB

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📧 Support

For support, email your-email@example.com or create an issue in this repository.

---

**Happy Coding! 🚀