<?php

namespace AnotherDay\Http;

class Response
{
  private static self $instance;

  private int
    $code;

  private mixed
    $content;

  private array
    $headers;

  private function __construct(int $code)
  {
    $this->code = $code;
    $this->setContentType('application/json');
  }

  public static function create(): self
  {
    if (isset(self::$instance))
      return self::$instance;

    return self::$instance = new self(200);
  }

  public function setResponse(int $code, mixed $content = null): self
  {
    $this->code = $code;
    $this->content = $content;

    return self::$instance;
  }

  public function setContentType(string $contentType): void
  {
    if ($this->validateContentType($contentType) == false)
      throw new \Exception("Content-Type invalido: ${contentType}", 500);

    $this->setHeaders(['Content-Type' => $contentType]);
  }

  public function setHeaders(array $data): void
  {
    foreach ($data as $key => $value) {
      $this->headers[$key] = $value;
    }
  }

  public function sendResponse(): void
  {
    $this->sendHeaders();

    switch ($this->headers['Content-Type']) {
      case 'application/json':

        $this->content = json_encode($this->content ?? null);
        exit($this->content);

      default:

        break;
    }
  }

  private function sendHeaders(): void
  {
    foreach ($this->headers as $key => $value) {
      header($key . ':' . $value);
    }

    http_response_code($this->code);
  }

  private function validateContentType(string $contentType): bool
  {
    return match ($contentType) {
      'application/json' => true,

      default => false
    };
  }
}
