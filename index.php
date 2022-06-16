<?php
session_start();
require("./baseup.php");
require("./navigation.php");
?>
<main>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/bank1.jpg" class="d-block w-100" alt="..." height=300>
            </div>
            <div class="carousel-item">
                <img src="./assets/bank2.jpg" class="d-block w-100" alt="..." height=300>
            </div>
            <div class="carousel-item">
                <img src="./assets/bank3.jpg" class="d-block w-100" alt="..." height=300>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">
        <h1 class="h1">About Us</h1>
        <p class="well">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum officiis fuga architecto? Explicabo nulla pariatur dolore architecto, incidunt aliquam exercitationem saepe corporis at! Tempora provident vero exercitationem suscipit dolore quas! Voluptates eveniet, laborum obcaecati porro debitis voluptatem veniam sed quibusdam sunt placeat dolore id adipisci facilis perferendis quae quam vel officia amet. Voluptatem, beatae unde reprehenderit praesentium necessitatibus optio! Fugiat unde, eveniet est, voluptatum consectetur dignissimos ducimus voluptate minima asperiores recusandae officiis labore quisquam dolorum repudiandae sequi debitis dicta rerum amet ullam omnis alias. Accusantium et eos autem? Culpa fuga obcaecati officiis accusantium ea. Praesentium voluptatum quidem corporis corrupti perferendis!
        </p>
        <p class="well">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae consequuntur distinctio dolor quos reprehenderit. Cum quas sit nemo iusto et, quibusdam, aliquam minus sapiente iste adipisci consequatur recusandae. Officia, ducimus magnam autem consequatur nemo numquam tempore natus perspiciatis omnis dolore obcaecati voluptas ipsum, eius modi asperiores, vel veniam tempora deleniti! Cupiditate odit vero illum nihil nisi suscipit velit adipisci facere aperiam nemo quisquam assumenda soluta iure quidem sit beatae ut cumque minus, ea labore modi totam quod autem culpa! Quisquam, dolorum eaque? Nobis culpa, minus vero error in odio recusandae officia soluta neque accusamus, quos, deleniti perspiciatis officiis! Dolore, nisi?</p>
    </div>
</main>

<?php
require("./basedown.php");
?>