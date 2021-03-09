<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Website</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Some App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="/">Home</a>
                <?php if ($user == null): ?>
                    <a class="nav-link" href="/register">Register</a>
                    <a class="nav-link" href="/login">Login</a>
                <?php endif; ?>

                <a class="nav-link" href="/films">Films</a>
                <a class="nav-link" href="/actors">Actors</a>
                <a class="nav-link" href="/film-actors">Film Actors</a>

                <?php if ($user != null): ?>
                    <a class="nav-link" href="/films/edit">Create film</a>
                <?php endif; ?>
                <?php if ($user != null): ?>
                    <a class="nav-link" href="/actors/edit">Create actor</a>
                <?php endif; ?>
                <?php if ($user != null): ?>
                    <a class="nav-link" href="/film-actors/create">Create Film actor</a>
                <?php endif; ?>

                <?php if ($user != null): ?>
                    <a id="logout" class="nav-link" href="/">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    {{content}}
</div>
</body>
<script>
    $("#logout").on("click", function () {
        delete_cookie("Auth", "/", "localhost");
    });

    function delete_cookie(name, path, domain) {
        if (get_cookie(name)) {
            document.cookie = name + "=" +
                ((path) ? ";path=" + path : "") +
                ((domain) ? ";domain=" + domain : "") +
                ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
        }
    }

    function get_cookie(name) {
        return document.cookie.split(';').some(c => {
            return c.trim().startsWith(name + '=');
        });
    }
</script>
</html>

