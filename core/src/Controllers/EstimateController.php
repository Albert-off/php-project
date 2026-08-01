<?php
declare(strict_types=1);

namespace App\Controllers;

use App\DTO\EstimateRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class EstimateController
{
    public function __construct(
        private readonly ValidatorInterface $validator
    ) {}

    public function __invoke(Request $request): Response
    {
        // 1. Собираем данные в DTO
        $dto = EstimateRequest::fromRequest($request);

        // 2. Валидируем объект одной строкой по описанным правилам
        $violations = $this->validator->validate($dto);

        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                // Превращаем имя свойства в формат полей формы (например, firstName -> first-name)
                $field = lcfirst($violation->getPropertyPath());
                // Простая замена для сопоставления с именами в HTML
                $field = match($field) {
                    'firstName' => 'first-name',
                    'lastName' => 'last-name',
                    'postalCode' => 'postal-code',
                    default => $field
                };

                $errors[$field] = $violation->getMessage();
            }

            // Возвращаем ошибки клиенту в формате JSON
            return new JsonResponse(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // 3. Данные валидны, передаем $dto в Service Layer
        // ...

        // Пока здесь заглушка (на следующем шаге подключим Service Layer и Mailer)
        return new JsonResponse(['message' => 'Estimate request received successfully!']);


        // $estimateService->submit($dto);
    }
}
