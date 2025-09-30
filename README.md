# Company Profile Management System

Sistem manajemen company profile dengan fitur authentication, CRUD articles, dan management profile perusahaan yang dibangun menggunakan Laravel 11 dan MongoDB dengan Docker.

## 🚀 Features

- **Authentication System**
  - Login & Logout
  - Session management
  - Protected routes

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
- **Database:** MongoDB 7.0
- **Frontend:** Bootstrap 5, Blade Template
- **Authentication:** Laravel Auth with MongoDB
- **File Storage:** Laravel Storage (Local)
- **Containerization:** Docker & Docker Compose
- **Web Server:** Nginx (Alpine)
- **PHP:** 8.2-FPM

## 📋 Requirements

- Docker Desktop (Windows/Mac/Linux)
- Git

**Atau tanpa Docker:**
- PHP >= 8.2
- Composer
- MongoDB >= 4.0
- MongoDB PHP Extension

## 🐳 Installation with Docker (Recommended)

### 1. Clone Repository

```bash
git clone <repository-url>
cd company-profile
```

### 2. Setup Docker Files

Pastikan file-file Docker sudah ada:
- `Dockerfile`
- `docker-compose.yml`
- `docker/nginx/conf.d/default.conf`
- `docker/mongodb/init-mongo.js`

### 3. Build & Start Containers

```bash
docker-compose up -d --build
```

Tunggu sampai semua container running (pertama kali bisa 5-10 menit).

### 4. Install Dependencies

```bash
docker-compose exec app composer install
```

### 5. Setup Application

```bash
# Generate application key
docker-compose exec app php artisan key:generate

# Create storage link
docker-compose exec app php artisan storage:link

# Seed database
docker-compose exec app php artisan db:seed
```

### 6. Access Application

- **Laravel App:** http://localhost:8080
- **MongoDB Admin UI:** http://localhost:8081
  - Username: `admin`
  - Password: `admin123`

## 💻 Installation without Docker

### 1. Clone & Install Dependencies

```bash
git clone <repository-url>
cd company-profile
composer install
```

### 2. Environment Configuration

```bash
cp .env.example .env
```

Update `.env`:

```env
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=company_profile
DB_USERNAME=
DB_PASSWORD=
```

### 3. Setup Application

```bash
php artisan key:generate
php artisan storage:link
php artisan db:seed
php artisan serve
```

Access: http://127.0.0.1:8000

## 👤 Default Accounts

### Admin Account
- **Email:** superadmin@company.com
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
│   │       ├── Api/
│   │       │   ├── AuthController.php
│   │       │   ├── ArticleController.php
│   │       │   └── CompanyProfileController.php
│   │       ├── Auth/
│   │       ├── ArticleController.php
│   │       └── CompanyProfileController.php
│   └── Models/
│       ├── User.php
│       ├── Article.php
│       └── CompanyProfile.php
├── database/
│   └── seeders/
│       ├── UserSeeder.php
│       └── CompanyProfileSeeder.php
├── docker/
│   ├── mongodb/
│   │   └── init-mongo.js
│   ├── nginx/
│   │   └── conf.d/
│   │       └── default.conf
│   └── php/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── auth/
│       ├── articles/
│       ├── company-profile/
│       └── dashboard.blade.php
├── routes/
│   ├── web.php
│   └── api.php
├── docker-compose.yml
└── Dockerfile
```

## 🎯 Usage

### Web Application

1. **Login:** http://localhost:8080/login
2. **Dashboard:** Manage articles and company profile
3. **Articles:** Create, edit, delete articles
4. **Company Profile:** Update company information

### API Endpoints

Base URL: `http://localhost:8080/api`

**Authentication:**
- `POST /login` - Login user
- `POST /register` - Register new user

**Articles:**
- `GET /articles` - Get all articles
- `GET /articles/{id}` - Get single article
- `POST /admin/articles` - Create article
- `PUT /admin/articles/{id}` - Update article
- `DELETE /admin/articles/{id}` - Delete article

**Company Profile:**
- `GET /company-profile` - Get company profile
- `PUT /admin/company-profile` - Update company profile

See `POSTMAN-API-GUIDE.md` for detailed API documentation.

