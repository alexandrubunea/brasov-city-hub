<div align="center">
  <img src="storage/app/public/images/logo.png" alt="Brasov City Hub Logo" width="200"/>

  [![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
  [![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17.2-316192?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org)
  [![TailwindCSS](https://img.shields.io/badge/Tailwind-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
  [![License](https://img.shields.io/badge/License-GPLv3-blue.svg?style=for-the-badge)](https://www.gnu.org/licenses/gpl-3.0)

  A modern web platform connecting the community of Brasov through news, discussions, and local discoveries. 🌟
</div>

---

## ✨ Features

🗞️ **News System**
- Create and moderate local news articles
- Rich text editing with TinyMCE
- Interactive commenting system
- Like/unlike functionality for articles

🗣️ **Discussion Platform**
- Community-driven discussions
- Event categorization (Cultural, Sports, Movies, etc.)
- Real-time interaction with likes and comments

🎯 **Local Discovery**
- Google Cloud API integration
- Smart caching with Redis
- Discover nearby attractions and businesses

👥 **Advanced Role System**
- Modular permissions
- Granular access control
- Flexible role management

## 🚀 Tech Stack

### 🛠️ Backend
- ![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel&logoColor=white)
- ![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17.2-316192?style=flat-square&logo=postgresql&logoColor=white)

### 💫 Frontend
- ![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=flat-square&logo=livewire&logoColor=white)
- ![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=flat-square&logo=alpine.js&logoColor=white)
- ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
- ![Font Awesome](https://img.shields.io/badge/Font_Awesome-Free-528DD7?style=flat-square&logo=font-awesome&logoColor=white)

### 🌐 APIs
- ![Google Cloud](https://img.shields.io/badge/Google_Cloud-Places_API-4285F4?style=flat-square&logo=google-cloud&logoColor=white)

## 📋 Prerequisites

Before you begin, ensure you have installed:

- 📌 PHP 8.2 or higher
- 📌 Node.js and npm
- 📌 Composer
- 📌 PostgreSQL 17.2

## 🚀 Installation

1. **Clone the repository:**
```bash
git clone https://github.com/alexandrubunea/brasov-city-hub.git
cd brasov-city-hub
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Install Node.js dependencies:**
```bash
npm install
```

4. **Set up environment:**
```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

5. **Configure database in `.env`:**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Configure Google API KEY in `.env`:**
```env
GOOGLE_PLACES_API_KEY=YOUR_API_KEY
```

7. **Run migrations:**
```bash
php artisan migrate
```

8. **Build assets:**
```bash
npm run build
```

## 💻 Development

Start all services with a single command:
```bash
composer run dev
```

This launches:
- 🔷 Laravel development server
- 🔷 Queue worker
- 🔷 Log viewer
- 🔷 Vite development server

## 🗄️ Database Structure

```mermaid
erDiagram
    USERS ||--o{ NEWS_ARTICLES : creates
    USERS ||--o{ DISCUSSIONS : creates
    USERS ||--o{ COMMENTS : writes
    USERS }|--|| ROLES : has
    NEWS_ARTICLES ||--o{ COMMENTS : has
    NEWS_ARTICLES ||--o{ NEWS_LIKES : has
    DISCUSSIONS ||--o{ DISCUSSION_LIKES : has
```

## 🔑 Key Features

### 👥 Role Management
- 🛡️ Modular role system
- 🔐 Granular permissions for:
  - News creation/moderation
  - Discussion creation/moderation
  - User moderation
  - Role management

### 📝 Content Management
- ✨ Rich text editing with TinyMCE
- 📰 News article system
- 💬 Community discussions
- 🛡️ Content moderation tools

### 🗺️ Local Discovery
- 🌍 Google Cloud API integration
- ⚡ Redis caching
- 🎯 Nearby places discovery

## 🤝 Contributing

While this repository can be forked, pull requests will be carefully reviewed. Only critical improvements or fixes will be considered.

## 📄 License

This project is licensed under the GNU General Public License v3.0 - see the [LICENSE](LICENSE) file for details.
<br/><br/>
<div align="center">
Made with ❤️ for Brasov
</div>
