<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Model;

use DVPartners\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel implements PostInterface
{
    const POST_ID = 'post_id';
    const POST_TITLE = 'post_title';
    const POST_CONTENT = 'post_content';
    const CREATED_AT = 'created_at';
    const MODIFIED_AT = 'modified_at';
    
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\DVPartners\Blog\Model\ResourceModel\Post::class);
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
    public function getPostTitle()
    {
        return $this->getData(self::POST_TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setPostTitle($postTitle)
    {
        return $this->setData(self::POST_TITLE, $postTitle);
    }

    /**
     * @inheritDoc
     */
    public function getPostContent()
    {
        return $this->getData(self::POST_CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setPostContent($postContent)
    {
        return $this->setData(self::POST_CONTENT, $postContent);
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

    /**
    * @inheritDoc
    */
    public function getModifiedAt()
    {
        return $this->getData(self::MODIFIED_AT);
    }
    /**
     * @inheritDoc
     */
    public function setModifiedAt($modifiedAt)
    {
        return $this->setData(self::MODIFIED_AT, $modifiedAt);
    }
}

