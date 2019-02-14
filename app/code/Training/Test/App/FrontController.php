<?php

namespace Training\Test\App;

use \Magento\Framework\App\FrontControllerInterface;

class FrontController implements FrontControllerInterface {

    /**
     * @var \Magento\Framework\App\RouterList
     */
    protected $routerList;

    /**
     * @var \Magento\Framework\App\Response\Http
     */
//    protected $response;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\App\FrontController
     */
    private $frontController;

    /**
     * @param \Magento\Framework\App\RouterListInterface $routerList
     * @param \Magento\Framework\App\Response\Http $response
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
    \Magento\Framework\App\RouterListInterface $routerList,
            \Magento\Framework\App\FrontController $frontController,
//            \Magento\Framework\App\Response\Http $response,
            \Psr\Log\LoggerInterface $logger
    )
    {
        $this->routerList = $routerList;
        $this->frontController = $frontController;
//        $this->response = $response;
        $this->logger = $logger;
    }

    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        foreach ($this->routerList as $router) {
            $this->logger->info(get_class($router));
        }
//        return parent::dispatch($request);
        return $this->frontController->dispatch($request);
    }

}
