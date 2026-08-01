<?php
declare(strict_types=1);

namespace App\DTO;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class EstimateRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'First Name is required')]
        #[Assert\Length(min: 2, max: 100, minMessage: 'Please enter correct First Name')]
        public string $firstName,

        #[Assert\NotBlank(message: 'Last Name is required')]
        #[Assert\Length(min: 2, max: 100, minMessage: 'Please enter correct Last Name')]
        public string $lastName,

        #[Assert\NotBlank(message: 'Email is required')]
        #[Assert\Email(message: 'Provide a valid Email address')]
        public string $email,

        #[Assert\NotBlank(message: 'Phone number is required')]
        #[Assert\Length(exactly: 10, exactMessage: 'Please enter correct Phone number')]
        public string $phone,

        #[Assert\NotBlank(message: 'Postal Code is required')]
        #[Assert\Length(min: 3)]
        public string $postalCode,

        public ?string $address = null,
        public ?string $city = null,
        public ?string $province = null,
        public ?DateTimeImmutable $preferredDate = null,
        public ?string $preferredTime = null,

        /** @var list<string> */
        public array $products,

        public ?string $comments = null,
    ) {}

    /**
     * Создание DTO из входящего HTTP Request
     */
    public static function fromRequest(\Symfony\Component\HttpFoundation\Request $request): self
    {
        return new self(
            firstName: trim((string) $request->request->get('first-name', '')),
            lastName: trim((string) $request->request->get('last-name', '')),
            email: trim((string) $request->request->get('email', '')),
            phone: trim((string) $request->request->get('phone', '')),
            postalCode: trim((string) $request->request->get('postal-code', '')),

            // Optional data
            address: $request->request->has('address') ? trim((string) $request->request->get('address')) : null,
            city: $request->request->has('city') ? trim((string) $request->request->get('city')) : null,
            province: $request->request->get('location'), // в форме select называется location
            preferredDate: $request->request->get('date'),
            preferredTime: $request->request->get('time'),
            products: $request->request->all('products'),
            comments: $request->request->has('comments') ? trim((string) $request->request->get('comments')) : null,
        );
    }
}