<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Model;

use DVPartners\Blog\Api\CommentRepositoryInterface;
use DVPartners\Blog\Api\Data\CommentInterface;
use DVPartners\Blog\Api\Data\CommentInterfaceFactory;
use DVPartners\Blog\Api\Data\CommentSearchResultsInterfaceFactory;
use DVPartners\Blog\Model\ResourceModel\Comment as ResourceComment;
use DVPartners\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CommentRepository implements CommentRepositoryInterface
{

    /**
     * @var ResourceComment
     */
    protected $resource;

    /**
     * @var CommentInterfaceFactory
     */
    protected $commentFactory;

    /**
     * @var CommentCollectionFactory
     */
    protected $commentCollectionFactory;

    /**
     * @var Comment
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceComment $resource
     * @param CommentInterfaceFactory $commentFactory
     * @param CommentCollectionFactory $commentCollectionFactory
     * @param CommentSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceComment $resource,
        CommentInterfaceFactory $commentFactory,
        CommentCollectionFactory $commentCollectionFactory,
        CommentSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->commentFactory = $commentFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CommentInterface $comment)
    {
        try {
            $this->resource->save($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the comment: %1',
                $exception->getMessage()
            ));
        }
        return $comment;
    }

    /**
     * @inheritDoc
     */
    public function get($commentId)
    {
        $comment = $this->commentFactory->create();
        $this->resource->load($comment, $commentId);
        if (!$comment->getId()) {
            throw new NoSuchEntityException(__('Comment with id "%1" does not exist.', $commentId));
        }
        return $comment;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->commentCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CommentInterface $comment)
    {
        try {
            $commentModel = $this->commentFactory->create();
            $this->resource->load($commentModel, $comment->getCommentId());
            $this->resource->delete($commentModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Comment: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($commentId)
    {
        return $this->delete($this->get($commentId));
    }
}

