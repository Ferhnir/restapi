<?php
  $app->get('/insect/tribes', \insectTribes::class . ':getData');
  $app->get('/insect/tribes/all', \insectTribes::class . ':getAllData');
  $app->post('/insect/tribes', \insectTribes::class . ':setData');
  $app->put('/insect/tribes', \insectTribes::class . ':updateData');
  $app->delete('/insect/tribes', \insectTribes::class . ':deleteData');
?>
