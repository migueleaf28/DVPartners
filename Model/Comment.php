<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Model;

use DVPartners\Blog\Api\Data\CommentInterface;
use Magento\Framework\Model\AbstractModel;

class Comment extends AbstractModel implements CommentInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\DVPartners\Blog\Model\ResourceModel\Comment::class);
    }

    /**
     * @inheritDoc
     */
    public function getCommentId()
    {
        return $this->getData(self::COMMENT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCommentId($commentId)
    {
        return $this->setData(self::COMMENT_ID, $commentId);
    }

    /**
     * @inheritDoc
     */
    public function getPostId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * @inheritDoc
     */
    public function setPostId($postId)
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * @inheritDoc
     */
    public function getAuthor()
    {
        return $this->getData(self::AUTHOR);
    }

    /**
     * @inheritDoc
     */
    public function setAuthor($author)
    {
        return $this->setData(self::AUTHOR, $author);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}