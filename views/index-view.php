<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <link rel="stylesheet" type="text/css" href="./styles/lib/montserrat/webfonts/Montserrat.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gästebuch</title>
</head>
<body>
    <main>
        <h1 class="guestbook-heading">GUESTBOOK</h1>
            <?php if (!empty($errorMessage)):?>
                <p><?php echo $errorMessage?></p>
            <?php endif; ?>
        <form class="container" id="guest-form" action="submit.php" method="POST">
            <label for="name">What is your name?</label>
            <input type="text" id="name" name="name" required>
            <label for="title">Please enter a title:</label>
            <input type="text" id="title" name="title" required>
            <label for="content">Please enter your comment:</label>
            <textarea id="content" name="content" required></textarea>
            <div class="btn-container">
                <button type="reset"><i class="fa-solid fa-x"></i>cancel</button>
                <button type="submit"><i class="fa-solid fa-check"></i>Submit</button>
            </div>
        </form>

        <hr class="container">

        <!-- PHP PAGINATION -->
        <?php $getPage = $_GET['page'] ?? 1;?>
        <?php if ($getPage < 1) $getPage = 1 ?>
        <?php if ($getPage >= $pages) $getPage = $pages -1 ?>
        <ul id="pagination">
        <a href="index.php?page=<?php echo ($getPage === 1) ? 1 : ($getPage - 1) ?>" ><</a>
            
            <?php 
                
                $paginationCount = ($getPage+2) ?? 0;
                if (($getPage+2) >= $countEntries){
                    $paginationCount = $countEntries;
                }
                for ($i = ($getPage); $i <= ($getPage +2) ; $i++):?>
                <li><a href="index.php?<?php echo http_build_query(['page' => $i])?>"><?php echo $i;?></a></li>
            <?php endfor?>
        
            <a href="index.php?page=<?php echo ($getPage+1);?>">></a>
        </ul>
                    

        <!-- ENTRIES -->

        <?php foreach ($entries AS $e):?>

            <article class="posts container">

                <div class="post">
                    <div class="post-head">
                        <div class="head-left">
                            <h6><?php echo e($e['name'])?></h6>
                            <p> <?php 
                                    echo createDateDifference($e['date']);
                                ?>
                            </p>
                        </div>
                        <div class="head-right">
                            <p><?php echo e($e['date'])?></p>
                        </div>
                    </div>

                    <div class="post-body">
                        <h3><?php echo e($e['title'])?></h3>

                    <!-- CREATE PARASGRAPHS  -->
                    
                        <?php
                            $paragraphs = explode("\n", $e['content']);
                            $filteredParagraphs = [];
                            foreach ($paragraphs AS $paragraph) {
                                $paragraph = trim($paragraph);
                                if (strlen($paragraph) > 0) {
                                    $filteredParagraphs[] = $paragraph;
                                }
                            }
                        ?>

                        <?php foreach($filteredParagraphs AS $p): ?>
                            <p class="para"><?php echo e($p);?></p>
                        <?php endforeach; ?>

                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </main>

</body>
</html>