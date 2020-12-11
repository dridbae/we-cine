<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TheMovieDBRequesterService
{
    public const ROUTES = [
            'getGenres' => 'genre/movie/list',
            'topRated' => 'movie/top_rated',
            'videos' => 'movie/{id}/videos',
            'search' => 'search/movie',
            'getMovie' => 'movie/{id}',
        ];
    /**
     * @var HttpClientInterface
     */
    protected HttpClientInterface $httpClient;

    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var string
     */
    private $theMovieDbApiBaseUrl;
    /**
     * @var string
     */
    private $language;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $httpClient, ParameterBagInterface $parameterBag, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $parameterBag->get('themoviedb_api_key');
        $this->language = $parameterBag->get('language');
        $this->theMovieDbApiBaseUrl = $parameterBag->get('themoviedb_base_uri');
        $this->logger = $logger;
    }

    /**
     * @param string $uri
     * @param array<string, int|string> $params
     * @param bool $skipLanguage
     * @return string|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function makeGetRequest(string $uri, array $params = [], $skipLanguage = false): ?string
    {
        if (null == $this->apiKey) {
            throw new UnprocessableEntityHttpException('Missing themoviedb_api_key');
        }

        try {
            $url = sprintf('%s/%s', $this->theMovieDbApiBaseUrl, $uri);
            $params = ['query' => $params + ['api_key' => $this->apiKey], 'timeout' => 2];
            if (false === $skipLanguage) {
                $params['query']['language'] = $this->language;
            }
            $response = $this->httpClient->request('GET', $url, $params);

            if ($response->getStatusCode() !== 200) {
                $this->logger->error('Unable to get data from The MovieDB', ['uri' => $uri, 'params' => $params, 'statusCode' => $response->getStatusCode()]);
                throw new UnprocessableEntityHttpException('Unable to get data from The MovieDB');
            }
            $this->logger->info('Request to TheMovieDb succeeded', ['url' => $url, 'parems' => $params]);

            return $response->getContent(true);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), ['uri' => $uri, 'params' => $params]);
        }

        return null;
    }
}
