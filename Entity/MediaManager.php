<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonata\MediaBundle\Entity;

use Sonata\CoreBundle\Entity\DoctrineBaseManager;
use Doctrine\ORM\EntityManager;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\Pool;

class MediaManager extends DoctrineBaseManager implements MediaManagerInterface
{
    /**
     * Constructor.
     * 
     * @param string        $class
     * @param EntityManager $em
     * @param Pool          $pool
     */
    public function __construct($class, EntityManager $em, Pool $pool)
    {
        $this->pool = $pool;

        parent::__construct($class, $em);
    }
}
