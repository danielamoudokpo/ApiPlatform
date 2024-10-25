<?php
namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Request;

class CustomAuthenticationSuccessHandler extends AuthenticationSuccessHandler
{
    /**
     * Override the handleAuthenticationSuccess method.
     */
    public function handleAuthenticationSuccess(UserInterface $user, $jwt = null, Request $request = null): JsonResponse
    {
        // Call the parent method to handle token generation
        $response = parent::handleAuthenticationSuccess($user, $jwt, $request);

        // Fetch the user data you want to return in the response
        $userData = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'roles' => $user->getRole(),
            'isEmailVerified' => $user->isIsEmailVerified(),
        ];

        // Decode the original response to add the user data
        $data = json_decode($response->getContent(), true);
        $data['user'] = $userData;

        // Return the updated response with the JWT token and user information
        return new JsonResponse($data);
    }
}

