<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Api\Data;

interface CommentSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Comment list.
     * @return \DVPartners\Blog\Api\Data\CommentInterface[]
     */
    public function getItems();

    /**
     * Set comment list.
     * @param \DVPartners\Blog\Api\Data\CommentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

