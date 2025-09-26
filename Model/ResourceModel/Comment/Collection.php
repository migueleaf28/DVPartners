<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'comment_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \DVPartners\Blog\Model\Comment::class,
            \DVPartners\Blog\Model\ResourceModel\Comment::class
        );
    }
}

