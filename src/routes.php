<?php

$app->get('/', \Analyzer\Controllers\AnalysisController::class . ':showForm')
    ->setName('analysis.form');
$app->post('/', \Analyzer\Controllers\AnalysisController::class . ':showReport')
    ->setName('analysis.report');
