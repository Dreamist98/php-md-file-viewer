<?php require 'includes/header.php' ?>

<?php

     $files = [];
     $dir_files = scandir('md_files/');
     if($dir_files)
     {
          foreach ($dir_files as $file)
          {
               array_push($files, $file);
          }
     }

     if(is_null($_GET['file']) OR !in_array($_GET['file'], $files))
     {
          $links = '';
          foreach ($files as $file)
          {
               if(strstr($file, '.md'))
               $links = $links . '<p><a href="?file=' . $file . '">' . $file . '</a></p>';
          }

          require 'includes/home.php';
     }
     elseif (in_array($_GET['file'], $files))
     {
          require 'lib/erusev/parsedown/parsedown.php';
     
          $parseDown = new Parsedown();
          $file_content = file_get_contents('md_files/' . $_GET['file'], FILE_USE_INCLUDE_PATH);
          $pageContent = $parseDown->text($file_content);

          require 'includes/md.php';
     }

?>

<script src="resources/prism.js"></script>

<?php require 'includes/footer.php' ?>