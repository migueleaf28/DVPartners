<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Controller\Adminhtml\Comment;

use DVPartners\Blog\Api\CommentRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'DVPartners_Blog::comment_delete';

    protected CommentRepositoryInterface $commentRepository;

    /**
     * @param Context $context
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        Context $context,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int)$this->getRequest()->getParam('comment_id');

        if ($id) {
            try {
                $this->commentRepository->deleteById($id);
                
                $this->messageManager->addSuccessMessage(__('You deleted the Comment with ID: %1.', $id));
                
                return $resultRedirect->setPath('*/*/');
                
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The Comment you are trying to delete no longer exists.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['comment_id' => $id]);
            }
        }
        
        $this->messageManager->addErrorMessage(__('We can\'t find a Comment to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}