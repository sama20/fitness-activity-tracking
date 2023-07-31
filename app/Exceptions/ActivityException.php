<?php

namespace App\Exceptions;

use App\Models\Enums\ActivityType;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ActivityException extends HttpResponseException
{
    public static function validateActivityType(ActivityType|null $activityType): void
    {
        if (!$activityType) {
            $response = new JsonResponse([
                'error' => 'Invalid parameter',
                'message' => 'activity Type is not valid',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

            throw new self($response);
        }
    }

    public static function validateActivity(Validator $validator): void
    {
        $response = new JsonResponse([
            'error' => 'Validation Error',
            'message' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($response);
    }
}