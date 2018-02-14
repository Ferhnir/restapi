<?php
  $app->get('/insect/adult', \insectAdult::class . ':getData');
  $app->post('/insect/adult', \insectAdult::class . ':setData');
  $app->put('/insect/adult', \insectAdult::class . ':updateData');
  $app->delete('/insect/adult', \insectAdult::class . ':deleteData');
?>
