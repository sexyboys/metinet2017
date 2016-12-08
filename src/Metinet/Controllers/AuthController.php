<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Domain\Email;
use Metinet\Domain\EmailConfirmationToken;
use Metinet\Domain\EncodedPassword;
use Metinet\Domain\Member;
use Metinet\Domain\Member\AuthenticationFailed;
use Metinet\Domain\Member\MemberAuthenticator;
use Metinet\Domain\Member\MemberProvider;
use Metinet\Domain\Member\AuthenticationContext;
use Metinet\Domain\Member\Unauthorized;
use Metinet\Domain\PlainTextPassworderEncoder;
use Metinet\Http\Request;
use Metinet\Http\Response;
use Metinet\Session\Session;
use Metinet\Repositories\InMemoryMemberRepository;

class AuthController
{
    private $memberAuthenticator;
    private $authenticationContext;

    public function __construct()
    {
        $memberRepository = new InMemoryMemberRepository();
        $passwordEncoder = new PlainTextPassworderEncoder();
        $memberProvider = new MemberProvider($memberRepository);
        $this->memberAuthenticator = new MemberAuthenticator($memberProvider, $passwordEncoder);
        $this->authenticationContext = new AuthenticationContext();


        $member = Member::register(
            uniqid(),
            new Email('guery.b@gmail.com'),
            'Boris',
            'Guéry',
            new EncodedPassword("s3cr3t{salt}", "salt"),
            EmailConfirmationToken::generate()
        );

        $memberRepository->add($member);
    }

    public function login(Request $request)
    {
        parse_str($request->getBody(), $requestData);
        $email = $requestData['email'] ?? "guery.b@gmail.com";
        $password = $requestData['password'] ?? "s3cr3t";

        try {
            $this->memberAuthenticator->authenticate(new Email($email), $password);
        } catch (AuthenticationFailed $e) {

            return new Response(403, sprintf("Authentication failed. (%s)", $e->getMessage()), []);
        }

        return Response::success("Successfully authenticated.", []);
    }

    public function logout(Request $request)
    {
        $session = new Session();
        $session->start();
        $session->set("member", null);

        return Response::success("Logged out.");
    }

    public function account(Request $request)
    {
        if (!$this->authenticationContext->isMemberLoggedIn()) {

            throw Unauthorized::memberNotLoggedIn();
        }

        $session = new Session();
        $session->start();

        return new Response(200, var_export($session->get("member"), true), []);
    }
}
