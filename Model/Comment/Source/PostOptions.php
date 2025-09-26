<?php
declare(strict_types=1);

namespace DVPartners\Blog\Model\Comment\Source;

use Magento\Framework\Data\OptionSourceInterface;
use DVPartners\Blog\Model\ResourceModel\Post\CollectionFactory;

class PostOptions implements OptionSourceInterface
{
    protected CollectionFactory $postCollectionFactory;

    public function __construct(CollectionFactory $postCollectionFactory)
    {
        $this->postCollectionFactory = $postCollectionFactory;
    }

    public function toOptionArray(): array
    {
        $collection = $this->postCollectionFactory->create();
        $options = [];
        
        foreach ($collection as $post) {
            $options[] = [
                'label' => $post->getPostTitle() . ' (ID: ' . $post->getId() . ')',
                'value' => $post->getId(),
            ];
        }

        array_unshift($options, ['value' => '', 'label' => __('-- Seleccionar Post --')]);

        return $options;
    }
}