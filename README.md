## Cardano Laravel API
A simple Laravel API project that allows users to connect to Cardano using [Blockfrost](https://blockfrost.io).

## Installation

Clone the project
```bash
https://github.com/istakeada/cardano-laravel.git
```

Setup
```bash
composer install
cp .env.example .env
php artisan scribe:generate
```

Create an account on [Blockfrost](https://blockfrost.io) and create 2 new projects, one for testnet network and the other for mainnet. Add the project ids on .env file.

```phyton
MAINNET=mainnet********************************
TESTNET=testnet********************************
```

## Usage
Visit your project URL and navigate to the available tools built-in for endpoints information.

API Docs
```url
[project-url]/docs
```

### To Do
- Use Blockfrost SDK
- IPFS Endpoints

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)