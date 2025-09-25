<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DVPartners\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitBlogComment implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $postTable = $this->moduleDataSetup->getTable('blog_post');
        $commentTable = $this->moduleDataSetup->getTable('blog_comment');
        
        if (!$this->moduleDataSetup->getConnection()->isTableExists($postTable)) {
            return;
        }
        
        $select = $this->moduleDataSetup->getConnection()
            ->select()
            ->from($postTable, 'post_id')
            ->order('post_id ASC')
            ->limit(1);
        
        $postId = $this->moduleDataSetup->getConnection()->fetchOne($select);
        
        if ($postId) {
            $data = [
                'post_id' => $postId,
                'author' => 'Miguel Abache',
                'content' => 'Comentario de ejemplo',
                'created_at' => (new \DateTime())->format('Y-m-d H:i:s')
            ];
            
            $this->moduleDataSetup->getConnection()->insert($commentTable, $data);
        }
        
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {

        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
