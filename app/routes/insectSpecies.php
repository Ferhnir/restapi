<?php
  $app->get('/insect/species', \insectSpecies::class . ':getData');
  $app->get('/insect/species/all', \insectSpecies::class . ':getAllData');
  $app->post('/insect/species', \insectSpecies::class . ':setData');
  $app->put('/insect/species', \insectSpecies::class . ':updateData');
  $app->delete('/insect/species', \insectSpecies::class . ':deleteData');
?>
