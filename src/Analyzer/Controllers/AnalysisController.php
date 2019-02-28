<?php

namespace Analyzer\Controllers;

use Analyzer\Services\CountedWordsSorter;
use Analyzer\Services\SubtitleFile\Analyzer;
use Analyzer\Services\UploadedFile\Handler;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class AnalysisController extends BaseController
{
    /**
     * @var Twig
     */
    private $view;
    /**
     * @var Handler
     */
    private $uploadedFileHandler;
    /**
     * @var Analyzer
     */
    private $subtitleFileAnalyzer;
    /**
     * @var CountedWordsSorter
     */
    private $countedWordsSorter;

    /**
     * AnalysisController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->view = $container->get('view');
        $this->uploadedFileHandler = $this->container->get('uploadedFileHandler');
        $this->subtitleFileAnalyzer = $this->container->get('subtitleFileAnalyzer');
        $this->countedWordsSorter = $this->container->get('wordsSorter');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function showForm(Request $request, Response $response, array $args = [])
    {
        return $this->view->render($response, 'form.html.twig', $args);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function showReport(Request $request, Response $response)
    {
        try {
            $subtitleFileInfo = $this->uploadedFileHandler->getUploadedFileInfo($request);
            $wordsCounter = $this->subtitleFileAnalyzer->countWords($subtitleFileInfo);
            return $this->view->render(
                $response,
                'report.html.twig',
                [
                    'stats' => $this->countedWordsSorter->sort($wordsCounter),
                    'fileInfo' => $subtitleFileInfo,
                ]
            );
        } catch (\Exception $ex) {
            return $this->showForm($request, $response, ['errorMessage' => $ex->getMessage()]);
        }
    }
}