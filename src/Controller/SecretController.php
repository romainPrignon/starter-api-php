<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Secret;
use App\Service\CryptoService;
use App\Service\HashService;
use App\Repository\SecretRepository;

class SecretController extends AbstractController
{
    /**
     * @var CryptoService
     */
    private $cryptoService;

    /**
     * @var HashService
     */
    private $hashService;

    /**
     * @var SecretRepository
     */
    private $secretRepository;

    public function __construct(
        CryptoService $cryptoService, HashService $hashService, SecretRepository $secretRepository
    ) {
        $this->cryptoService = $cryptoService;
        $this->hashService = $hashService;
        $this->secretRepository = $secretRepository;
    }

    public function encode(Request $request): JsonResponse
    {
        $content = $request->query->get('content');

        $crypted_content = $this->cryptoService->encrypt($content);
        $id = $this->hashService->createId($crypted_content);

        $secret = new Secret();
        $secret->setId($id);
        $secret->setContent($crypted_content);

        $this->secretRepository->insertOne($secret);

        $res = new JsonResponse($id);
        $res->setStatusCode(201);

        return $res;
    }

    public function decode(Request $request): JsonResponse
    {
        $id = $request->query->get('id');

        $secret = $this->secretRepository->findOne($id);

        $content = $secret ? $this->cryptoService->decrypt($secret->getContent()) : null;

        return new JsonResponse($content);
    }
}
