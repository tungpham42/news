<?php
include './config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức Tổng hợp</title>
    <meta property="og:image" content="https://tintuc.nhipsinhhoc.vn/news_1200x630.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="https://tintuc.nhipsinhhoc.vn">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Tin tức Tổng hợp">
    <meta property="og:description" content="Tin tức mới nhất tổng hợp từ nhiều nguồn báo chí đáng tin cậy.">
    <meta name="description" content="Tin tức mới nhất tổng hợp từ nhiều nguồn báo chí đáng tin cậy.">
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
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KTPXGLK');</script>
    <!-- End Google Tag Manager -->
    <script>
        const newsData = <?php echo json_encode($newsData); ?>;
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tin tức Tổng hợp</h1>

        <!-- Tabs navigation -->
        <ul class="nav nav-tabs" id="newsTabs" role="tablist">
            <?php
            foreach ($newsData as $key => $news):
            ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link<?php echo $key == $firstKey ? ' active': ''; ?>" id="<?php echo $news['name']; ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $news['name']; ?>" type="button" role="tab" aria-controls="<?php echo $news['name']; ?>" aria-selected="true"><?php echo $news['title']; ?></button>
            </li>
            <?php
            endforeach;
            ?>
        </ul>

        <!-- Tabs content -->
        <div class="tab-content mt-3" id="newsTabsContent">
            <?php
            foreach ($newsData as $key => $news):
            ?>
            <div class="tab-pane fade<?php echo $key == $firstKey ? ' show active': ''; ?>" id="<?php echo $news['name']; ?>" role="tabpanel" aria-labelledby="<?php echo $news['name']; ?>-tab">
                <div id="<?php echo $news['name']; ?>-news-container" class="row"></div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom JS -->
    <script src="script.js?v=22"></script>
</body>
</html>