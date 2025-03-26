<?php

namespace App\Http\Integrations\DaData;

use App\Exceptions\ApplicationException;
use App\Http\Integrations\DaData\Requests\ContractorByInnRequest;
use Illuminate\Contracts\Foundation\Application;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector as BaseConnector;
use Saloon\Traits\Plugins\AcceptsJson;

class Connector extends BaseConnector
{

    use AcceptsJson;

    public function __construct(
        protected readonly string $baseUrl,
        protected readonly string $token,
    ) {}

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ];
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->token, 'Token');
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }

    /**
     * getting Contractor method
     */
    public function getContractorByInn(string $inn)
    {
        try {
            $response = $this->send(new ContractorByInnRequest(
                [
                    "query" => $inn,
                    "branch_type" => "MAIN",
                ]
            ));
        } catch (\Throwable $e) {
            throw ApplicationException::init('Ошибка подключения к DaData API: '.$e->getMessage(), $e->getCode() ?? 503);
        }
        return $response->dto();
    }

    /**
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     *
     * @return void
     */
    public static function bootConnection(Application $app): void
    {
        $app->singleton(
            abstract: static::class,
            concrete: fn() => new self(
                baseUrl: strval(config('services.dadata.baseurl')),
                token: strval(config('services.dadata.token'))
            )
        );
        $app->alias(Connector::class, 'dadata.connector');
    }

}
