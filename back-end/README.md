# 🎴 Card Distribution Backend (Laravel)

Back End Implementation Repository URL: 
1. [Vue](https://github.com/KTLeow93584/FE-Card-Distribution-Demo-Tyrell-Vue)
2. [React - TBA]()

Purpose: It exposes a single endpoint to distribute a deck of 52 playing cards to `n` people randomly.

---

## 📋 Requirements

- PHP ≥ 7.4
- Composer ≥ 2
- Laravel ≥ 12
- Vite ≥ 6.2
- PostgreSQL ≥ 17.5 or MySQL ≥ 8.0
- [Optional] Docker or Laravel Sail

---

## 🚀 Setup Instructions

### 1a. Clone Repository

```
git clone https://github.com/KTLeow93584/BE-Card-Distribution-Demo-Tyrell.git
cd be-card-distribution-demo-tyrell
```

### 1b. Docker Setup
TBA

### 2. Install Dependencies
```
composer install
```

### 3. Create Environment File
```
cp .env.example .env
```

### 4. Generate Application Key
```
php artisan key:generate
```

### 5. Database Setup
Note 1: Usually we won't expose the credentials here unless the repository is private, but for the convenience of the evaluators.
Switch accordingly if you wish to test locally.

Note 2: Ensure your target `php.ini` file has the database's PDO enabled otherwise you'll encounter the following error:

![image](https://github.com/user-attachments/assets/e0d135bc-1799-41cb-8393-b618160b58b3)

```
PDOException  could not find driver.
```

![image](https://github.com/user-attachments/assets/4b3c4939-6ef9-40f9-a8ec-7abcf99e8944)


- PostgreSQL

Local Setup
Create the database, `card-distribution-tyrell`

E.g.

Using PGAdmin, which comes with [PostgreSQL installer](https://www.postgresql.org/download/) (or your desired PostgreSQL GUI/CLI)
![image](https://github.com/user-attachments/assets/91276a87-9b6c-4b71-b66e-b8762623cda2)

Change the .env to as follows:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_PASSWORD=(YOUR_POSTGRESQL_PASSWORD)
DB_DATABASE="card-distribution-tyrell"

# May Differ depending on your setup
DB_USERNAME=postgres

# Disable for localhost as it's ran in "http" (insecure connection), not "https".
DB_SSLMODE="disable"
```

- MySQL

Local Setup
Create the database, `card-distribution-tyrell`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_PASSWORD=(YOUR_MYSQL_PASSWORD)
DB_DATABASE="card-distribution-tyrell"

# May Differ depending on your setup
DB_USERNAME=mysql
```

### 6. Migrate Database
```
php artisan migrate
```

### 7. Run the Development Server
```
php artisan serve
```

### 8. Unit Testing (*Contained in the Features Folder)
```
php artisan test --testsuite=Feature
```
