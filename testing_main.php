<?php

$db = new mysqli('localhost','root','','lokalny1',3307);
$db->set_charset('utf8');

$movies = [];
function get_movies($db, $active) {
    $query = "SELECT * FROM movie WHERE active=".$active." ORDER BY year ASC LIMIT 5";
    $resource = $db->query($query);
    $movieholder = [];
    switch ($active) {
        case 1:
        while ($row = $resource->fetch_assoc()) {
            $movieholder[] = $row;
        }
        break;
        case 0:
        while ($row = $resource->fetch_assoc()) {
            $movieholder[] = $row;
        }
        break;
    }
    return $movieholder;
}

$movies['active'] = get_movies($db, 1);
$movies['inactive'] = get_movies($db, 0);

//var_dump($movies);

$model = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $query = "SELECT * FROM movie WHERE id=".$_GET['id']." LIMIT 1";
    $resource = $db->query($query);
    $model = $resource->fetch_assoc();
    $resource->free();
    $reviews = [];
    if (!empty($model)) {
        $query = "SELECT * FROM review WHERE movie_id=".$model['id']." LIMIT 12";
        $resource = $db->query($query);
        while ($row = $resource->fetch_assoc()) {
            $reviews[] = $row;
        }
        $model['reviews'] = $reviews;
        $resource->free();
    }
}

var_dump($model['reviews']);





$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= !empty($model) ? $model['title'].' - ' : '' ?>My favourite movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>


    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://www.facebook.com/edmund.kawalec" class="text-white">Like on Facebook</a></li>
                            <li><a href="mailto:e.kawalec@s4studio.pl" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="<?= basename(__FILE__) ?>" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    <strong>Album</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main id="main" class="bg-light">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">My Favourite Movies Album</h1>
                <p class="lead text-muted">All made for your purpose :)</p>
            </div>
        </section>



        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php if (!empty($model)): ?>
                        <div class="row">
                            <?php if (!empty($model['poster'])): ?>
                                <div class="col-md-3">
                                    <a data-fancybox="gallery" href="<?= $model['poster'] ?>" title="<?= $model['title'] ?>">
                                        <img src="<?= $model['poster'] ?>" alt="<?= $model['title'] ?>" class="img-thumbnail" />
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-<?= empty($model['poster']) ? '12' : '9' ?>">
                                <h1><?= $model['title'] ?> (<?= $model['year'] ?>)</h1>
                                <p>
                                    <?= !empty($model['description']) ? $model['description'] : 'description text coming soon' ?>
                                </p>
                            </div>
                        </div>
                        <p>
                            <?= !empty($model['tech_info']) ? $model['tech_info'] : 'tech_info coming soon' ?>
                        </p>
                        <hr style="margin-bottom: 0px">
                        <div style="margin-bottom: 0px; margin-top: 0px" class="bg-dark">
                            <h4 style="margin-bottom: 0px; color: #eee; font-size: 30px" class="text-center">Reviews : <?= count($model['reviews']) ?></h4>
                        </div>
                        <hr style="margin-top: 0px">
                        <div class="row">
                            <div class="accordion" id="reviewAccordion">
                                <?php foreach ($model['reviews'] as $review): ?> 
                                    <div class="card">
                                        <div class="card-header" id="review<?= $review['id'] ?>">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $review['id'] ?>" aria-expanded="true" aria-controls="collapse<?= $review['id'] ?>">
                                                    <?= $review['title']  ?>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse<?= $review['id'] ?>" class="collapse show" aria-labelledby="heading<?= $review['id'] ?>" data-parent="#reviewAccordion">
                                          <div class="card-body">
                                            <p><?= substr($review['content'], 0, 350)    ?>...</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>




                    <?php else: ?>
                        <p class="lead text-muted">Welcome, choose film position from right sidebar :)</p>
                        <p><img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" width="600px" alt=""></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <h3>Already seen</h3>
                    <ul>
                        <?php foreach ($movies['active'] as $movie): ?>
                            <li>
                                <a href="<?= basename(__FILE__) ?>?id=<?= $movie['id'] ?>">
                                    <?= $movie['title'] ?> (<?= $movie['year'] ?>)
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <h3>Waiting in queue</h3>
                    <ul>
                        <?php foreach ($movies['inactive'] as $movie): ?>
                            <li>
                                <a href="<?= basename(__FILE__) ?>?id=<?= $movie['id'] ?>">
                                    <?= $movie['title'] ?> (<?= $movie['year'] ?>)
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>


    </main>


    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Movies album made in &copy; Bootstrap, using PHP & MySQL, created for <strong>LokalnyProgramista.pl</strong>!</p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

</body>
</html>
