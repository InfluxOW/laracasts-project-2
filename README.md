# Birdboard
![PHP CI](https://github.com/InfluxOW/laracasts-project-2/workflows/PHP%20CI/badge.svg)
[![Test Coverage](https://api.codeclimate.com/v1/badges/e6de972129e6d3688ebc/test_coverage)](https://codeclimate.com/github/InfluxOW/laracasts-project-2/test_coverage)

Simple project board made by [Laracasts.com](https://laracasts.com/series/build-a-laravel-app-with-tdd) tutorials.

[https://influx-birdboard.herokuapp.com/](https://influx-birdboard.herokuapp.com/)
# Development Setup
1. Run `make setup` to install dependencies, generate .env file, create SQLite database, apply migrations and etc.
2. Run `make npm` to install npm and compile JS/CSS files.
3. Run `make run` to launch web server (http://localhost:8000).
# Heroku Setup
1. Add `php` and `nodejs` builpacks.
2. Add Heroku Postgres addon.
3. Set all necessary `.env` keys. Set `NPM_CONFIG_PRODUCTION` as `false`.
