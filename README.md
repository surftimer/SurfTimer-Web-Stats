
# Surftimer-Web-Stats v2

 ![GitHub Repo stars](https://img.shields.io/github/stars/kristianp26/surftimer-web-stats?color=ew&style=flat-square)
 ![GitHub forks](https://img.shields.io/github/forks/kristianp26/surftimer-web-stats?style=flat-square)
 ![GitHub contributors](https://img.shields.io/github/contributors/kristianp26/surftimer-web-stats?style=flat-square)
 ![GitHub repo size](https://img.shields.io/github/repo-size/kristianp26/surftimer-web-stats?label=size&style=flat-square)
 ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/kristianp26/surftimer-web-stats?label=last-stable-release&style=flat-square)
 ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/kristianp26/surftimer-web-stats?include_prereleases&label=last-release&style=flat-square)
 ![GitHub](https://img.shields.io/github/license/kristianp26/surftimer-web-stats?style=flat-square)
 ![Docker Pulls](https://img.shields.io/docker/pulls/kristianp26/surftimer-web-stats?style=flat-square)

Surftimer-Web-Stats is Official Web with statistics for [Surftimer-Official](https://github.com/surftimer/Surftimer-Official).

**Features:**
* Dashboard with TOP players and recent Records
* Top Players, Recent Records & Most Active Section
* Maps Section (Complete Statistics)
* Player Profiles (Complete Statistics)
* !!Bootwatch Themes (Beta Version)
* Languages (Czech, Danish, English, French, German, Hindi, Hungarian, Korean, Portuguese, Slovak, Spanish, Turkish, Ukrainian)
* Player Flags (Requires surftimer version: 1.1.2 or above)

**Demos:**
 * [Master Demo](https://demo.stats.surftimer.dev/)
 * [Develop Demo](https://dev.stats.surftimer.dev/)

## Installation and Requirements

Surftimer-Web-Stats works on latest Release of [Surftimer-Official](https://github.com/surftimer/Surftimer-Official). (May be problems on Pre-Release versions).

#### General Requirements
* Maps must have selected tier and be added to server with sm_addnewmap(!addnewmap) command on server
* A MySQL Database with [Surftimer-Official](https://github.com/surftimer/Surftimer-Official) data (MySQL 5.7, MySQL 8+, MariaDB supported)
* DB user with permissions to SELECT, ALTER TABLE, UPDATE AND INSERT.

### Docker (Recommended)
#### Requirements
* [Docker](https://docs.docker.com/get-docker/)

#### Installation
Start by pulling docker image
##### Docker Hub Packages
`docker pull kristianp26/surftimer-web-stats:latest`
##### Github Packages
`docker pull ghcr.io/surftimer/surftimer-web-stats:latest`

Next step: Run Docker container

```
docker run -d \
-e DB_HOST=database_host \
-e DB_PORT=database_port \
-e DB_USER=database_user \
-e DB_PASS=database_pass \
-e DB_NAME=database_name \
-e "NAVBAR_TITLE=My Surf Server" \
-p 8080:80 \
kristianp26/surftimer-web-stats:latest
```
### Standalone
#### Requirements

* Web Server
* PHP 8+ (PHP extensions: mysqli, bcmath)

#### Installation

* Download the latest version from the release page [here](https://github.com/KristianP26/Surftimer-Web-Stats/releases)
* Copy unziped files into your website directory
* Edit `/inc/config.php`

You can find more info on wiki page: [Installation Guide](https://github.com/surftimer/SurfTimer-Web-Stats/wiki/Installation)

## Wiki

**[Wiki & Installation Guide](https://github.com/surftimer/SurfTimer-Web-Stats/wiki)**

## Project Goals

Show all statistics on one place on the website and create best surf web statistics extension.

## Credits
Coded & Designed with love by [KristianP26](https://github.com/KristianP26) and [Contributors](https://github.com/surftimer/SurfTimer-Web-Stats/graphs/contributors).  
Demo site provided by [Bara](https://github.com/Bara).

Translations
* Czech Translation by [KristianP26](https://github.com/KristianP26)
* Slovak Translation by [KristianP26](https://github.com/KristianP26)
* Portuguese Translation by [shipyy](https://github.com/shipyy)
* German Translation by [Bara](https://github.com/Bara)
* French Translation by [Sarrus1](https://github.com/Sarrus1)
* Turkish Translation by pReLiTinqq^^
* Danish Translation by Nubbe#0405
* Korean Translation by [Tsukasa-Nefren](https://github.com/Tsukasa-Nefren)
* Swedish Translation by [Vanheden](https://github.com/Vanheden)
* Spanish Translation by Atomik0#5399

CSS & JS
* [Bootstrap](https://getbootstrap.com/) (Front-end toolkit)
* [Bootswatch](https://bootswatch.com/) (Free themes for Bootstrap)
* [Font Awesome](https://fontawesome.com/) (Icon library and toolkit)
* [PopperJS](https://popper.js.org/) (TOOLTIP & POPOVERPOSITIONING ENGINE)
* [jQuery](https://jquery.com/) (JavaScript library)
* [DataTables](https://datatables.net/) (Plug-in for the jQuery)

Other
* [Map Images Collection](https://github.com/Sayt123/SurfMapPics) by [Sayt123](https://github.com/Sayt123)
* [PHP SteamID convert functions](https://gist.github.com/rannmann/49c1321b3239e00f442c) by [rannmann](https://github.com/rannmann)
