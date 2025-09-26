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
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @inheritDoc
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
}

