<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .weather_container {
            background-color: #3d4a91;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Search <input type="text" name="" id=""> -->
    <section class="vh-100">
        <div class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4">

                    <h3 class="mb-4 pb-2 fw-normal">Check the weather forecast</h3>

                    <div class="input-group rounded mb-3">
                        <input type="search" class="form-control rounded" id="search_field" placeholder="City" aria-label="Search" aria-describedby="search-addon" />
                    </div>

                    <div class="card shadow-0 border  weather_container">
                        <div class="card-body p-4">

                            <h4 class="mb-1 sfw-normal" id="city_name"></h4>
                            <p class="mb-2">Current temperature: <strong id="current_temp"></strong></p>
                            <p>Feels like: <strong id="feels_like"></strong></p>

                            <div class="d-flex flex-row align-items-center">
                                <p class="mb-0 me-4" id="weather_descriptions"></p>
                                <img src="#" alt="weather icon" id="weather_icon">
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        let data = new Request('./cities.json');

        fetch(data)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#city_name').innerHTML = data[0].location.name +
                    ', ' +
                    data[0].location.country;
                document.querySelector('#current_temp').innerHTML = data[0].current.temperature + '&#8451;';
                document.querySelector('#feels_like').innerHTML = data[0].current.feelslike + '&#8451;';
                document.querySelector('#weather_descriptions').innerHTML = data[0].current.weather_descriptions[0];
                document.querySelector('#weather_icon').src = data[0].current.weather_icons[0];
            })
            .catch(error => console.log(error));
        // Search
        document.querySelector('#search_field').onkeyup = function() {
            fetch(data)
                .then(response => response.json())
                .then(data => {
                    let allObjects = data.length;

                    for (let i = 0; i < allObjects; i++) {
                        if (this.value.toLowerCase() === data[i].location.name.toLowerCase()) {
                            document.querySelector('#city_name').innerHTML = data[i].location.name +
                                ', ' +
                                data[i].location.country;
                            document.querySelector('#current_temp').innerHTML = data[i].current.temperature + '&#8451;';
                            document.querySelector('#feels_like').innerHTML = data[i].current.feelslike + '&#8451;';
                            document.querySelector('#weather_descriptions').innerHTML = data[i].current.weather_descriptions[0];
                            document.querySelector('#weather_icon').src = data[i].current.weather_icons[0];
                        }
                    }
                })
                .catch(error => console.log(error));
        };
    </script>
</body>

</html>