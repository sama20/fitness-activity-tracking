<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fitness Activity Tracking</title>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <h1 class="center">Fitness Activity Tracking</h1>
            <strong>
                You should call bellow api routes:
            </strong>
            <p>api/activities/</p>
            <p>api/activities/{type}</p>
            <p>api/activities/{type}/total-distance</p>
            <p>api/activities/{type}/total-time</p>
            <p>api/activities/ (POST)</p>
            <br>
            <br>
            <br>
            <p>
                More information:
                <a target="_blank" href="https://gitlab.com/sm.asghari/fitness-activity-tracking">Project Source</a>
            </p>

        </div>
    </body>
</html>
