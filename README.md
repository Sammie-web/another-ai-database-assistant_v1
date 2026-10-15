# Database Assistant — Local Host

A small Laravel application for running and trying the `another/database-assistant` package locally. It provides the package's UI and routes, a SQLite database with a sample `projects` resource, and a demo login that is only available in the local environment.

> **Local development only.** This app includes an automatic demo sign-in and is not intended to be deployed or used with real or sensitive data.

## Requirements

- PHP 8.3 or later
- Composer
- Node.js and npm
- The database-assistant package checkout at `..\local chatbox` relative to this repository

Composer uses that sibling checkout as a symlinked path repository. If your package checkout is elsewhere, update the repository URL in `composer.json` before installing dependencies.

## Get started

Run these commands from the project directory in PowerShell:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
npm install
npm run build
php artisan migrate
```

If you already have a `.env` file, keep it and skip `Copy-Item` so your local settings are not overwritten. The SQLite database is configured in `.env.example`; if the database file is missing, create it before migrating:

```powershell
New-Item -ItemType File -Path database\database.sqlite
```

Start the app:

```powershell
php artisan serve
```

Open <http://127.0.0.1:8000>. In `APP_ENV=local`, the home page signs in the demo user and redirects to the assistant. The demo login creates a `demo-tenant` user and a sample project when needed.

For frontend development with Vite hot reload, run `npm run dev` in a second terminal while the Laravel server is running.

## Configure an AI provider

Add a valid provider key to your ignored `.env` file and select the corresponding provider:

```dotenv
ASSISTANT_PROVIDER=openai
OPENAI_API_KEY=your-openai-api-key
```

Or use Gemini:

```dotenv
ASSISTANT_PROVIDER=gemini
GEMINI_API_KEY=your-gemini-api-key
```

The default provider is OpenAI. Optional model settings are `OPENAI_MODEL` and `GEMINI_MODEL`; their defaults are defined in `config/assistant.php`. Without a valid provider key, the assistant UI can load, but it cannot generate replies. Never commit API keys or put them in tracked files.

## What this host configures

- Uses SQLite by default.
- Exposes the `projects` resource to the assistant with `id`, `name`, and `status` columns.
- Restricts the demo user's assistant access to the `demo-tenant` sample data.
- Registers the local demo login route only when `APP_ENV=local`.

The package's default interface and routes are provided by `another/database-assistant`; this repository is the local Laravel host and its demo configuration.

## Tests

Run the Laravel test suite with:

```powershell
composer test
```
