<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DVPartners\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class PostActions extends Column
{
    /** @var UrlInterface */
    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            if (!isset($item['post_id'])) {
                continue;
            }
            $item[$this->getData('name')] = [
                'edit' => [
                    'href' => $this->urlBuilder->getUrl('dvpartners_blog/post/edit', ['post_id' => $item['post_id']]),
                    'label' => __('Edit')
                ],
                'delete' => [
                    'href' => $this->urlBuilder->getUrl('dvpartners_blog/post/delete', ['post_id' => $item['post_id']]),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete "%1"', $item['post_title'] ?? ''),
                        'message' => __('Are you sure you want to delete this post?')
                    ]
                ]
            ];
        }

        return $dataSource;
    }
}
