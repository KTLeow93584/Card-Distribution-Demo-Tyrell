# 🎴 Card Distribution Demo – Monorepo

A full-stack card distribution application that randomly deals a 52-card deck to `n` people.

This monorepo contains:
- 🔙 **Back-End** (Laravel 12)
- 🎴 **Front-End** (VueJS 3/ReactJS 19)
- 🐳 Optional Docker setup

---

## 📚 Table of Contents

<details>
<summary>Click to expand</summary>

- [📦 Repositories](#-repositories)
- [🐳 Option 1: Docker Setup (Coming Soon)](#-option-1-docker-setup-coming-soon)
- [🧰 Option 2: Manual Git Setup](#-option-2-manual-git-setup)
  - [🔙 Backend (Laravel)](#-backend-laravel)
    - [📋 Requirements](#-requirements)
    - [🚀 Setup Instructions](#-setup-instructions)
  - [🎴 Frontend (Vue)](#-frontend-vue)
    - [📋 Requirements](#-requirements-1)
    - [🚀 Setup Instructions](#-setup-instructions-1)
  - [🎴 Frontend (React)](#-frontend-react)
    - [📋 Requirements](#-requirements-2)
    - [🚀 Setup Instructions](#-setup-instructions-2)
- [📝 Notes](#-notes)
- [👨‍💻 Author](#-author)
</details>

---

## 🐳 Option 1: Docker Setup

A full Docker setup for both frontend and backend is planned. This will simplify local setup using Docker Compose.

### Clone the git repository:
```
https://github.com/KTLeow93584/Card-Distribution-Demo-Tyrell.git
```

### You will have the following URLs readily accessible after running the following command:
```
docker-compose up -d --build
```
Note: `-d` to run in the background.
URLs:
```
http://localhost:8000 (Back-End)
http://localhost:5174 (Vue Front-End)
http://localhost:5173 (React Front-End)
```

To bring down the container:
```
docker-compose down -v
```

To view the container with a GUI, you may utilize [Docker Desktop](https://www.docker.com/products/docker-desktop/).

---

## 🧰 Option 2: Manual Git Setup

Clone the git repository:
```
https://github.com/KTLeow93584/Card-Distribution-Demo-Tyrell.git
```

---

# 🛠️ Backend (Laravel)

### 🎯 Purpose

Exposes an API endpoint to distribute 52 playing cards randomly among `n` people.

---

### 📋 Requirements

- PHP ≥ 7.4  
- Composer ≥ 2  
- Laravel ≥ 12  
- Vite ≥ 6.2  
- PostgreSQL ≥ 17.5 **or** MySQL ≥ 8.0  
- [Optional] Docker

---

### 🚀 Setup Instructions

#### 1. Move to the project folder and open with your desired IDE (E.g. Visual Studio Code)

```
cd back-end
```


#### 2. Install Dependencies

```
composer install
```

#### 3. Create Environment File

```
# Linux
cp .env.example .env
# For Windows -> Simply CTRL+C -> CTRL+V
```

#### 4. Generate Application Key

```
php artisan key:generate
```

#### 5. Configure Database

> ⚠️ Ensure PDO extensions are enabled in `php.ini` to avoid:
> `PDOException: could not find driver`

##### PostgreSQL Setup

Create a database named `card-distribution-tyrell`. Example `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=card-distribution-tyrell
DB_USERNAME=postgres
DB_PASSWORD=your_password
DB_SSLMODE=disable
```

##### MySQL Setup
Create a database named `card-distribution-tyrell`. Example `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=card-distribution-tyrell
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 6. Migrate Database

```
php artisan migrate
```

#### 7. Run Development Server

```
php artisan serve
```

#### 8. Unit Testing

```
php artisan test --testsuite=Feature
```

# 🎴 Frontend (Vue)

### 🎯 Purpose

The VueJS 3-based user interface to interact with the Laravel API and visually distribute cards among players.

---

### 📋 Requirements

- [Node.js](https://nodejs.org/en/download) ≥ 22  
- NPM (included with Node.js)  
- VueJS ≥ 3.0

---

### 🚀 Setup Instructions

#### 1. Move to the project folder and open with your desired IDE (E.g. Visual Studio Code)

```
cd front-end/vue-app
```

#### 2. Install Dependencies

```
npm install
```

#### 3. Create the Environment File

```
# Linux
cp .env.example .env
# For Windows -> Simply CTRL+C -> CTRL+V
```

#### 4. Configure Backend API URL

Ensure the VITE_SERVER_URL in .env is set to the correct backend address:
```
VITE_SERVER_URL=http://localhost:8000
```
> 🔄 Update this if your Laravel server runs on a different host/port (e.g., Docker, remote, etc.)

#### 5. Run the Development Server

```
npm run dev
```
> 🔍 Navigate to the printed local dev URL (usually http://localhost:5173) in your browser.

# 🎴 Frontend (React)

### 🎯 Purpose

The ReactJS-based user interface to interact with the Laravel API and visually distribute cards among players.

---

### 📋 Requirements

- [Node.js](https://nodejs.org/en/download) ≥ 22  
- NPM (included with Node.js)  
- ReactJS ≥ 19.0

---

### 🚀 Setup Instructions

#### 1. Move to the project folder and open with your desired IDE (E.g. Visual Studio Code)

```
cd front-end/react-app
```

#### 2. Install Dependencies

```
npm install
```

#### 3. Create the Environment File

```
# Linux
cp .env.example .env
# For Windows -> Simply CTRL+C -> CTRL+V
```

#### 4. Configure Backend API URL

Ensure the VITE_SERVER_URL in .env is set to the correct backend address:
```
VITE_SERVER_URL=http://localhost:8000
```
> 🔄 Update this if your Laravel server runs on a different host/port (e.g., Docker, remote, etc.)

#### 5. Run the Development Server

```
npm run dev
```
> 🔍 Navigate to the printed local dev URL (usually http://localhost:5174) in your browser.

## 📝 Notes

- Ensure `.env` files are configured correctly in both the backend and frontend projects.
- Laravel backend runs by default at `http://localhost:8000`, and Vue frontend typically at `http://localhost:5173`.
- API connectivity depends on the `VITE_SERVER_URL` value in the frontend `.env` file — ensure it matches the backend's host and port.
- Common issues to check:
  - ❌ **Database connection issues** → Ensure correct `.env` DB credentials and required PDO extensions.
  - ❌ **Port conflicts** → Ensure no other service is running on ports `8000`, `5173` or `5174`.

---

## 👨‍💻 Author

**Kean Tat Leow**  
📫 [@KTLeow93584 on GitHub](https://github.com/KTLeow93584)

---
