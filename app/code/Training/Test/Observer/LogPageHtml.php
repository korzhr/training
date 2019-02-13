<?php

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;

class LogPageHtml implements ObserverInterface {

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    private $response;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
    \Psr\Log\LoggerInterface $logger,
            \Magento\Framework\App\ResponseInterface $response
    )
    {
        $this->logger = $logger;
        $this->response = $response;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getEvent()->getData('request');
        $this->logger->debug($this->response->getBody());
    }

}
