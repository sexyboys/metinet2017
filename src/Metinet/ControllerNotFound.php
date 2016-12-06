<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet;

class ControllerNotFound extends \LogicException
{
    public function __construct($className)
    {
        parent::__construct(
            sprintf(
                "Le contrôleur '%s' n'existe pas.",
                $className
            )
        );
    }
}
