
# Surftimer-Web-Stats v2

 ![GitHub Repo stars](https://img.shields.io/github/stars/kristianp26/surftimer-web-stats?color=ew&style=flat-square)
 ![GitHub forks](https://img.shields.io/github/forks/kristianp26/surftimer-web-stats?style=flat-square)
 ![GitHub contributors](https://img.shields.io/github/contributors/kristianp26/surftimer-web-stats?style=flat-square)
 ![GitHub repo size](https://img.shields.io/github/repo-size/kristianp26/surftimer-web-stats?label=size&style=flat-square)
 ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/kristianp26/surftimer-web-stats?label=last-stable-release&style=flat-square)
 ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/kristianp26/surftimer-web-stats?include_prereleases&label=last-release&style=flat-square)
 ![GitHub](https://img.shields.io/github/license/kristianp26/surftimer-web-stats?style=flat-square)

Surftimer-Web-Stats is Official Web with statistics for [Surftimer-Official](https://github.com/surftimer/Surftimer-Official).

**Features:**
* Dashboard with TOP players and recent Records
* Top Players, Recent Records & Most Active Section
* Maps Section (Complete Statistics)
* Players Profiles (Complete Statistics)
* !!Bootwatch Themes (Beta Version)
* Languages (Comming Soon...)
* Player Flags

## Project Goals

Show all statistics on one place on the website and create best surf web statistics extension.

 * [Demo](https://demo.stats.surftimer.dev/)

## Installation and Requirements

Surftimer-Web-Stats works on latest Release of [Surftimer-Official](https://github.com/surftimer/Surftimer-Official). (May be problems on Pre-Release versions).

### Standalone

#### Requirements

* Web Server
* PHP7+
* A MySQL Database with [Surftimer-Official](https://github.com/surftimer/Surftimer-Official) data (MySQL 5.7, MySQL 8+, MariaDB supported)
* Maps must have selected tier and be added to server with sm_addnewmap(!addnewmap) command on server

#### Installation

* Download the latest version from the release page [here](https://github.com/KristianP26/Surftimer-Web-Stats/releases)
* Copy unziped files into your web site directory
* Edit `config.php`

### Docker

#### Requirements

* [Docker](https://docs.docker.com/get-docker/)
* Optionally [Docker Compose](https://docs.docker.com/compose/)

#### Installation

Start by cloning the Git repo to a new folder on your computer.

`git clone --depth 1 https://github.com/surftimer/SurfTimer-Web-Stats`

If you are using Docker by itself you could use the following command.

```bash
docker build -t surftimer-web-stats:latest ./SurfTimer-Web-Stats
docker run -d \
  -e DB_HOST=database_host \
  -e DB_PORT=database_port \
  -e DB_USER=database_user \
  -e DB_PASS=database_pass \
  -e DB_NAME=database_name \
  -e "NAVBAR_TITLE=My Surf Server" \
  -p 8080:80 \
  surftimer-web-stats:latest
```

If you are instead using Docker Compose you could have the following in your
`docker-compose.yml` file:

```
version: "3.9"
services:
  web-stats:
    build: ./SurfTimer-Web-Stats
    ports:
      - 8080:80
    environment:
      - DB_HOST=database_host
      - DB_PORT=database_port
      - DB_USER=database_user
      - DB_PASS_FILE=/run/secrets/database_pass
      - DB_NAME=database_name
      - "NAVBAR_TITLE=My Surf Server"
    secrets:
      - database_pass
secrets:
  database_pass:
    file: ./secrets/database_pass.txt
```

This example above also shows how you could make use of [Docker Secrets](https://docs.docker.com/engine/swarm/secrets/)
safely store your passwords.

#### Environment Variables

| Name | Description | Default |
| ---- | ----------- | ------- |
| `DB_HOST` | Host address of the database | `your_database_host` |
| `DB_PORT` | Port for connecting to the database | `3306` |
| `DB_USER` | Username to log in to the database with | `your_database_username` |
| `DB_PASS` | Password to log in to the database with | `your_database_password` |
| `DB_PASS_FILE` | [Docker Secrets](https://docs.docker.com/engine/swarm/secrets/) file for the database's password | None |
| `DB_NAME` | Name of the database to use | `your_database_name` |
| `SETTINGS_THEME` | Colour theme to use | `default` |
| `SETTINGS_FAVICON` | Favicon to use for the site icon | `logo.svg` |
| `NAVBAR_LOGO` | Logo to use for the navbar | `logo.svg` |
| `NAVBAR_TITLE` | Title of the navbar | `Surf Stats` |
| `CUSTOM_LINK_NAME` | Name of the first link in the navbar | `<i class="fas fa-globe-europe"></i> Website` |
| `CUSTOM_LINK_ADDRESS` | Address of the first link in the navbar | `https://github.com/surftimer/SurfTimer-Web-Stats` |
| `CUSTOM_LINK_NAME_2` | Name of the second link in the navbar | `<i class="fab fa-discord"></i> Discord` |
| `CUSTOM_LINK_ADDRESS_2` | Address of the second link in the navbar | `https://discord.surftimer.dev` |
| `CUSTOM_LINK_NAME_3` | Name of the third link in the navbar | None |
| `CUSTOM_LINK_ADDRESS_3` | Address of the third link in the navbar | None |

## Credits
CSS & JS
* [Bootstrap](https://getbootstrap.com/) (Front-end toolkit)
* [Bootswatch](https://bootswatch.com/) (Free themes for Bootstrap)
* [Font Awesome](https://fontawesome.com/) (Icon library and toolkit)
* [PopperJS](https://popper.js.org/) (TOOLTIP & POPOVERPOSITIONING ENGINE)
* [jQuery](https://jquery.com/) (JavaScript library)
* [DataTables](https://datatables.net/) (Plug-in for the jQuery)

Other
* [PHP SteamID convert functions](https://gist.github.com/rannmann/49c1321b3239e00f442c) (by [rannmann](https://github.com/rannmann))
