<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class InvalidEmailConfirmationToken extends \Exception
{
    public function __construct(EmailConfirmationToken $emailConfirmationToken)
    {
        parent::__construct('Invalid email confirmation token');
    }
}
