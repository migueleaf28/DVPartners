<?php
declare(strict_types=1);

namespace DVPartners\Blog\Controller\Adminhtml\Post;

use DVPartners\Blog\Api\PostRepositoryInterface;
use DVPartners\Blog\Model\PostFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Backend\App\Action;

class Edit extends Action
{
    protected PostRepositoryInterface $postRepository;
    protected PostFactory $postFactory;
    protected Registry $coreRegistry;
    protected PageFactory $resultPageFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        PostRepositoryInterface $postRepository, 
        PostFactory $postFactory
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('post_id');
        
        if ($id) {
            try {
                $model = $this->postRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This Post no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            $model = $this->postFactory->create();
        }
        
        $this->coreRegistry->register('blog_post', $model);
        
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        
        $resultPage->setActiveMenu('DVPartners_Blog::post');
        $resultPage->addBreadcrumb(
            $id ? __('Edit Post') : __('New Post'),
            $id ? __('Edit Post') : __('New Post')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Posts'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Post %1', $model->getId()) : __('New Post'));
        return $resultPage;
    }
}