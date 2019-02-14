<?php

namespace Training\Test\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action {

    private $resultRawFactory;

    public function __construct(
    \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    )
    {
        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }

    public function execute()
    {
//        return $this->getResponse()->appendBody('simple text');
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents('simple text');
    }

}
