<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Model\ResourceModel\Post;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult; 

class Collection extends SearchResult
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \DVPartners\Blog\Model\Post::class,
            \DVPartners\Blog\Model\ResourceModel\Post::class
        );
    }
}