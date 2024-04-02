<nav class="navbar bg-body-light">

    <div class="container-fluid">
        <a href="/"><img src="/assets/img/home/letrasEmMovimento.png" class="navbar-brand" alt="..." style="margin-left:5px" width="20%" height="15%"></a>

        <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/') { ?>
            <button class="btn d-flex"><a href="#formulario">FAÇA SUA INSCRIÇÃO</a></button>
        <?php } else { ?>

            <button class="btn d-flex"><a href="/">FAÇA SUA INSCRIÇÃO</a></button>

        <?php } ?>
    </div>

</nav>