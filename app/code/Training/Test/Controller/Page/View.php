<?php

namespace Training\Test\Controller\Page;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

//class View extends \Magento\Cms\Controller\Page\View {
class View extends Action implements HttpGetActionInterface,
        HttpPostActionInterface {

//class View extends Action {

    protected $resultJsonFactory;
    protected $pageRepository;
    protected $prepare;
    protected $resultForwardFactory;

    public function __construct(
    \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
            \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
            \Magento\Cms\Api\PageRepositoryInterface $pageRepository,
            \Magento\Cms\Helper\Page $prepare
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pageRepository = $pageRepository;
        $this->prepare = $prepare;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {

//Зайдите на страницу http://magento.test/enable-cookies затем
// http://magento.test/enable-cookies?ajax=1
        
        $pageId = $this->getRequest()->getParam('page_id', $this->getRequest()->getParam('id', false));

        if ($this->getRequest()->isAjax()) {
            $data = ['status' => 'success', 'message' => ''];
            $resultJson = $this->resultJsonFactory->create();
            try {
                $page = $this->pageRepository->getById($pageId);
                $data['title'] = $page->getTitle();
                $data['content'] = $page->getContent();
            } catch (NoSuchEntityException $e) {
                $data['status'] = 'error';
                $data['message'] = 'Not found';
            } catch (\Exception $e) {
                $data['status'] = 'error';
                $data['message'] = 'Something wrong';
            }
            $resultJson->setData($data);
            return $resultJson;
        }
        $resultPage = $this->prepare->prepareResultPage($this, $pageId);
        return $resultPage;
    }

}
