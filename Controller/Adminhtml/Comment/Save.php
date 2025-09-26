<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Controller\Adminhtml\Comment;

use DVPartners\Blog\Api\CommentRepositoryInterface;
use DVPartners\Blog\Api\Data\CommentInterfaceFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'DVPartners_Blog::comment_save';
    
    protected DataPersistorInterface $dataPersistor;
    protected CommentRepositoryInterface $commentRepository;
    protected CommentInterfaceFactory $commentFactory;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        CommentRepositoryInterface $commentRepository,
        CommentInterfaceFactory $commentFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->commentRepository = $commentRepository;
        $this->commentFactory = $commentFactory;
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
            $id = $this->getRequest()->getParam('comment_id');
        
            if ($id) {
                try {
                    $model = $this->commentRepository->get((int)$id);
                } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__('This Comment no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                $model = $this->commentFactory->create();
            }
        
            $model->setData($data);
        
            try {
                $this->commentRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Comment.'));
                $this->dataPersistor->clear('blog_comment');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['comment_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
                
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e, 
                    __('Something went wrong while saving the Comment.')
                );
            }
        
            $this->dataPersistor->set('blog_comment', $data);
            return $resultRedirect->setPath('*/*/edit', ['comment_id' => $this->getRequest()->getParam('comment_id')]);
        }
        
        return $resultRedirect->setPath('*/*/');
    }
}

