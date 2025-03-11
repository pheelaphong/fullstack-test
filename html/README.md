# FazWaz Full Stack Developer Test

## Installation

### 1. Clone the Repository

```
bash
git clone <repository_url>
cd <repository_directory>
```

### 2. Install Dependencies
* PHP Dependencies:
```
./vendor/bin/sail composer install
```
* Node.js Dependencies:
```
./vendor/bin/sail npm install

```

### 3. Environment Setup

```
cp .env.example .env
```

### 4. Database Migration and Seeding

```
./vendor/bin/sail artisan migrate --seed
```

### 4. Build Frontend Assets

```
./vendor/bin/sail npm run dev
```

## Running the Application
```
./vendor/bin/sail up
```
Access the application at http://localhost (or the port specified in your .env file).

## Testing
```
./vendor/bin/sail artisan test --filter PropertyApiTest
```
