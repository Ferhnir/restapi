<?php
  $app->get('/insect/genus', \insectGenus::class . ':getData');
  $app->get('/insect/genus/all', \insectGenus::class . ':getAllData');
  $app->post('/insect/genus', \insectGenus::class . ':setData');
  $app->put('/insect/genus', \insectGenus::class . ':updateData');
  $app->delete('/insect/genus', \insectGenus::class . ':deleteData');
?>
