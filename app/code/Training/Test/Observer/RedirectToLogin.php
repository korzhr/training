<?php

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface {

    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    private $redirect;

    /**
     * @var \Magento\Framework\App\ActionFlag
     */
    private $actionFlag;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     */
    public function __construct(
    \Magento\Framework\App\Response\RedirectInterface $redirect,
            \Magento\Framework\App\ActionFlag $actionFlag,
            \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->redirect = $redirect;
        $this->actionFlag = $actionFlag;
        $this->customerSession = $customerSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->customerSession->isLoggedIn()) {
            //       $request = $observer->getEvent()->getData('request');
            $request = $observer->getData('request');
            if ($request->getModuleName() == 'catalog' && $request->getControllerName() == 'product' && $request->getActionName() == 'view') {
// if ($request->getFullActionName() == 'catalog_product_view') { // altenative way
                $controller = $observer->getEvent()->getData('controller_action');
                $this->actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
                $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
            }
        }
    }

}
