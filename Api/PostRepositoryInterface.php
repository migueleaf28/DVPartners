<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PostRepositoryInterface
{

    /**
     * Save Post
     * @param \DVPartners\Blog\Api\Data\PostInterface $post
     * @return \DVPartners\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \DVPartners\Blog\Api\Data\PostInterface $post
    );

    /**
     * Retrieve Post
     * @param string $postId
     * @return \DVPartners\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($postId);

    /**
     * Retrieve Post matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DVPartners\Blog\Api\Data\PostSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Post
     * @param \DVPartners\Blog\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \DVPartners\Blog\Api\Data\PostInterface $post
    );

    /**
     * Delete Post by ID
     * @param string $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId);
}

