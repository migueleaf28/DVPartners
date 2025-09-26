<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Api\Data;

interface CommentInterface
{
    const COMMENT_ID = 'comment_id';
    const POST_ID = 'post_id';
    const AUTHOR = 'author';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';

    /**
     * Get comment_id
     * @return string|null
     */
    public function getCommentId();

    /**
     * Set comment_id
     * @param string $commentId
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     */
    public function setCommentId($commentId);

    /**
     * Get post_id
     * @return string|null
     */
    public function getPostId();

    /**
     * Set post_id
     * @param string $postId
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     */
    public function setPostId($postId);

    /**
     * Get author
     * @return string|null
     */
    public function getAuthor();

    /**
     * Set author
     * @param string $author
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     */
    public function setAuthor($author);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     */
    public function setContent($content);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \DVPartners\Blog\Api\Data\CommentInterface
     */
    public function setCreatedAt($createdAt);
}
