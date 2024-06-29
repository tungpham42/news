<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức Việt Nam</title>
    <meta property="og:image" content="https://news.cungrao.net/news_1200x630.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="https://news.cungrao.net">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Tin tức Việt Nam">
    <meta property="og:description" content="Tin tức Việt Nam mới nhất, cập nhật 24/7. Xem tin tức, sự kiện, thời sự, thể thao, kinh tế, văn hóa và giải trí nhanh chóng và chính xác.">
    <meta name="description" content="Tin tức Việt Nam mới nhất, cập nhật 24/7. Xem tin tức, sự kiện, thời sự, thể thao, kinh tế, văn hóa và giải trí nhanh chóng và chính xác.">
    <link rel="icon" href="./news_favicon.png" sizes="64x64" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style.css?v=3" rel="stylesheet">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3585118770961536" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tin tức Việt Nam</h1>

        <!-- Tabs navigation -->
        <ul class="nav nav-tabs" id="newsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="vnexpress-tab" data-bs-toggle="tab" data-bs-target="#vnexpress" type="button" role="tab" aria-controls="vnexpress" aria-selected="true">VnExpress</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="vietnamnet-tab" data-bs-toggle="tab" data-bs-target="#vietnamnet" type="button" role="tab" aria-controls="vietnamnet" aria-selected="true">VietNamNet</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dantri-tab" data-bs-toggle="tab" data-bs-target="#dantri" type="button" role="tab" aria-controls="dantri" aria-selected="false">Dân Trí</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tuoitre-tab" data-bs-toggle="tab" data-bs-target="#tuoitre" type="button" role="tab" aria-controls="tuoitre" aria-selected="false">Tuổi Trẻ</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="thanhnien-tab" data-bs-toggle="tab" data-bs-target="#thanhnien" type="button" role="tab" aria-controls="thanhnien" aria-selected="false">Thanh Niên</button>
            </li>
        </ul>

        <!-- Tabs content -->
        <div class="tab-content mt-3" id="newsTabsContent">
            <div class="tab-pane fade show active" id="vnexpress" role="tabpanel" aria-labelledby="vnexpress-tab">
                <div id="vnexpress-news-container" class="row"></div>
            </div>
            <div class="tab-pane fade" id="vietnamnet" role="tabpanel" aria-labelledby="vietnamnet-tab">
                <div id="vietnamnet-news-container" class="row"></div>
            </div>
            <div class="tab-pane fade" id="dantri" role="tabpanel" aria-labelledby="dantri-tab">
                <div id="dantri-news-container" class="row"></div>
            </div>
            <div class="tab-pane fade" id="tuoitre" role="tabpanel" aria-labelledby="tuoitre-tab">
                <div id="tuoitre-news-container" class="row"></div>
            </div>
            <div class="tab-pane fade" id="thanhnien" role="tabpanel" aria-labelledby="thanhnien-tab">
                <div id="thanhnien-news-container" class="row"></div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom JS -->
    <script src="script.js?v=17"></script>
</body>
</html>
