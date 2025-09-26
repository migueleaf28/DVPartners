<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Api\Data;

interface PostInterface
{

    const POST_ID = 'post_id';
    const POST_TITLE = 'post_title';
    const POST_CONTENT = 'post_content';
    const CREATED_AT = 'created_at';
    const MODIFIED_AT = 'modified_at';

    /**
     * Get post_id
     * @return string|null
     */
    public function getPostId();

    /**
     * Set post_id
     * @param string $postId
     * @return \DVPartners\Blog\Post\Api\Data\PostInterface
     */
    public function setPostId($postId);

    /**
     * Get post_title
     * @return string|null
     */
    public function getPostTitle();

    /**
     * Set post_title
     * @param string $postId
     * @return \DVPartners\Blog\Post\Api\Data\PostInterface
     */
    public function setPostTitle($postId);
    
    /**
     * Get post_content
     *
     * @return string|null
     */
    public function getPostContent();

    /**
     * Set post_content
     *
     * @param string $postContent
     * @return \DVPartners\Blog\Api\Data\PostInterface
     */
    public function setPostContent($postContent);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return \DVPartners\Blog\Api\Data\PostInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get modified_at
     *
     * @return string|null
     */
    public function getModifiedAt();

    /**
     * Set modified_at
     *
     * @param string $modifiedAt
     * @return \DVPartners\Blog\Api\Data\PostInterface
     */
    public function setModifiedAt($modifiedAt);
}

