<!-- Badges -->

[![Contributors][contributors-shield]][contributors-url]
[![Repo size][repo-size-shield]][repo-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url-1]
[![LinkedIn][linkedin-shield]][linkedin-url-2]

# Don't Forget

<!-- Project Logo -->
<p align=center>
<img src="./assets/images/logo.svg" width=256/>
<h3 align=center>Retbing Social</h3>
<p align=center>A simple social app created with Laravel and Vuejs<p/>
</p>

<!-- Description -->

<br>

## About The Project

Retbing Social is a social web application that allows you to share posts, and interact with your friends. The application was developed with the idea of wondering how social media applications work and learning by trying it. Although it is far from being a real social media application for now, it contains the basic mechanics. It can be a good starting guide for curious people like us who don't know where to start!

### Built With

-   [Laravel][laravel-url]
-   [VueJs][vuejs-url]

## Getting Started

Retbing Social has been created with two powerful technologies, [Laravel][laravel-url] and [VueJs][vuejs-url]. The Laravel backend server of the application serves as a REST API and the frontend application connects it via http requests. Because backend part is totally seperate from the frontend part, you can use any other technology than VueJs to create the frontend. You can check all routes of the api [here](./routes/api.php).

<!--
<br>
<p align=center><img src="./assets/images/app-usage.gif" width=250/></p> -->

### Prerequisites

You need to have following technologies on your machine before you run the project.

-   [Composer](https://getcomposer.org/download/)

-   [Laravel](https://laravel.com/docs/8.x#installation-via-composer)

-   [Node](https://nodejs.org/en/)

### Installation

1. Clone the repo
    ```sh
    git clone https://github.com/retbing/retbing-social
    ```
2. Install required packages

    ```sh
    composer install & npm install
    ```

3. Make your own .env file from .env.example

    ```sh
    cp ./.env.example ./.env
    ```

4. Generate your app key

    ```sh
    php artisan key:generate
    ```

5. Create your jwt secret

    ```sh
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    ```

    ```sh
    php artisan jwt:secret
    ```

6. Create database file and migrate database tables

    ```sh
    touch ./database/database.sqlite & php artisan migrate
    ```

## Usage

1. Run application

    ```sh
    php artisan serve
    ```

2. If you want to make changes on frontend you need to run following command

    ```sh
    npm run dev
    ```

    or

    ```sh
    npm run watch
    ```

<!-- _For more examples, please refer to the [Documentation](https://example.com)_ -->

## Roadmap

See the [open issues][issues-url] for a list of proposed features (and known issues).

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->

## Contributors

<table>
<tr>
<td>
<a href='https://github.com/rtanyildizi' target="_blank">
<div float="left" align="center">
<img src="https://github.com/rtanyildizi.png" width=150px />

<h4 > Nurettin Resul Tanyıldızı </h4>
<p><a href='https://linkedin.com/in/rtanyildizi'>Linkedin</a> - <a href='mailto:tanyildizi.resul@gmail.com'>Gmail</a></p>
</div></a>
</td>
<td>
</td>
<td>
<a href='https://github.com/Benjamin274' target="_blank">
<div float="left" align="center">
<img src="https://media-exp1.licdn.com/dms/image/C4D03AQFQxvjnK7iDZA/profile-displayphoto-shrink_400_400/0/1598643535724?e=1619654400&v=beta&t=saz9CnZ6WhM9xhtJTRUk8xjsefUFdB3rSGR1qPod4NY" width=150px />

<h4>  BINIYAM A. GEINORE  </h4>
<p><a href='https://www.linkedin.com/in/biniyam-a-geinore-629975133/'>Linkedin</a> - <a href='mailto:biniabera274@gmail.com
'>Gmail</a></p>
</div></a>
</td>
</tr>
</table>
<!-- Variables -->

[laravel-url]: https://laravel.com
[vuejs-url]: https://vuejs.org/
[repo-url]: https://github.com/retbing/retbing-social
[issues-url]: https://github.com/retbing/retbing-social/issues
[contributors-shield]: https://img.shields.io/github/contributors/retbing/retbing-social
[contributors-url]: https://github.com/retbing/retbing-social/graphs/contributors
[repo-size-shield]: https://img.shields.io/github/repo-size/retbing/retbing-social
[license-shield]: https://img.shields.io/github/license/retbing/retbing-social
[license-url]: https://github.com/retbing/retbing-social/blob/main/LICENSE
[linkedin-shield]: https://img.shields.io/badge/LinkedIn-%230072B1?logo=linkedin
[linkedin-url-1]: https://linkedin.com/in/rtanyildizi
[linkedin-url-2]: https://linkedin.com/in/biniyam-a-geinore-629975133/

```

```
