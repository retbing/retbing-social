<!-- Badges -->

[![Contributors][contributors-shield]][contributors-url]
[![Repo size][repo-size-shield]][repo-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url-1]
[![LinkedIn][linkedin-shield]][linkedin-url-2]

# Don't Forget

<!-- Project Logo -->
<p align=center>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="256" height="256" viewBox="0 0 512 256">
  <defs>
    <clipPath id="clip-Artboard_1">
      <rect width="512" height="256"/>
    </clipPath>
  </defs>
  <g id="Artboard_1" data-name="Artboard – 1" clip-path="url(#clip-Artboard_1)">
    <g id="Icon_ionic-ios-planet" data-name="Icon ionic-ios-planet" transform="translate(0.128 25.648)">
      <path id="Path_1" data-name="Path 1" d="M305.7,172.584c-1.386-4.011-4.084-8.387-8.314-13.346-7.439-8.752-22.463-21.369-39.966-34.423a3.541,3.541,0,0,0-5.47,1.677l-3.428,9.773a3.531,3.531,0,0,0,1.24,4.011c11.6,8.46,26.182,20.348,30.485,26.182a2.717,2.717,0,0,1-2.844,4.23,313.648,313.648,0,0,1-32.235-9.335c-6.272-2.261-12.909-4.886-19.837-7.731a86.866,86.866,0,0,0-9.043-115.96,89.188,89.188,0,0,0-114.064-7.439,87.732,87.732,0,0,0-29.61,37.924c-6.053-4.376-11.742-8.679-16.92-12.836C45.7,47.362,34.979,39.266,27.467,30c-1.6-2.042.656-4.886,3.209-4.3,8.241,1.9,25.818,7.949,41.133,13.784a3.2,3.2,0,0,0,3.282-.583l8.1-7.366a3.126,3.126,0,0,0-.948-5.251C56.639,15.855,33.447,9,21.778,9,13.391,9,7.7,11.553,4.786,16.585-.757,26.285,9.964,42.256,37.677,65.3c24.869,20.785,60.241,45.071,99.551,67.1,63.814,35.809,124.785,59.074,151.7,59.074,8.168,0,13.638-2.261,16.118-6.637C307.084,181.409,307.3,177.251,305.7,172.584Z" transform="translate(0 0)" fill="#f4476b"/>
      <path id="Path_2" data-name="Path 2" d="M144.906,90.461C123.683,81.126,101.658,71.5,77.372,57.788,55.42,45.462,34.051,31.168,15.819,18.7a4.366,4.366,0,0,0-2.48-.8,4.237,4.237,0,0,0-2.042.511A4.273,4.273,0,0,0,8.89,22.2c0,.875-.073,1.75-.073,2.553a86.427,86.427,0,0,0,25.89,61.918,89.084,89.084,0,0,0,110.855,11.45,4.242,4.242,0,0,0,1.969-4.011A4.2,4.2,0,0,0,144.906,90.461Z" transform="translate(51.031 83.363)" fill="#f4476b"/>
    </g>
    <text id="retbing" transform="translate(282 150)" fill="#f4476b" font-size="60" font-family="ArialRoundedMTBold, Arial Rounded MT"><tspan x="0" y="0">retbing</tspan></text>
  </g>
</svg>
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
    composer install
    npm install
    ```

3. Edit .env file

4. Create your jwt secret

    ```sh
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    ```

    ```sh
    php artisan jwt:secret
    ```

5. Migrate database tables

    ```sh
    php artisan migrate
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
<div float="left" align=center style='padding: 10px; width: 200px; border: 1px solid white; background-color: #282A36; border-radius: 10px'>
<img src="https://github.com/rtanyildizi.png" style="border-radius:50%" width=150px />

<h4 style='color: white; font-weight: bold'> Nurettin Resul Tanyıldızı </h4>
<p><a href='https://linkedin.com/in/rtanyildizi'>Linkedin</a> - <a href='mailto:tanyildizi.resul@gmail.com'>Gmail</a></p>
</div></a>
</td>
<td>
<a href='https://github.com/Benjamin274' target="_blank">
<div float="left" align=center style='padding: 10px; width: 200px; border: 1px solid white; background-color: #282A36; border-radius: 10px'>
<img src="https://media-exp1.licdn.com/dms/image/C4D03AQFQxvjnK7iDZA/profile-displayphoto-shrink_400_400/0/1598643535724?e=1619654400&v=beta&t=saz9CnZ6WhM9xhtJTRUk8xjsefUFdB3rSGR1qPod4NY" style="border-radius:50%" width=150px />

<h4 style='color: white; font-weight: bold'>  BINIYAM A. GEINORE  </h4>
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
