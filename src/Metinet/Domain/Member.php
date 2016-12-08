<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Member
{
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $encodedPassword;
    private $emailConfirmationToken;
    private $hasConfirmedItsEmail;
    private $interests = [];

    public function __construct(string $id, Email $email, string $firstName,
        string $lastName, EncodedPassword $encodedPassword, EmailConfirmationToken $emailConfirmationToken,
        bool $hasConfirmedItsEmail = false)
    {
        $this->id                     = $id;
        $this->email                  = $email;
        $this->firstName              = $firstName;
        $this->lastName               = $lastName;
        $this->encodedPassword        = $encodedPassword;
        $this->emailConfirmationToken = $emailConfirmationToken;
        $this->hasConfirmedItsEmail   = $hasConfirmedItsEmail;
    }

    static public function register(string $id, Email $email, string $firstName,
        string $lastName, EncodedPassword $encodedPassword, EmailConfirmationToken $emailConfirmationToken)
    {
        return new self(
            $id,
            $email,
            $firstName,
            $lastName,
            $encodedPassword,
            $emailConfirmationToken,
            false
        );
    }

    public function changeFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function changeLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function editInterests(array $interests)
    {
        $this->interests = $interests;
    }

    public function updateEmail(Email $email, EmailConfirmationToken $emailConfirmationToken)
    {
        $this->hasConfirmedItsEmail   = false;
        $this->email                  = $email;
        $this->emailConfirmationToken = $emailConfirmationToken;
    }

    public function confirmEmail(EmailConfirmationToken $emailConfirmationToken)
    {
        if (!$emailConfirmationToken->equals($this->emailConfirmationToken)) {

            throw new InvalidEmailConfirmationToken($emailConfirmationToken);
        }

        $this->hasConfirmedItsEmail = true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEncodedPassword()
    {
        return $this->encodedPassword;
    }

    public function getInterests()
    {
        return $this->interests;
    }
}
