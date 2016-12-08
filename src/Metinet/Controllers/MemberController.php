<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Domain\Email;
use Metinet\Domain\EmailConfirmationToken;
use Metinet\Domain\EmailMessage;
use Metinet\Domain\EncodedPassword;
use Metinet\Domain\Member;
use Metinet\Domain\PhpEmailSender;
use Metinet\Domain\PlainTextPassworderEncoder;
use Metinet\Http\Request;

class MemberController
{
    private $memberRepository;

    public function register(Request $request)
    {

        $passwordEncoder = new PlainTextPassworderEncoder();
        $salt = uniqid();
        $encodedPassword = new EncodedPassword($passwordEncoder->encode("s3cr3t", $salt), $salt);

        $emailConfirmationToken = EmailConfirmationToken::generate();

        $member = Member::register(
            uniqid(),
            new Email('guery.b@gmail.com'),
            'Boris',
            'Guéry',
            $encodedPassword,
            $emailConfirmationToken
        );

        $this->memberRepository->add($member);
        $mailer = new PhpEmailSender();
        $mailer->send(new EmailMessage(
            $member->getEmail(),
            "admin@example.com",
            "Confirmation de votre inscription",
            sprintf(
                "http://example.com/members/email/confirm?id=%s&confirmationToken=%s",
                $member->getId(),
                (string) $emailConfirmationToken
            )
        ));
    }

    public function confirmEmail(Request $request)
    {
      $memberId = $request->get('id');
      $confirmationToken = $request->get('confirmationToken');

        /** @var Member $member */
        $member = $this->memberRepository->get($memberId);

        $member->confirmEmail(EmailConfirmationToken::fromString($confirmationToken));
    }
}
