<?php
  $app->get('/insect/food', \insectFood::class . ':getData');
  $app->post('/insect/food', \insectFood::class . ':setData');
  $app->put('/insect/food', \insectFood::class . ':updateData');
  $app->delete('/insect/food', \insectFood::class . ':deleteData');
?>
