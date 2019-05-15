<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="<?= base_url(); ?>">



    <title>大考中心管理平台</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="./assets/css/custom.css">

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.css">
    <script>
    $(function() {
        $("body").on("click", "#back", function() {
            history.go(-1);
        })
        $("body").on("click", "#home", function() {
            history.go(-2);
        })
        $("body").on("click", "#index", function() {
            location.href = "./";
        })
        $("body").on("click", "#logout", function() {
            location.href = "/fjuexam/login";
        })
    })
    </script>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#">大考中心管理平台</a>


        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($path_text)) : ?>
                <li class="nav-item active">
                    <a class="nav-link"><?= $path_text; ?> </a>
                </li>
                <?php endif; ?>

            </ul>
            <div class="system_tool">

                <?php if ($path != 'index') : ?>
                <button type="button" class="btn btn-primary" id="back">回上頁</button>
                <button type="button" class="btn btn-primary" id="home">主選單</button>
                <button type="button" class="btn btn-primary" id="index">回平台</button>
                <?php endif; ?>

                <button type="button" class="btn btn-primary" id="logout">登出</button>

            </div>

        </div>
    </nav>

    <main role="main" class="container">

        <?php $this->load->view($path); ?>


    </main>
</body>

</html>