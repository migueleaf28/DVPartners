<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CommentRepositoryInterface
{

    /**
     * Save Comment
     * @param \DVPartners\Blog\Api\Data\CommentInterface $comment
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \DVPartners\Blog\Api\Data\CommentInterface $comment
    );

    /**
     * Retrieve Comment
     * @param string $commentId
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($commentId);

    /**
     * Retrieve Comment matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DVPartners\Blog\Api\Data\CommentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Comment
     * @param \DVPartners\Blog\Api\Data\CommentInterface $comment
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \DVPartners\Blog\Api\Data\CommentInterface $comment
    );

    /**
     * Delete Comment by ID
     * @param string $commentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($commentId);
}

