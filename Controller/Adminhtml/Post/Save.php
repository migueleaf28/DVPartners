<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Controller\Adminhtml\Post;

use Magento\Framework\Exception\LocalizedException;
use DVPartners\Blog\Api\PostRepositoryInterface;
use DVPartners\Blog\Model\PostFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException; 

class Save extends Action
{
    protected DataPersistorInterface $dataPersistor;
    protected PostRepositoryInterface $postRepository;
    protected PostFactory $postFactory;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        PostRepositoryInterface $postRepository, 
        PostFactory $postFactory 
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['post_id'])) {
                $data['post_id'] = null;
            }

            $id = $this->getRequest()->getParam('post_id');

            if ($id) {
                try {
                    $model = $this->postRepository->get((int) $id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__('This Post no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                $model = $this->postFactory->create();
            }

            $model->setData($data);

            try {
                $this->postRepository->save($model);

                $this->messageManager->addSuccessMessage(__('You saved the Post.'));
                $this->dataPersistor->clear('blog_post');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');

            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Post.'));
            }

            $this->dataPersistor->set('blog_post', $data);
            $returnId = $this->getRequest()->getParam('post_id') ?: null;
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $returnId]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DVPartners_Blog::post_save');
    }
}