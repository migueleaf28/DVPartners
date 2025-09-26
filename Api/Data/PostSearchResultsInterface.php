<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DVPartners\Blog\Api\Data;

interface PostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Post list.
     * @return \DVPartners\Blog\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set post_id list.
     * @param \DVPartners\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