## 🐳 Docker Commands

### Container Management

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Restart containers
docker-compose restart

# View logs
docker-compose logs -f

# View specific service logs
docker-compose logs -f app
docker-compose logs -f mongodb

# Check container status
docker-compose ps
```

### Application Commands

```bash
# Execute artisan commands
docker-compose exec app php artisan <command>

# Examples:
docker-compose exec app php artisan route:list
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear

# Composer commands
docker-compose exec app composer install
docker-compose exec app composer update

# Access container shell
docker-compose exec app bash

# Access MongoDB shell
docker-compose exec mongodb mongosh -u laravel -p laravelpassword company_profile
```

### Database Management

```bash
# Seed database
docker-compose exec app php artisan db:seed

# Access Laravel Tinker
docker-compose exec app php artisan tinker

# Test MongoDB connection
docker-compose exec app php artisan tinker
>>> DB::connection('mongodb')->getMongoDB()->command(['ping' => 1]);
```

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

## 🔧 Development Workflow

### Making Changes

**✅ No rebuild needed for:**
- Controller changes
- Model changes
- View changes
- Route changes
- `.env` changes (just clear cache)
- Logic updates

**🔄 Rebuild needed for:**
- `Dockerfile` changes
- `docker-compose.yml` changes
- Nginx config changes
- Installing new PHP extensions

```bash
# After changing Dockerfile or docker-compose.yml
docker-compose down
docker-compose up -d --build
```

### Installing New Packages

```bash
# Install Composer package
docker-compose exec app composer require vendor/package

# Clear cache after .env changes
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
```

## 🐛 Troubleshooting

### Container Won't Start

```bash
# Check logs
docker-compose logs -f

# Rebuild containers
docker-compose down
docker-compose up -d --build
```

### Port Already in Use

Edit `docker-compose.yml` and change ports:

```yaml
nginx:
  ports:
    - "9090:80"  # Change 8080 to 9090

mongodb:
  ports:
    - "27018:27017"  # Change 27017 to 27018
```

### MongoDB Connection Failed

1. Check `.env` configuration:
```env
DB_HOST=mongodb  # Must be 'mongodb', not '127.0.0.1'
DB_USERNAME=laravel
DB_PASSWORD=laravelpassword
DB_AUTHENTICATION_DATABASE=admin
```

2. Clear cache:
```bash
docker-compose exec app php artisan config:clear
```

3. Test connection:
```bash
docker-compose exec app php artisan tinker
>>> DB::connection('mongodb')->getMongoDB()->command(['ping' => 1]);
```

### Permission Issues

```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Clean Install

```bash
# Remove all containers and volumes (⚠️ deletes data!)
docker-compose down -v

# Rebuild everything
docker-compose up -d --build

# Reinstall dependencies
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan db:seed
```

## 🚀 Deployment

### Production Checklist

1. **Update environment:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize Laravel:**
```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

3. **Update MongoDB credentials:**
- Use strong passwords
- Remove Mongo Express from production
- Enable MongoDB authentication

4. **Setup SSL/TLS:**
- Configure reverse proxy (Nginx/Traefik)
- Use Let's Encrypt certificates

5. **Backup strategy:**
```bash
# Backup MongoDB
docker-compose exec mongodb mongodump --username=laravel --password=laravelpassword --db=company_profile --out=/backup
```

## 📊 Services & Ports

| Service | Container Name | Port | Description |
|---------|---------------|------|-------------|
| Laravel | company-profile-app | - | PHP 8.2-FPM Application |
| Nginx | company-profile-nginx | 8080 | Web Server |
| MongoDB | company-profile-mongodb | 27017 | Database |
| Mongo Express | company-profile-mongo-express | 8081 | MongoDB Admin UI |

## 🔒 Security

- Passwords hashed with bcrypt
- CSRF protection enabled
- Form validation (backend)
- File upload validation (type, size)
- Authentication middleware for protected routes
- MongoDB user authentication
- Docker network isolation

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Developed with ❤️ using Laravel 11, MongoDB & Docker

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📧 Support

For support, create an issue in this repository.

---

**Built with Docker 🐳 | Powered by Laravel 11 & MongoDB**