<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonata\MediaBundle\PHPCR;

use Sonata\MediaBundle\Model\MediaManager as AbstractMediaManager;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Sonata\DoctrinePHPCRAdminBundle\Model\ModelManager;

class MediaManager extends AbstractMediaManager
{
    protected $modelManager;
    protected $repository;
    protected $class;

    /**
     * @param \Sonata\MediaBundle\Provider\Pool               $pool
     * @param \Sonata\AdminBundle\Model\ModelManagerInterface $modelManager
     * @param $class
     */
    public function __construct(Pool $pool, ModelManager $modelManager, $class)
    {
        $this->modelManager = $modelManager;

        parent::__construct($pool, $class);
    }

    /**
     * {@inheritdoc}
     */
    protected function filterCriteria(array $criteria)
    {
        $identifier = $this->modelManager->getModelIdentifier($this->class);

        if (isset($criteria[$identifier])) {
            $criteria[$identifier] = $this->modelManager->getBackendId($criteria[$identifier]);
        }

        return $criteria;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        $identifier = $this->modelManager->getModelIdentifier($this->class);

        if (count($criteria) === 1 && isset($criteria[$identifier])) {
            return $this->modelManager->find($this->class, $criteria[$identifier]);
        }

        return $this->modelManager->findOneBy($this->class, $this->filterCriteria($criteria));
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria)
    {
        $identifier = $this->modelManager->getModelIdentifier($this->class);

        if (count($criteria) === 1 && isset($criteria[$identifier])) {
            return $this->modelManager->find($this->class, $criteria[$identifier]);
        }

        return $this->modelManager->findBy($this->class, $this->filterCriteria($criteria));
    }

    /**
     * {@inheritdoc}
     */
    public function save(MediaInterface $media, $andFlush = true)
    {
        // just in case the pool alter the media
        $this->modelManager->update($media);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(MediaInterface $media, $andFlush = true)
    {
        $this->modelManager->delete($media);
    }
}
